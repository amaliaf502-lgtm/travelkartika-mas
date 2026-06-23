@extends('layouts.app')

@section('title', 'Lengkapi Data Jamaah - Kartika Mas Tour & Travel')

@section('content')
<style>
    .manifest-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        border: 1px solid rgba(139,45,45,0.05);
        overflow: hidden;
    }
    .selection-card {
        border: 2px solid #eee;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
    }
    .selection-card:hover {
        border-color: var(--gold);
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(218,165,32,0.15) !important;
    }
    .form-check-input:checked ~ .form-check-label {
        color: var(--primary);
    }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .manifest-header {
        background: var(--primary);
        color: white;
        padding: 15px;
        text-align: center;
    }
    .nav-tabs-manifest {
        border: none;
        background: #f8f9fa;
        padding: 10px 20px 0;
    }
    .nav-tabs-manifest .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 10px 10px 0 0;
    }
    .nav-tabs-manifest .nav-link.active {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
    }
    .form-section {
        padding: 15px;
    }
    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }
    .input-group-text {
        background: #f8f9fa;
        color: var(--primary);
    }
    .doc-preview {
        width: 100%;
        height: 180px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed #cbd5e1;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .doc-preview-wide {
        height: 150px;
    }
    .doc-preview:hover {
        border-color: var(--primary);
        background: #f8faff;
    }
    .doc-preview img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 5px;
    }

    .biodata-infocard {
        background: linear-gradient(135deg, #fdf6ec, #fff8f0);
        border: 1px solid rgba(139,0,0,0.12);
        border-left: 4px solid var(--primary);
        border-radius: 12px;
        padding: 10px 15px;
    }
    .info-field {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .info-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888;
    }
    .info-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
    }
    .nav-tabs-manifest .nav-link.tab-locked {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f0f0f0;
        color: #999;
    }
    .nav-tabs-manifest .nav-link.tab-unlocked {
        opacity: 1;
        cursor: pointer;
        color: #555;
    }
    .nav-tabs-manifest .nav-link.tab-unlocked:hover {
        background: rgba(139,0,0,0.08);
        color: var(--primary);
    }
    .lock-icon { font-size: 0.8rem; }
    .tab-step-done i.lock-icon { display: none; }

    /* Override Bootstrap is-invalid styling */
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #ced4da !important;
        background-image: none !important;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="manifest-card">
                <div class="manifest-header">
                    <h5 class="mb-1">Lengkapi Data Jamaah</h5>
                    <p class="mb-0" style="font-size: 0.85rem;">Silakan lengkapi biodata dan upload dokumen pendukung untuk paket: <strong>{{ $pemesanan->paket->nama_paket }}</strong></p>
                </div>

                <form action="{{ route('pemesanans.update-manifest', $pemesanan) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @php
                        $biodataFilled = $pemesanan->nama_ayah && $pemesanan->nama_ibu && $pemesanan->tanggal_lahir;
                        $dokumenFilled = $pemesanan->file_foto || $pemesanan->file_ktp || $pemesanan->file_paspor;
                    @endphp
                    <ul class="nav nav-tabs nav-tabs-manifest" id="manifestTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata" type="button" role="tab">
                                1. Biodata Lengkap
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $biodataFilled ? 'tab-unlocked' : 'tab-locked' }}"
                                id="dokumen-tab"
                                data-bs-target="#dokumen"
                                type="button" role="tab"
                                {{ $biodataFilled ? '' : 'disabled' }}
                                {{ $biodataFilled ? 'data-bs-toggle=tab' : '' }}
                                title="{{ $biodataFilled ? '2. Dokumen Digital' : 'Harap lengkapi Biodata terlebih dahulu' }}">
                                2. Dokumen Digital
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $biodataFilled ? 'tab-unlocked' : 'tab-locked' }}"
                                id="pembayaran-tab"
                                data-bs-target="#pembayaran"
                                type="button" role="tab"
                                {{ $biodataFilled ? '' : 'disabled' }}
                                {{ $biodataFilled ? 'data-bs-toggle=tab' : '' }}
                                title="{{ $biodataFilled ? '3. Konfirmasi Data' : 'Harap lengkapi Biodata terlebih dahulu' }}">
                                3. Konfirmasi Data
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="manifestTabsContent">
                        {{-- Tab 1: Biodata --}}
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel">
                            <div class="form-section">

                                {{-- Info Card: Paket & Jamaah (read-only) --}}
                                <div class="biodata-infocard mb-3">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="info-field">
                                                <span class="info-label">Paket Umroh</span>
                                                <span class="info-value">{{ $pemesanan->paket->nama_paket }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-field">
                                                <span class="info-label">Keberangkatan</span>
                                                <span class="info-value">{{ $pemesanan->paket->tanggal_berangkat->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="info-field">
                                                <span class="info-label">Durasi</span>
                                                <span class="info-value">{{ $pemesanan->paket->durasi_hari }} Hari</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-field">
                                                <span class="info-label">Nama Pemesan</span>
                                                <span class="info-value">{{ Auth::user()->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row g-2">
                                    {{-- Nama Ayah --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Nama Ayah Kandung
                                        </label>
                                        <input type="text" name="nama_ayah"
                                            class="form-control @error('nama_ayah') is-invalid @enderror"
                                            value="{{ old('nama_ayah', $pemesanan->nama_ayah) }}"
                                            required>
                                        @error('nama_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Nama Ibu --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Nama Ibu Kandung
                                        </label>
                                        <input type="text" name="nama_ibu"
                                            class="form-control @error('nama_ibu') is-invalid @enderror"
                                            value="{{ old('nama_ibu', $pemesanan->nama_ibu) }}"
                                            required>
                                        @error('nama_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Tempat Lahir --}}
                                    <div class="col-md-5">
                                        <label class="form-label fw-semibold">
                                            Tempat Lahir
                                        </label>
                                        <input type="text" name="tempat_lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            value="{{ old('tempat_lahir', $pemesanan->tempat_lahir) }}"
                                            required>
                                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Tanggal Lahir --}}
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Tanggal Lahir
                                        </label>
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir', $pemesanan->tanggal_lahir ? $pemesanan->tanggal_lahir->format('Y-m-d') : '') }}"
                                            required>
                                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Jenis Kelamin
                                        </label>
                                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">Pilih...</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $pemesanan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $pemesanan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Pekerjaan --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Pekerjaan
                                        </label>
                                        <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            <option value="Pegawai Negeri Sipil (PNS)" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>Pegawai Negeri Sipil (PNS)</option>
                                            <option value="TNI / POLRI" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'TNI / POLRI' ? 'selected' : '' }}>TNI / POLRI</option>
                                            <option value="Pegawai Swasta" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Pegawai Swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                                            <option value="Wiraswasta / Pengusaha" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Wiraswasta / Pengusaha' ? 'selected' : '' }}>Wiraswasta / Pengusaha</option>
                                            <option value="Petani / Nelayan" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Petani / Nelayan' ? 'selected' : '' }}>Petani / Nelayan</option>
                                            <option value="Dokter / Tenaga Kesehatan" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Dokter / Tenaga Kesehatan' ? 'selected' : '' }}>Dokter / Tenaga Kesehatan</option>
                                            <option value="Guru / Dosen" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Guru / Dosen' ? 'selected' : '' }}>Guru / Dosen</option>
                                            <option value="Pelajar / Mahasiswa" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                                            <option value="Ibu Rumah Tangga" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                            <option value="Pensiunan" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                            <option value="Tidak Bekerja" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                            <option value="Lainnya" {{ old('pekerjaan', $pemesanan->pekerjaan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Status Perkawinan --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Status Perkawinan
                                        </label>
                                        <select name="status_nikah" class="form-select @error('status_nikah') is-invalid @enderror" required>
                                            <option value="">Pilih...</option>
                                            <option value="Belum Menikah" {{ old('status_nikah', $pemesanan->status_nikah) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                            <option value="Menikah" {{ old('status_nikah', $pemesanan->status_nikah) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Cerai" {{ old('status_nikah', $pemesanan->status_nikah) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                        </select>
                                        @error('status_nikah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Status Jamaah --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Status Jamaah
                                        </label>
                                        <select name="status_jamaah" class="form-select @error('status_jamaah') is-invalid @enderror" required>
                                            <option value="">Pilih...</option>
                                            <option value="Jamaah" {{ old('status_jamaah', $pemesanan->status_jamaah) == 'Jamaah' ? 'selected' : '' }}>Jamaah</option>
                                            <option value="Ketua Rombongan" {{ old('status_jamaah', $pemesanan->status_jamaah) == 'Ketua Rombongan' ? 'selected' : '' }}>Ketua Rombongan</option>
                                            <option value="Mahram" {{ old('status_jamaah', $pemesanan->status_jamaah) == 'Mahram' ? 'selected' : '' }}>Mahram</option>
                                        </select>
                                        @error('status_jamaah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary px-4" onclick="validateAndNext('biodata', 'dokumen-tab')">
                                        Lanjut ke Dokumen <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Tab 2: Dokumen --}}
                        <div class="tab-pane fade" id="dokumen" role="tabpanel">
                            <div class="form-section">
                                <div class="alert alert-warning mb-4 shadow-sm border-0" style="background-color: #fff3cd; color: #856404; border-left: 5px solid #ffeeba !important;">
                                    <i class="fas fa-info-circle me-2"></i> Pastikan dokumen terlihat jelas (tidak buram) dan berformat Gambar (JPG/PNG). Maksimal 2MB per file.
                                </div>
                                
                                <div class="row g-3">
                                    {{-- Pas Foto --}}
                                    <div class="col">
                                        <div class="border rounded-3 text-center p-2 h-100 d-flex flex-column justify-content-start bg-white" style="border-color: #e9ecef !important;">
                                            <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.95rem;">Pas Foto</label>
                                            <div class="doc-preview mx-auto mb-2 d-flex align-items-center justify-content-center rounded p-2" id="p-foto" style="background-color: #f8f9fa; flex: 1; width: 100%;">
                                                @if($pemesanan->file_foto)
                                                    <img src="{{ asset($pemesanan->file_foto) }}" class="img-fluid rounded" style="max-height: 120px; width: auto; object-fit: contain;">
                                                @else
                                                    <i class="fas fa-image fa-2x text-muted opacity-50"></i>
                                                @endif
                                            </div>
                                            <input type="file" name="file_foto" class="form-control form-control-sm" onchange="previewImg(this, 'p-foto')">
                                        </div>
                                    </div>

                                    {{-- KTP --}}
                                    <div class="col">
                                        <div class="border rounded-3 text-center p-2 h-100 d-flex flex-column justify-content-start bg-white" style="border-color: #e9ecef !important;">
                                            <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.95rem;">KTP</label>
                                            <div class="doc-preview mx-auto mb-2 d-flex align-items-center justify-content-center rounded p-2" id="p-ktp" style="background-color: #f8f9fa; flex: 1; width: 100%;">
                                                @if($pemesanan->file_ktp)
                                                    <img src="{{ asset($pemesanan->file_ktp) }}" class="img-fluid rounded" style="max-height: 120px; width: auto; object-fit: contain;">
                                                @else
                                                    <i class="fas fa-id-card fa-2x text-muted opacity-50"></i>
                                                @endif
                                            </div>
                                            <input type="file" name="file_ktp" class="form-control form-control-sm" onchange="previewImg(this, 'p-ktp')">
                                        </div>
                                    </div>
                                    
                                    {{-- KK --}}
                                    <div class="col">
                                        <div class="border rounded-3 text-center p-2 h-100 d-flex flex-column justify-content-start bg-white" style="border-color: #e9ecef !important;">
                                            <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.95rem;">KK</label>
                                            <div class="doc-preview mx-auto mb-2 d-flex align-items-center justify-content-center rounded p-2" id="p-kk" style="background-color: #f8f9fa; flex: 1; width: 100%;">
                                                @if($pemesanan->file_kk)
                                                    <img src="{{ asset($pemesanan->file_kk) }}" class="img-fluid rounded" style="max-height: 120px; width: auto; object-fit: contain;">
                                                @else
                                                    <i class="fas fa-file-alt fa-2x text-muted opacity-50"></i>
                                                @endif
                                            </div>
                                            <input type="file" name="file_kk" class="form-control form-control-sm" onchange="previewImg(this, 'p-kk')">
                                        </div>
                                    </div>

                                    {{-- Paspor --}}
                                    <div class="col">
                                        <div class="border rounded-3 text-center p-2 h-100 d-flex flex-column justify-content-start bg-white" style="border-color: #e9ecef !important;">
                                            <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.95rem;">Paspor</label>
                                            <div class="doc-preview mx-auto mb-2 d-flex align-items-center justify-content-center rounded p-2" id="p-paspor" style="background-color: #f8f9fa; flex: 1; width: 100%;">
                                                @if($pemesanan->file_paspor)
                                                    <img src="{{ asset($pemesanan->file_paspor) }}" class="img-fluid rounded" style="max-height: 120px; width: auto; object-fit: contain;">
                                                @else
                                                    <i class="fas fa-passport fa-2x text-muted opacity-50"></i>
                                                @endif
                                            </div>
                                            <input type="file" name="file_paspor" class="form-control form-control-sm" onchange="previewImg(this, 'p-paspor')">
                                        </div>
                                    </div>

                                        <div class="col">
                                            <div class="border rounded-3 text-center p-2 h-100 d-flex flex-column justify-content-start bg-white" style="border-color: #e9ecef !important;">
                                                <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.95rem;">Surat Nikah</label>
                                                <div class="doc-preview mx-auto mb-2 d-flex align-items-center justify-content-center rounded p-2" id="p-nikah" style="background-color: #f8f9fa; flex: 1; width: 100%;">
                                                    @if($pemesanan->file_surat_nikah)
                                                        <img src="{{ asset($pemesanan->file_surat_nikah) }}" class="img-fluid rounded" style="max-height: 120px; width: auto; object-fit: contain;">
                                                    @else
                                                        <i class="fas fa-file-contract fa-2x text-muted opacity-50"></i>
                                                    @endif
                                                </div>
                                                <input type="file" name="file_surat_nikah" class="form-control form-control-sm" onchange="previewImg(this, 'p-nikah')">
                                            </div>
                                        </div>
                                    </div>

                                <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary px-4 fw-bold" onclick="switchTab('biodata-tab')"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                                    <button type="button" class="btn btn-primary px-4 fw-bold" onclick="validateAndNext('dokumen', 'pembayaran-tab')">
                                        Lanjut ke Konfirmasi <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Tab 3: Konfirmasi --}}
                        <div class="tab-pane fade" id="pembayaran" role="tabpanel">
                            <div class="form-section text-center py-4">
                                <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                                <h4 class="fw-bold mb-3">Konfirmasi Data Jamaah</h4>
                                <p class="text-muted mb-4">Pastikan biodata dan dokumen yang Anda unggah sudah benar.<br>Setelah menyimpan data, Anda dapat melanjutkan ke proses pembayaran melalui halaman detail pemesanan.</p>

                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <button type="button" class="btn btn-outline-secondary px-4" onclick="switchTab('dokumen-tab')"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                                    <button type="submit" class="btn btn-success px-5 fw-bold shadow-sm">
                                        <i class="fas fa-save me-2"></i> Simpan Data Jamaah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
    .custom-radio-label {
        cursor: pointer;
    }
    .custom-radio-label .card {
        transition: all 0.2s ease-in-out;
        border: 2px solid #e0e0e0;
        background-color: #fff;
    }
    .custom-radio-label:hover .card {
        border-color: var(--primary);
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.05) !important;
    }
    .custom-radio:checked + .custom-radio-label .card {
        border-color: var(--primary);
        background-color: #fffafa;
        box-shadow: 0 4px 15px rgba(139,45,45,0.15) !important;
    }
    .radio-circle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #ccc;
        position: relative;
        transition: all 0.2s;
    }
    .custom-radio:checked + .custom-radio-label .radio-circle {
        border-color: var(--primary);
    }
    .custom-radio:checked + .custom-radio-label .radio-circle::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--primary);
    }
</style>

<script>
    function previewImg(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).innerHTML = '<img src="' + e.target.result + '">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleCustomNominal() {
        const customContainer = document.getElementById('custom_nominal_container');
        const customInput = document.getElementById('custom_nominal');
        if (document.getElementById('opt_custom').checked) {
            customContainer.style.display = 'block';
            customInput.setAttribute('required', 'required');
        } else {
            customContainer.style.display = 'none';
            customInput.removeAttribute('required');
        }
    }

    function formatRupiah(angka) {
        let number_string = angka.value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        angka.value = rupiah;
    }

    function switchTab(tabId) {
        const tabEl = document.getElementById(tabId);
        // Enable temporarily to allow bootstrap to activate
        tabEl.removeAttribute('disabled');
        tabEl.setAttribute('data-bs-toggle', 'tab');
        tabEl.click();
        
        setTimeout(() => {
            const card = document.querySelector('.manifest-card');
            if(card) {
                const headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-offset')) || 140;
                const elementPosition = card.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset - 20;
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
            }
        }, 150);
    }

    function validateAndNext(currentTab, nextTabId) {
        let isValid = true;
        let firstInvalid = null;

        if (currentTab === 'biodata') {
            // Validate all required fields in biodata tab
            const required = document.querySelectorAll('#biodata input[required], #biodata select[required], #biodata textarea[required]');
            required.forEach(field => {
                field.classList.remove('is-invalid');
                let existingFeedback = field.parentNode.querySelector('.js-feedback');
                if(existingFeedback) existingFeedback.remove();

                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    let feedback = document.createElement('div');
                    feedback.className = 'text-danger small mt-1 js-feedback fw-bold';
                    feedback.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Wajib diisi';
                    field.parentNode.appendChild(feedback);
                    
                    isValid = false;
                    if (!firstInvalid) firstInvalid = field;
                }
            });
        } else if (currentTab === 'dokumen') {
            // Dokumen tab: file upload is optional (no required), just proceed
            isValid = true;
        }

        if (!isValid) {
            // Shake animation on first invalid field
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }

            // Show toast notification
            showToast('⚠️ Harap lengkapi semua data yang wajib diisi sebelum melanjutkan!', 'warning');
            return;
        }

        // Unlock the next tab
        const nextTab = document.getElementById(nextTabId);
        nextTab.classList.remove('tab-locked');
        nextTab.classList.add('tab-unlocked');

        switchTab(nextTabId);
    }

    function showToast(message, type) {
        const existing = document.getElementById('tab-toast');
        if (existing) existing.remove();

        const color = type === 'warning' ? '#f39c12' : '#27ae60';
        const toast = document.createElement('div');
        toast.id = 'tab-toast';
        toast.style.cssText = `
            position: fixed; top: 100px; left: 50%; transform: translateX(-50%);
            background: ${color}; color: #fff;
            padding: 14px 28px; border-radius: 50px;
            font-weight: 700; font-size: 0.95rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            z-index: 9999; animation: slideDown 0.3s ease;
        `;
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => { if(toast.parentNode) toast.remove(); }, 3500);
    }
</script>
@endsection
