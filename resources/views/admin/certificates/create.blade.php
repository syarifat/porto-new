@extends('admin.layout')
@section('title', 'Tambah Sertifikat')

@section('content')
<div style="margin-bottom:1.5rem;">
    <a href="{{ route('admin.certificates.index') }}" style="display:inline-flex;align-items:center;gap:0.4rem;color:var(--text-muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'" id="back-to-certs">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Daftar Sertifikat
    </a>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-header">
        <span class="card-title">🏆 Tambah Sertifikat Baru</span>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" id="cert-form">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Sertifikat <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Contoh: Certified Network Associate" value="{{ old('title') }}">
                @error('title') <div class="form-error">⚠ {{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="issued_by">Dikeluarkan Oleh</label>
                    <input type="text" id="issued_by" name="issued_by" class="form-control" placeholder="Contoh: Cisco, Google, Coursera" value="{{ old('issued_by') }}">
                    @error('issued_by') <div class="form-error">⚠ {{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="issued_date">Tanggal Diterbitkan</label>
                    <input type="date" id="issued_date" name="issued_date" class="form-control" value="{{ old('issued_date') }}">
                    @error('issued_date') <div class="form-error">⚠ {{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="credential_id">ID Kredensial</label>
                    <input type="text" id="credential_id" name="credential_id" class="form-control" placeholder="Contoh: ABC123" value="{{ old('credential_id') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="credential_url">URL Verifikasi</label>
                    <input type="url" id="credential_url" name="credential_url" class="form-control" placeholder="https://..." value="{{ old('credential_url') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Gambar Sertifikat <span class="required">*</span></label>
                <div class="file-upload-area">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage('image', 'cert-preview')">
                    <div class="file-upload-icon">📜</div>
                    <div class="file-upload-text">Klik atau seret gambar sertifikat ke sini</div>
                    <div class="file-upload-hint">JPG, PNG, WebP – maks. 5MB</div>
                </div>
                <div class="image-preview" id="cert-preview">
                    <img src="" alt="Preview Sertifikat">
                </div>
                @error('image') <div class="form-error">⚠ {{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:0.75rem;justify-content:flex-end;padding-top:0.5rem;">
                <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary" id="cancel-cert">Batal</a>
                <button type="submit" class="btn btn-primary" id="submit-cert">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Sertifikat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
