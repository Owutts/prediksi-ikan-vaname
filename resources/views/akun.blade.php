@extends('template.appuser')
@section('title', 'Halaman Akun')
@section('data', 'active')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="text-center">Data Akun</h5>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
  Tambah Akun <i class="fa fa-plus" aria-hidden="true"></i>
</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email}}</td>
                        <td>{{ $data->level }}</td>
                        <td>
                            <!-- <a type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $data->id }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a> -->
                            <a type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id }}" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{url('akun/hapus/'.$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                        <p>apakah anda yakin ingin menghapus Akun dengan Username : <strong>{{$data->name}}</strong>  ini ?</p>
                 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
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
        <form action="{{url('akun/tambah')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
  <input type="text" name="nama" class="form-control" id="floatingYear" placeholder="2025" min="1900" max="2100">
  <label for="floatingYear">Username </label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="email" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Email </label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="password" class="form-control" id="floatingYear" placeholder="2025">
  <label for="floatingYear">Password</label>
</div>
<div class="form-floating mb-3">
  <select class="form-select" name="level" id="floatingSelect" aria-label="Floating label select example" required>
    <option value="" >-- Silahkan Pilih Level --</option>
    <option value="admin" >Admin</option>
    <option value="user" >User</option>
    
  </select>
  <label for="floatingSelect">Level</label>
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