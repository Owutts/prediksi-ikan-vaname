<?php

namespace App\Http\Controllers;
use App\Models\dataset;
use Illuminate\Http\Request;

class prediksiController extends Controller
{
    //
    public function index()
    {
        return view('prediksi');
    }
    public function prediksi(Request $request)
{
    $request->validate([
        'luas' => 'required',
        'qty_tanam' => 'required|numeric|min:1',
        'lama' => 'required|numeric|min:1',
        'pakan' => 'required|numeric|min:1',
        'musim_panen' => 'required|numeric|min:1',
        'nilaik' => 'required|integer|min:1',
    ], [
        'luas.required' => 'Luas harus diisi.',
        'qty_tanam.required' => 'Jumlah tanam harus diisi.',
        'lama.required' => 'Lama tanam harus diisi.',
        'pakan.required' => 'Jumlah pakan harus diisi.',
        'musim_panen.required' => 'Musim panen harus diisi.',
        'nilaik.required' => 'Nilai K harus diisi.',
    ]);

    $dataset = dataset::all();

    if ($dataset->isEmpty()) {
        return redirect()->back()->with('error', 'Dataset tidak ditemukan.');
    }

    // Ambil semua kolom untuk normalisasi
    $allLuas   = $dataset->pluck('LUAS')->map(fn($v) => (float)$v);
    $allQty    = $dataset->pluck('QTY_TANAM')->map(fn($v) => (float)$v);
    $allLama   = $dataset->pluck('LAMA')->map(fn($v) => (float)$v);
    $allPakan  = $dataset->pluck('PAKAN')->map(fn($v) => (float)$v);
    $allMusim  = $dataset->pluck('MUSIM_PANEN')->map(fn($v) => (float)$v);

    // Fungsi normalisasi Min-Max
    $normalize = function($value, $min, $max) {
        if ($max - $min == 0) return 0; // hindari divisi nol
        return ($value - $min) / ($max - $min);
    };

    // Hitung min & max tiap kolom
    $minMax = [
        'luas'  => ['min' => $allLuas->min(), 'max' => $allLuas->max()],
        'qty'   => ['min' => $allQty->min(),  'max' => $allQty->max()],
        'lama'  => ['min' => $allLama->min(), 'max' => $allLama->max()],
        'pakan' => ['min' => $allPakan->min(),'max' => $allPakan->max()],
        'musim' => ['min' => $allMusim->min(),'max' => $allMusim->max()],
    ];
    
    

    // Normalisasi input user
    $xInputAsli = [
        (float) $request->luas,
        (float) $request->qty_tanam,
        (float) $request->lama,
        (float) $request->pakan,
        (float) $request->musim_panen,
    ];

    $xInput = [
        $xInputAsli[0] < $minMax['luas']['min']  ? 0 : ($xInputAsli[0] > $minMax['luas']['max']  ? 1 : $normalize($xInputAsli[0], $minMax['luas']['min'],  $minMax['luas']['max'])),
        $xInputAsli[1] < $minMax['qty']['min']   ? 0 : ($xInputAsli[1] > $minMax['qty']['max']   ? 1 : $normalize($xInputAsli[1], $minMax['qty']['min'],   $minMax['qty']['max'])),
        $xInputAsli[2] < $minMax['lama']['min']  ? 0 : ($xInputAsli[2] > $minMax['lama']['max']  ? 1 : $normalize($xInputAsli[2], $minMax['lama']['min'],  $minMax['lama']['max'])),
        $xInputAsli[3] < $minMax['pakan']['min'] ? 0 : ($xInputAsli[3] > $minMax['pakan']['max'] ? 1 : $normalize($xInputAsli[3], $minMax['pakan']['min'], $minMax['pakan']['max'])),
        $xInputAsli[4] < $minMax['musim']['min'] ? 0 : ($xInputAsli[4] > $minMax['musim']['max'] ? 1 : $normalize($xInputAsli[4], $minMax['musim']['min'], $minMax['musim']['max'])),
    ];

    $nilaiK = $request->nilaik;

    $jarak = [];

    foreach ($dataset as $data) {
        // Normalisasi tiap data dari dataset
        $xDataAsli = [
            (float) $data->LUAS,
            (float) $data->QTY_TANAM,
            (float) $data->LAMA,
            (float) $data->PAKAN,
            (float) $data->MUSIM_PANEN,
        ];

        $xData = [
            $normalize($xDataAsli[0], $minMax['luas']['min'],  $minMax['luas']['max']),
            $normalize($xDataAsli[1], $minMax['qty']['min'],   $minMax['qty']['max']),
            $normalize($xDataAsli[2], $minMax['lama']['min'],  $minMax['lama']['max']),
            $normalize($xDataAsli[3], $minMax['pakan']['min'], $minMax['pakan']['max']),
            $normalize($xDataAsli[4], $minMax['musim']['min'], $minMax['musim']['max']),
        ];

        // Hitung jarak Euclidean pada data yang sudah dinormalisasi
        $distance = 0;
        for ($i = 0; $i < count($xInput); $i++) {
            $distance += pow($xInput[$i] - $xData[$i], 2);
        }
        $distance = sqrt($distance);

        $jarak[] = [
            'atribut_asli' => $xDataAsli,
            'atribut_normalisasi' => $xData,
            'nilai' => (float) $data->HASIL_PANEN,
            'jarak' => $distance,
            'tahun' => $data->TAHUN,
        ];
    }

    // Urutkan berdasarkan jarak terdekat
    usort($jarak, fn($a, $b) => $a['jarak'] <=> $b['jarak']);

    // Ambil K tetangga terdekat
    $tetanggaTerdekat = array_slice($jarak, 0, $nilaiK);
    $nilaiY = array_column($tetanggaTerdekat, 'nilai');
    $nilaiYStr = implode(' + ', $nilaiY);
    $prediksi = array_sum($nilaiY) / $nilaiK;
    $prediksi1 = round($prediksi, 4);
    $prediksiBulat = round($prediksi);

    // Rumus Latex
    $rumusLatex = "\\( Y_{\\text{prediksi}} = \\frac{1}{{$nilaiK}} ({$nilaiYStr}) = {$prediksi1} \\) Kg";

    return view('hasil', compact(
        'jarak',
        'nilaiK',
        'prediksiBulat',
        'tetanggaTerdekat',
        'rumusLatex',
        'xInput',          // data input normalisasi
        'xInputAsli',      // data input asli
        'minMax'           // supaya bisa ditampilkan range min-max di view
    ));
}

public function akurasi($nilaiK = 3)
{
    $dataset = dataset::all();

    if ($dataset->count() < $nilaiK) {
        return redirect()->back()->with('error', 'Dataset tidak cukup untuk menghitung akurasi.');
    }

    // Ambil semua kolom untuk normalisasi
    $allLuas   = $dataset->pluck('LUAS')->map(fn($v) => (float)$v);
    $allQty    = $dataset->pluck('QTY_TANAM')->map(fn($v) => (float)$v);
    $allLama   = $dataset->pluck('LAMA')->map(fn($v) => (float)$v);
    $allPakan  = $dataset->pluck('PAKAN')->map(fn($v) => (float)$v);
    $allMusim  = $dataset->pluck('MUSIM_PANEN')->map(fn($v) => (float)$v);

    $normalize = function($value, $min, $max) {
        if ($max - $min == 0) return 0;
        return ($value - $min) / ($max - $min);
    };

    $boundNormalize = function($value, $min, $max) use ($normalize) {
        if ($value < $min) return 0;
        if ($value > $max) return 1;
        return $normalize($value, $min, $max);
    };

    $minMax = [
        'luas'  => ['min' => $allLuas->min(),  'max' => $allLuas->max()],
        'qty'   => ['min' => $allQty->min(),   'max' => $allQty->max()],
        'lama'  => ['min' => $allLama->min(),  'max' => $allLama->max()],
        'pakan' => ['min' => $allPakan->min(), 'max' => $allPakan->max()],
        'musim' => ['min' => $allMusim->min(), 'max' => $allMusim->max()],
    ];

    $hasilAkurasi = [];

    foreach ($dataset as $indexUji => $dataUji) {
        // Input Uji Asli
        $xUjiAsli = [
            (float) $dataUji->LUAS,
            (float) $dataUji->QTY_TANAM,
            (float) $dataUji->LAMA,
            (float) $dataUji->PAKAN,
            (float) $dataUji->MUSIM_PANEN,
        ];

        // Normalisasi input uji dengan pembatasan [0,1]
        $xUji = [
            $boundNormalize($xUjiAsli[0], $minMax['luas']['min'],  $minMax['luas']['max']),
            $boundNormalize($xUjiAsli[1], $minMax['qty']['min'],   $minMax['qty']['max']),
            $boundNormalize($xUjiAsli[2], $minMax['lama']['min'],  $minMax['lama']['max']),
            $boundNormalize($xUjiAsli[3], $minMax['pakan']['min'], $minMax['pakan']['max']),
            $boundNormalize($xUjiAsli[4], $minMax['musim']['min'], $minMax['musim']['max']),
        ];

        $nilaiAktual = (float) $dataUji->HASIL_PANEN;
        $tahun = (int) $dataUji->TAHUN;

        // Data latih = dataset dikurangi data uji ini
        $dataLatih = $dataset->filter(fn($_, $key) => $key !== $indexUji);

        $jarak = [];

        foreach ($dataset as $dataLatihItem) {
            $xLatihAsli = [
                (float) $dataLatihItem->LUAS,
                (float) $dataLatihItem->QTY_TANAM,
                (float) $dataLatihItem->LAMA,
                (float) $dataLatihItem->PAKAN,
                (float) $dataLatihItem->MUSIM_PANEN,
            ];

            // Normalisasi data latih juga
            $xLatih = [
                $boundNormalize($xLatihAsli[0], $minMax['luas']['min'],  $minMax['luas']['max']),
                $boundNormalize($xLatihAsli[1], $minMax['qty']['min'],   $minMax['qty']['max']),
                $boundNormalize($xLatihAsli[2], $minMax['lama']['min'],  $minMax['lama']['max']),
                $boundNormalize($xLatihAsli[3], $minMax['pakan']['min'], $minMax['pakan']['max']),
                $boundNormalize($xLatihAsli[4], $minMax['musim']['min'], $minMax['musim']['max']),
            ];

            // Hitung jarak Euclidean
            $distance = 0;
            for ($i = 0; $i < count($xUji); $i++) {
                $distance += pow($xUji[$i] - $xLatih[$i], 2);
            }
            $distance = sqrt($distance);

            $jarak[] = [
                'nilai' => (float) $dataLatihItem->HASIL_PANEN,
                'jarak' => $distance,
            ];
        }

        usort($jarak, fn($a, $b) => $a['jarak'] <=> $b['jarak']);
        $tetanggaTerdekat = array_slice($jarak, 0, $nilaiK);

        if (count($tetanggaTerdekat) < $nilaiK) continue;

        $prediksi = array_sum(array_column($tetanggaTerdekat, 'nilai')) / $nilaiK;
        $kesalahan = abs(($nilaiAktual - $prediksi) / max($nilaiAktual, 1)); // persen desimal

        $hasilAkurasi[] = [
            'index' => $indexUji + 1,
            'x_input' => [
                'LUAS'         => $xUjiAsli[0],
                'QTY_TANAM'    => $xUjiAsli[1],
                'LAMA'         => $xUjiAsli[2],
                'PAKAN'        => $xUjiAsli[3],
                'MUSIM_PANEN'  => $xUjiAsli[4],
            ],
            'tahun' => $tahun,
            'nilai_aktual' => $nilaiAktual,
            'prediksi' => round($prediksi, 4),
            'kesalahan' => round($kesalahan, 4),
        ];
        
    }

    // Hitung MAPE
    $totalKesalahan = array_sum(array_column($hasilAkurasi, 'kesalahan'));
    $mape = count($hasilAkurasi) > 0 ? ($totalKesalahan / count($hasilAkurasi) *100) : 0;

    return view('akurasi', [
        'hasilAkurasi' => $hasilAkurasi,
        'mape' => round($mape, 2),
        'nilaiK' => $nilaiK,
    ]);
}


    

}
