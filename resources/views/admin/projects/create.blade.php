@extends('admin.layout')
@section('title', 'Tambah Proyek')

@section('content')
<div style="margin-bottom:1.5rem;">
    <a href="{{ route('admin.projects.index') }}" style="display:inline-flex;align-items:center;gap:0.4rem;color:var(--text-muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'" id="back-to-projects">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Daftar Proyek
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-header">
        <span class="card-title">📁 Tambah Proyek Baru</span>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="project-form">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Proyek <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Contoh: Sistem Manajemen Inventaris" value="{{ old('title') }}">
                @error('title') <div class="form-error">⚠ {{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi Proyek <span class="required">*</span></label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Deskripsikan proyek ini secara singkat...">{{ old('description') }}</textarea>
                @error('description') <div class="form-error">⚠ {{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="start_date">Tanggal Mulai <span class="required">*</span></label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                    @error('start_date') <div class="form-error">⚠ {{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="end_date">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                    <div class="form-hint">Kosongkan jika masih berlangsung.</div>
                    @error('end_date') <div class="form-error">⚠ {{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="partner_name">Nama Mitra / Klien</label>
                    <input type="text" id="partner_name" name="partner_name" class="form-control" placeholder="Contoh: PT. Maju Bersama" value="{{ old('partner_name') }}">
                    @error('partner_name') <div class="form-error">⚠ {{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status Proyek <span class="required">*</span></label>
                    <select id="status" name="status" class="form-control">
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>✓ Selesai</option>
                        <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>⏳ Berlangsung</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="category">Kategori</label>
                    <input type="text" id="category" name="category" class="form-control" placeholder="Contoh: Web Development, IoT" value="{{ old('category') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="tech_stack">Tech Stack</label>
                    <input type="text" id="tech_stack" name="tech_stack" class="form-control" placeholder="Contoh: Laravel, MySQL, ESP32" value="{{ old('tech_stack') }}">
                    <div class="form-hint">Pisahkan dengan koma untuk tampil sebagai tag.</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="partner_logo">Logo Mitra <span style="color:var(--text-muted);font-weight:normal;">(Opsional)</span></label>
                <div class="file-upload-area" id="logo-drop">
                    <input type="file" id="partner_logo" name="partner_logo" accept="image/*" onchange="previewImage('partner_logo', 'logo-preview')">
                    <div class="file-upload-icon">🖼️</div>
                    <div class="file-upload-text">Klik atau seret gambar ke sini</div>
                    <div class="file-upload-hint">JPG, PNG, SVG, WebP – maks. 2MB</div>
                </div>
                <div class="image-preview" id="logo-preview">
                    <img src="" alt="Preview Logo">
                </div>
                @error('partner_logo') <div class="form-error">⚠ {{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:0.75rem;justify-content:flex-end;padding-top:0.5rem;">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary" id="cancel-btn">Batal</a>
                <button type="submit" class="btn btn-primary" id="submit-project">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Proyek
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
