@extends('layouts.admin')

@section('title', 'Edit Jamaah - Admin')

@section('content')
<div class="page-title">
    <h2>Edit Data Jamaah</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.jamaah.update', $jamaah) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $jamaah->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $jamaah->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $jamaah->no_hp) }}">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle"></i> Kosongkan password jika tidak ingin mengubahnya.
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui Jamaah</button>
                <a href="{{ route('admin.jamaah.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
