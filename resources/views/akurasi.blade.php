@extends('template.appuser')
@section('title', 'Halaman Evaluasi')
@section('akurasi', 'active')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="text-center">Evaluasi Prediksi Menggunakan Metode MAPE</h5>
        <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
  Ubah Nilai K 
</button> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Luas Tambak</th>
                    <th>Jumlah Nanam</th>
                    <th>Lama Pemeliharaan</th>
                    <th>Banyak Pakan</th>
                    <th>Tahun</th>
                    <th>Musim Panen</th>
                    <th>Hasil Panen</th>
                    <th>Hasil Prediksi</th>
                    <th>Kesalahan</th>
                </thead>
                <tbody>
                @foreach ($hasilAkurasi as $hasil)
            <tr>
                <td>{{ $hasil['index'] }}</td>
                <td>{{ $hasil['x_input']['LUAS'] }}</td>
                <td>{{ $hasil['x_input']['QTY_TANAM'] }}</td>
                <td>{{ $hasil['x_input']['LAMA'] }}</td>
                <td>{{ $hasil['x_input']['PAKAN'] }}</td>
                <td>{{ $hasil['tahun'] }}</td>
                <td>{{ $hasil['x_input']['MUSIM_PANEN'] }}</td>
                <td>{{ $hasil['nilai_aktual'] }}</td>
                <td>{{ $hasil['prediksi'] }}</td>
                <td>{{ $hasil['kesalahan'] }}</td>
            </tr>
        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9" style="text-align: right"> Total MAPE (Mean Absolute Percentage Error): </td>
                        <td><strong>{{ $mape }} %</strong></td>
                    </tr>                    
                </tfoot>
            </table>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection