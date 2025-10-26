@extends('template.appuser')
@section('title', 'Halaman Prediksi')
@section('prediksi', 'active')
@section('content')
@php
  // User melihat card; Admin tidak
  $isUser = auth()->check() && auth()->user()->level === 'user';
@endphp
<style>
.title {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 700;
  color: #111827;
}
.form { margin-top: 1.5rem; }
.input-group { margin-top: 1rem; font-size: 0.875rem; }
.input-group label { display: block; color: #4b5563; margin-bottom: 4px; }
.input-group select,
.input-group input {
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid #d1d5db;
  background-color: transparent;
  padding: 0.75rem 1rem;
  color: #111827;
}
.input-group select:focus,
.input-group input:focus { border-color: #a78bfa; outline: none; }
.sign {
  display: block;
  width: 100%;
  background-color: #a78bfa;
  padding: 0.75rem;
  text-align: center;
  color: #ffffff;
  border: none;
  border-radius: 0.375rem;
  font-weight: 600;
  margin-top: 1.5rem;
}
.form-container {
  width: 100%;
  border-radius: 0.75rem;
  background-color: #ffffff;
  padding: 2rem;
  color: #111827;
  border: 1px solid #e5e7eb;
  box-sizing: border-box;
}

/* Card keterangan di samping */
.info-card {
  width: 100%;
  border-radius: 0.75rem;
  background-color: #f9fafb;
  padding: 1.25rem 1.5rem;
  color: #111827;
  border: 1px solid #e5e7eb;
}
.info-card h3 {
  margin: 0 0 .5rem 0;
  font-size: 1.125rem;
  font-weight: 700;
}
.info-card p { margin-bottom: .75rem; }
.info-card ul { margin: 0 0 .75rem 1rem; padding: 0; }
.info-card li { margin-bottom: .5rem; }
@media (min-width: 992px) {
  .info-card.sticky { position: sticky; top: 1rem; }
}
</style>

{{-- Row: saat admin, center-kan isi row --}}
<div class="row g-4 {{ $isUser ? '' : 'justify-content-center' }}">
  {{-- Kolom Form: selalu col-lg-7.
       Saat admin (tanpa card), tambahkan mx-lg-auto agar kolom berada di tengah --}}
  <div class="col-12 col-lg-7 {{ $isUser ? '' : 'mx-lg-auto' }}">
    <div class="form-container">
      <p class="title">Form Prediksi Hasil Panen</p>
      <form class="form" method="POST" action="{{ url('hasil') }}" enctype="multipart/form-data">
        @csrf
        <!-- Musim Panen -->
        <div class="input-group">
          <label for="musim_panen">Musim Panen</label>
          <select name="musim_panen" id="musim_panen" required>
            <option value="" disabled selected>Pilih Musim Panen</option>
            <option value="10">Musim 1</option>
            <option value="20">Musim 2</option>
            <option value="30">Musim 3</option>
          </select>
        </div>

        <!-- Luas Tambak -->
        <div class="input-group">
          <label for="luas">Luas Tambak (m<sup>2</sup>)</label>
          <input type="number" name="luas" id="luas" min="0" placeholder="Contoh: 100" required>
        </div>

        <!-- Jumlah Nanam (Rean) -->
        <div class="input-group">
          <label for="qty_tanam">Jumlah Nanam (Rean)</label>
          <input type="number" name="qty_tanam" id="qty_tanam" min="0" placeholder="Contoh: 15" required>
        </div>

        <!-- Lama Pemeliharaan -->
        <div class="input-group">
          <label for="lama_pemeliharaan">Lama Pemeliharaan (Hari)</label>
          <input type="number" name="lama" id="lama_pemeliharaan" min="0" placeholder="Contoh: 60" required>
        </div>

        <!-- Pakan -->
        <div class="input-group">
          <label for="pakan">Pakan (Kg)</label>
          <input type="number" name="pakan" id="pakan" min="0" placeholder="Contoh: 80" required>
        </div>

        <!-- Nilai K (hidden) -->
        <input type="hidden" name="nilaik" value="3">

        <button type="submit" class="sign">Prediksi</button>
      </form>
    </div>
  </div>

  {{-- Kolom Card: hanya saat user --}}
  @if ($isUser)
    <div class="col-12 col-lg-5">
      <aside class="info-card sticky">
        <h3>Penjelasan Form Prediksi Hasil Panen</h3>
        <p>Isi form ini untuk memprediksi <strong>hasil panen</strong> berdasarkan variabel input Anda.</p>
        <ul>
          <li><strong>Musim Panen:</strong> Pilih periode musim (1–3) yang sesuai dengan waktu penanaman.</li>
          <li><strong>Luas Tambak (m²):</strong> Masukkan luas efektif kolam/tambak yang digunakan.</li>
          <li><strong>Jumlah Nanam (Rean):</strong> Jumlah rean/bibit yang ditebar.</li>
          <li><strong>Lama Pemeliharaan (Hari):</strong> Durasi pemeliharaan sampai panen.</li>
          <li><strong>Pakan (Kg):</strong> Total pakan yang dihabiskan selama pemeliharaan.</li>
        </ul>
      </aside>
    </div>
  @endif
</div>
@endsection
