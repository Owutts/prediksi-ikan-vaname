@extends('template.appuser')
@section('title', 'Hasil Prediksi')
@section('prediksi', 'active')
@section('content')
<script type="text/javascript" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<script>
  window.MathJax = {
    tex: {
      inlineMath: [['\\(', '\\)']],
      displayMath: [['$$','$$']]
    }
  };
</script>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
        @endif
        <h5 class="card-title">
          Hasil Perhitungan Prediksi KNN (dengan **normalisasi Min-Max**) dari inputan berikut:
          <br>
          <strong>Input Asli:</strong><br>
          - Luas Tambak (M²) = <strong>{{ $xInputAsli[0] }}</strong><br>
          - Tanam (Rean) = <strong>{{ $xInputAsli[1] }}</strong><br>
          - Lama Panen (hari) = <strong>{{ $xInputAsli[2] }}</strong><br>
          - Banyak Pakan (Kg) = <strong>{{ $xInputAsli[3] }}</strong><br>
          - Musim Panen = <strong>{{ $xInputAsli[4] }}</strong><br>
          <br>
          <strong>Setelah Normalisasi (0–1):</strong><br>
          - Luas = <strong>{{ round($xInput[0],4) }}</strong><br>
          - Tanam = <strong>{{ round($xInput[1],4) }}</strong><br>
          - Lama = <strong>{{ round($xInput[2],4) }}</strong><br>
          - Pakan = <strong>{{ round($xInput[3],4) }}</strong><br>
          - Musim Panen = <strong>{{ round($xInput[4],4) }}</strong><br>
          <br>
          Nilai K = <strong>{{ $nilaiK }}</strong><br>
          Hasil Prediksi: <strong>{{ $prediksiBulat }} Kg</strong>
        </h5>
      </div>

      <div class="card-body">
        <div class="row">

<!-- Tabel Semua Perhitungan Jarak -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
    <h5>1. Semua Perhitungan Jarak (dengan data normalisasi)</h5>
    <p>
      Perhitungan jarak menggunakan rumus Euclidean pada data yang telah dinormalisasi:
      \( d(x, y) = \sqrt{ \sum_{i=1}^{n} (x_i - y_i)^2 } \)
    </p>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th rowspan="2">No</th>
            <th colspan="2">LUAS</th>
            <th colspan="2">QTY_TANAM</th>
            <th colspan="2">LAMA</th>
            <th colspan="2">PAKAN</th>
            <th colspan="2">MUSIM PANEN</th>
            <th rowspan="2">Tahun</th>
            <th rowspan="2">Total Jarak (√)</th>
            <th rowspan="2">Hasil Panen</th>
          </tr>
          <tr>
            <th>Norm.</th><th>(x-y)²</th>
            <th>Norm.</th><th>(x-y)²</th>
            <th>Norm.</th><th>(x-y)²</th>
            <th>Norm.</th><th>(x-y)²</th>
            <th>Norm.</th><th>(x-y)²</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @foreach ($jarak as $index => $d)
            @php
              $xDataset = $d['atribut_normalisasi'];
              $selisihKuadrat = [];
              $totalJarak = 0;
              for ($i = 0; $i < count($xInput); $i++) {
                  $diff = $xInput[$i] - $xDataset[$i];
                  $selisihKuadrat[] = round(pow($diff, 2), 6);
                  $totalJarak += pow($diff, 2);
              }
              $hasilAkar = round(sqrt($totalJarak), 6);
            @endphp
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ round($xDataset[0],4) }}</td><td>{{ $selisihKuadrat[0] }}</td>
              <td>{{ round($xDataset[1],4) }}</td><td>{{ $selisihKuadrat[1] }}</td>
              <td>{{ round($xDataset[2],4) }}</td><td>{{ $selisihKuadrat[2] }}</td>
              <td>{{ round($xDataset[3],4) }}</td><td>{{ $selisihKuadrat[3] }}</td>
              <td>{{ round($xDataset[4],4) }}</td><td>{{ $selisihKuadrat[4] }}</td>
              <td>{{ $d['tahun'] }}</td>
              <td><strong>{{ $hasilAkar }}</strong></td>
              <td>{{ $d['nilai'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>

<!-- K Tetangga Terdekat -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5>2. {{ $nilaiK }} Tetangga Terdekat (berdasarkan normalisasi)</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>LUAS (Norm.)</th>
              <th>QTY_TANAM (Norm.)</th>
              <th>LAMA (Norm.)</th>
              <th>PAKAN (Norm.)</th>
              <th>MUSIM PANEN (Norm.)</th>
              <th>Tahun</th>
              <th>Jarak</th>
              <th>Hasil Panen</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($tetanggaTerdekat as $i => $t)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ round($t['atribut_normalisasi'][0],4) }}</td>
                <td>{{ round($t['atribut_normalisasi'][1],4) }}</td>
                <td>{{ round($t['atribut_normalisasi'][2],4) }}</td>
                <td>{{ round($t['atribut_normalisasi'][3],4) }}</td>
                <td>{{ round($t['atribut_normalisasi'][4],4) }}</td>
                <td>{{ $t['tahun'] }}</td>
                <td>{{ round($t['jarak'],6) }}</td>
                <td>{{ $t['nilai'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Hasil Prediksi -->
<div class="row mt-3">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5>3. Hasil Prediksi</h5>
        <p>
          Berdasarkan <strong>metode K-Nearest Neighbor</strong> (menggunakan data normalisasi Min-Max) dengan 
          <strong>K = {{ $nilaiK }}</strong>, maka hasil prediksi panen adalah:
        </p>
        <div class="text-center" style="overflow-x: auto;">
          {!! $rumusLatex !!}
        </div>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
