@extends('layouts.operator')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Ekstrakurikuler</h1>

        <form action="{{ route('operator.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul" required>
            </div>

            <div class="mb-3">
                <label for="pembina" class="form-label">Pembina</label>
                <input type="text" class="form-control" id="pembina" name="pembina" required>
            </div>

            <div class="mb-3">
                <label for="jadwal_latihan" class="form-label">Jadwal Latihan</label>
                <input type="text" class="form-control" id="jadwal_latihan" name="jadwal_latihan" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('operator.ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection