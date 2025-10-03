@extends('layouts.operator')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="container mt-4">
        <h1>Edit Ekstrakurikuler</h1>

        <form action="{{ route('operator.ekstrakurikuler.update', Crypt::encrypt($ekstrakurikuler->id_ekskul)) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul"
                    value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
            </div>

            <div class="mb-3">
                <label for="pembina" class="form-label">Pembina</label>
                <input type="text" class="form-control" id="pembina" name="pembina"
                    value="{{ old('pembina', $ekstrakurikuler->pembina) }}" required>
            </div>

            <div class="mb-3">
                <label for="jadwal_latihan" class="form-label">Jadwal Latihan</label>
                <input type="text" class="form-control" id="jadwal_latihan" name="jadwal_latihan"
                    value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"
                    rows="3">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    value="{{ old('tanggal', $ekstrakurikuler->tanggal ? $ekstrakurikuler->tanggal->format('Y-m-d') : '') }}">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                @if($ekstrakurikuler->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}"
                            width="150" />
                    </div>
                @endif
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('operator.ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection