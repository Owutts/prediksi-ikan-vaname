@extends('template.appuser')
@section('title', 'Halaman Dataset')
@section('data', 'active')
@section('dataset', 'active')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>Dataset</h5>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
  Tambah Data <i class="fa fa-plus" aria-hidden="true"></i>
</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Tahun Panen</th>
                    <th>Musim Panen</th>
                    <th>Luas Tambak</th>
                    <th>Nanam (Rean)</th>
                    <th>Lama Pemeliharaan</th>
                    <th>Pakan</th>
                    <th>Hasil Panen</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($dataset as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->TAHUN }}</td>
                        <td>
                          Musim 
                          @if ($data->MUSIM_PANEN == 10)
                              1
                          @elseif ($data->MUSIM_PANEN == 20)
                              2
                          @elseif ($data->MUSIM_PANEN == 30)
                              3
                          @else
                              {{ $data->MUSIM_PANEN }}
                          @endif
                      </td>
                        <td>{{ $data->LUAS }} M<sup>2</sup></td>
                        <td>{{ $data->QTY_TANAM }}</td>
                        <td>{{ $data->LAMA }} Hari</td>
                        <td>{{ $data->PAKAN }} Kg</td>
                        <td>{{ $data->HASIL_PANEN }} Kg</td>
                        <td>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $data->ID_DATASET }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->ID_DATASET }}" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="hapus{{ $data->ID_DATASET }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{url('dataset/hapus/'.$data->ID_DATASET)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>
    Apakah anda ingin menghapus data pada tahun <strong>{{ $data->TAHUN }}</strong> 
    pada musim 
    <strong>
        @php
            $musim = '';
            if ($data->MUSIM_PANEN == 10) {
                $musim = '1';
            } elseif ($data->MUSIM_PANEN == 20) {
                $musim = '2';
            } elseif ($data->MUSIM_PANEN == 30) {
                $musim = '3';
            }
        @endphp
        {{ $musim }}
    </strong>
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
    </div>
  </div>
</div>



                    <div class="modal fade" id="edit{{ $data->ID_DATASET }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{url('dataset/edit/'.$data->ID_DATASET)}}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Edit Data</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
  <input type="number" name="TAHUN" class="form-control" value="{{ $data->TAHUN }}" id="floatingYear" placeholder="2025" min="1900" max="2100">
  <label for="floatingYear">Tahun (2025) </label>
</div>

<div class="form-floating mb-3">
  <select class="form-select" name="MUSIM_PANEN" id="floatingSelect" aria-label="Floating label select example" required>
    <option value="" disabled {{ $data->MUSIM_PANEN == null ? 'selected' : '' }}>-- Silahkan Pilih Musim Panen --</option>
    <option value="10" {{ $data->MUSIM_PANEN == 1 ? 'selected' : '' }}>Musim 1</option>
    <option value="20" {{ $data->MUSIM_PANEN == 2 ? 'selected' : '' }}>Musim 2</option>
    <option value="30" {{ $data->MUSIM_PANEN == 3 ? 'selected' : '' }}>Musim 3</option>
  </select>
  <label for="floatingSelect">Musim Panen</label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="LUAS" class="form-control" id="floatingYear" value="{{ $data->LUAS}}" placeholder="2025">
  <label for="floatingYear">Luas Tambak (M²) </label>
</div>

<div class="form-floating mb-3">
  <input type="number" name="QTY_TANAM" class="form-control" id="floatingYear" value="{{ $data->QTY_TANAM }}" placeholder="2025">
  <label for="floatingYear">Nanam (Rean) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="LAMA" class="form-control" id="floatingYear" placeholder="2025" value="{{$data->LAMA}}">
  <label for="floatingYear">Lama Memelihara (Hari) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="PAKAN" class="form-control" id="floatingYear" placeholder="2025" value="{{ $data->PAKAN }}">
  <label for="floatingYear">Pakan (Kg) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="HASIL_PANEN" class="form-control" id="floatingYear" placeholder="2025" value="{{ $data->HASIL_PANEN }}">
  <label for="floatingYear">Hasil Panen (Kg) </label>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
</form>
    </div>
  </div>
</div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{url('dataset/tambah')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
  <input type="number" name="TAHUN" class="form-control" id="floatingYear" placeholder="2025" min="1900" max="2100">
  <label for="floatingYear">Tahun (2025) </label>
</div>

<div class="form-floating mb-3">
  <select class="form-select" name="MUSIM_PANEN" id="floatingSelect" aria-label="Floating label select example">
    <option selected>-- Silahkan Pilih Musim Panen --</option>
    <option value="10">Musim 1</option>
    <option value="20">Musim 2</option>
    <option value="30">Musim 3</option>
  </select>
  <label for="floatingSelect">Musim Panen</label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="LUAS" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Luas Tambak (M²) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="QTY_TANAM" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Nanam (Rean) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="LAMA" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Lama Memelihara (Hari) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="PAKAN" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Pakan (Kg) </label>
</div>
<div class="form-floating mb-3">
  <input type="number" name="HASIL_PANEN" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Hasil Panen (Kg) </label>
</div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection