@extends('admin.layout')
@section('title', 'Manajemen Sertifikat')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <div>
        <p style="color:var(--text-secondary); font-size:0.875rem;">Kelola sertifikat dan penghargaan Anda.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary" id="add-cert-btn">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Sertifikat
    </a>
</div>

@if($certificates->isEmpty())
    <div class="card">
        <div class="table-empty">
            <div>🏆</div>
            <p>Belum ada sertifikat yang ditambahkan.</p>
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary" style="margin-top:1rem;" id="add-first-cert">Tambah Sertifikat Pertama</a>
        </div>
    </div>
@else
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap:1.25rem;">
        @foreach($certificates as $cert)
        <div class="card" style="overflow:hidden;" id="cert-card-{{ $cert->id }}">
            <div style="position:relative;">
                <img
                    src="{{ $cert->image_url }}"
                    alt="{{ $cert->title }}"
                    style="width:100%;height:160px;object-fit:cover;background:var(--bg-input);display:block;"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                >
                <div style="display:none;width:100%;height:160px;background:linear-gradient(135deg,var(--bg-input),rgba(99,102,241,0.1));align-items:center;justify-content:center;font-size:3rem;">🏆</div>
            </div>
            <div style="padding:1.25rem;">
                <div style="font-weight:600;margin-bottom:0.3rem;">{{ $cert->title }}</div>
                @if($cert->issued_by)
                    <div style="font-size:0.82rem;color:var(--primary);margin-bottom:0.25rem;">{{ $cert->issued_by }}</div>
                @endif
                @if($cert->issued_date)
                    <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:1rem;">{{ $cert->issued_date->format('d M Y') }}</div>
                @endif
                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn btn-secondary btn-sm" style="flex:1;justify-content:center;" id="edit-cert-{{ $cert->id }}">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <button onclick="confirmDelete('{{ route('admin.certificates.destroy', $cert) }}')" class="btn btn-danger btn-sm" id="delete-cert-{{ $cert->id }}">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
