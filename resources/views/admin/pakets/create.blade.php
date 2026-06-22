@extends('layouts.admin')

@section('title', 'Tambah Paket Umroh - Admin Dashboard')

@section('content')
    <div class="page-title">
        <h2>Tambah Paket Umroh</h2>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Paket Umroh</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pakets.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket') }}" required>
                            @error('nama_paket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="durasi_hari" class="form-label">Durasi (Hari)</label>
                                    <input type="number" class="form-control @error('durasi_hari') is-invalid @enderror" id="durasi_hari" name="durasi_hari" value="{{ old('durasi_hari') }}" min="1" required>
                                    @error('durasi_hari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                                    </div>
                        </div>
<div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Quad (Rp)</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" min="0" step="1000" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="harga_triple" class="form-label">Harga Triple (Rp) <small class="text-muted">Opsional</small></label>
                                    <input type="number" class="form-control @error('harga_triple') is-invalid @enderror" id="harga_triple" name="harga_triple" value="{{ old('harga_triple') }}" min="0" step="1000">
                                    @error('harga_triple')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="harga_double" class="form-label">Harga Double (Rp) <small class="text-muted">Opsional</small></label>
                                    <input type="number" class="form-control @error('harga_double') is-invalid @enderror" id="harga_double" name="harga_double" value="{{ old('harga_double') }}" min="0" step="1000">
                                    @error('harga_double')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h6 class="mb-3 text-primary"><i class="fas fa-building"></i> Detail Hotel Makkah</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_makkah_nama" class="form-label">Nama Hotel</label>
                                    <input type="text" class="form-control @error('hotel_makkah_nama') is-invalid @enderror" id="hotel_makkah_nama" name="hotel_makkah_nama" value="{{ old('hotel_makkah_nama') }}">
                                    @error('hotel_makkah_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_makkah_bintang" class="form-label">Bintang (1-5)</label>
                                    <input type="number" class="form-control @error('hotel_makkah_bintang') is-invalid @enderror" id="hotel_makkah_bintang" name="hotel_makkah_bintang" value="{{ old('hotel_makkah_bintang', 5) }}" min="1" max="5">
                                    @error('hotel_makkah_bintang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_makkah_jarak" class="form-label">Jarak ke Pelataran</label>
                                    <input type="text" class="form-control @error('hotel_makkah_jarak') is-invalid @enderror" id="hotel_makkah_jarak" name="hotel_makkah_jarak" value="{{ old('hotel_makkah_jarak', '± 100m') }}" placeholder="Contoh: ± 100m">
                                    @error('hotel_makkah_jarak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h6 class="mb-3 mt-2 text-primary"><i class="fas fa-building"></i> Detail Hotel Madinah</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_madinah_nama" class="form-label">Nama Hotel</label>
                                    <input type="text" class="form-control @error('hotel_madinah_nama') is-invalid @enderror" id="hotel_madinah_nama" name="hotel_madinah_nama" value="{{ old('hotel_madinah_nama') }}">
                                    @error('hotel_madinah_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_madinah_bintang" class="form-label">Bintang (1-5)</label>
                                    <input type="number" class="form-control @error('hotel_madinah_bintang') is-invalid @enderror" id="hotel_madinah_bintang" name="hotel_madinah_bintang" value="{{ old('hotel_madinah_bintang', 5) }}" min="1" max="5">
                                    @error('hotel_madinah_bintang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hotel_madinah_jarak" class="form-label">Jarak ke Pelataran</label>
                                    <input type="text" class="form-control @error('hotel_madinah_jarak') is-invalid @enderror" id="hotel_madinah_jarak" name="hotel_madinah_jarak" value="{{ old('hotel_madinah_jarak', '± 100m') }}" placeholder="Contoh: ± 100m">
                                    @error('hotel_madinah_jarak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kuota" class="form-label">Kuota (Orang)</label>
                                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota" name="kuota" value="{{ old('kuota') }}" min="1" required>
                                    @error('kuota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="aktif" @if(old('status') === 'aktif') selected @endif>Aktif</option>
                                        <option value="nonaktif" @if(old('status') === 'nonaktif') selected @endif>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                                    @error('tanggal_berangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                                    @error('tanggal_kembali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fasilitas" class="form-label">Fasilitas</label>
                            <textarea class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas" rows="4" required>{{ old('fasilitas') }}</textarea>
                            @error('fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.pakets.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

