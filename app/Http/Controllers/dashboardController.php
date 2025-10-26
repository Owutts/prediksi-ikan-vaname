<?php

namespace App\Http\Controllers;
use App\Models\dataset;
use App\Models\users;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function index()
    { $dataset = dataset::count();
        $user = users::count();
        $akurasi = $this->hitungAkurasiCepat(3);  
        return view('dashboard', compact('dataset','user','akurasi'));
    }

    private function hitungAkurasiCepat(int $nilaiK): string
    {
        $dataset = dataset::all();
        $n       = $dataset->count();
    
        if ($n < $nilaiK) {
            return 'Data kurang';
        }
    
        // Kolom fitur tanpa TAHUN
        $fields = ['LUAS', 'QTY_TANAM', 'LAMA', 'PAKAN', 'MUSIM_PANEN'];
        $minMax = [];
        foreach ($fields as $field) {
            $values = $dataset->pluck($field)->map(fn($v) => (float) $v)->toArray();
            $minMax[$field] = [
                'min' => min($values),
                'max' => max($values)
            ];
        }
    
        $totalKesalahan = 0;
        foreach ($dataset as $indexUji => $dataUji) {
            $xUjiAsli = [];
            foreach ($fields as $field) {
                $xUjiAsli[$field] = (float) $dataUji->$field;
            }
    
            // Normalisasi min-max
            $xUji = [];
            foreach ($xUjiAsli as $key => $value) {
                $min = $minMax[$key]['min'];
                $max = $minMax[$key]['max'];
                if ($max - $min == 0) {
                    $norm = 0;
                } elseif ($value < $min) {
                    $norm = 0;
                } elseif ($value > $max) {
                    $norm = 1;
                } else {
                    $norm = ($value - $min) / ($max - $min);
                }
                $xUji[] = $norm;
            }
    
            $nilaiAktual = (float) $dataUji->HASIL_PANEN;
            $dataLatih = $dataset->filter(fn($_, $key) => $key !== $indexUji);
    
            $jarak = [];
            foreach ($dataset as $dataLatihItem) {
                $xLatih = [];
                foreach ($fields as $field) {
                    $value = (float) $dataLatihItem->$field;
                    $min = $minMax[$field]['min'];
                    $max = $minMax[$field]['max'];
                    if ($value < $min) {
                        $norm = 0;
                    } elseif ($value > $max) {
                        $norm = 1;
                    } else {
                        $norm = ($value - $min) / ($max - $min);
                    }
                    $xLatih[] = $norm;
                }
    
                $distance = 0;
                foreach ($xUji as $i => $val) {
                    $distance += pow($val - $xLatih[$i], 2);
                }
                $distance = sqrt($distance);
    
                $jarak[] = [
                    'nilai' => (float) $dataLatihItem->HASIL_PANEN,
                    'jarak' => $distance,
                ];
            }
    
            usort($jarak, fn($a, $b) => $a['jarak'] <=> $b['jarak']);
            $tetangga = array_slice($jarak, 0, $nilaiK);
    
            if (count($tetangga) < $nilaiK) continue;
    
            $prediksi = array_sum(array_column($tetangga, 'nilai')) / $nilaiK;
            $kesalahan = abs(($nilaiAktual - $prediksi) / max($nilaiAktual, 1));
            $totalKesalahan += $kesalahan;
        }
    
        $mape = $n ? ($totalKesalahan / $n  * 100) : 0;
        return number_format($mape, 2, ',', '.') . ' %';
    }
    
    
    
}
