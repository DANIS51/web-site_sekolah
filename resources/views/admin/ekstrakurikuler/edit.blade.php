@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Edit Ekstrakurikuler</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Ekstrakurikuler</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id_ekskul) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul"
                                    value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pembina" class="form-label">Pembina <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pembina" name="pembina"
                                            value="{{ old('pembina', $ekstrakurikuler->pembina) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jadwal_latihan" class="form-label">Jadwal Latihan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="jadwal_latihan" name="jadwal_latihan"
                                            value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                    required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{ old('tanggal', $ekstrakurikuler->tanggal instanceof \Carbon\Carbon ? $ekstrakurikuler->tanggal->format('Y-m-d') : '') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        @if($ekstrakurikuler->gambar)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                                    alt="{{ $ekstrakurikuler->nama_ekskul }}" class="img-fluid rounded"
                                                    style="max-width: 150px; height: auto;" />
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i> Update Ekstrakurikuler
                                </button>
                                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection