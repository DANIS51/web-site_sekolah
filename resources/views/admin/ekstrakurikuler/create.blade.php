@extends('layouts.admin')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Tambah Ekstrakurikuler</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Ekstrakurikuler</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pembina" class="form-label">Pembina <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pembina" name="pembina" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jadwal_latihan" class="form-label">Jadwal Latihan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="jadwal_latihan" name="jadwal_latihan"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i> Simpan Ekstrakurikuler
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