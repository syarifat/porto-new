@extends('admin.layout')
@section('title', 'Manajemen Proyek')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <div>
        <p style="color:var(--text-secondary); font-size:0.875rem;">Kelola semua proyek portfolio Anda.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary" id="add-project-btn">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Proyek
    </a>
</div>

<div class="card">
    @if($projects->isEmpty())
        <div class="table-empty">
            <div>📂</div>
            <p>Belum ada proyek yang ditambahkan.</p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary" style="margin-top:1rem;" id="add-first-project">Tambah Proyek Pertama</a>
        </div>
    @else
        <div class="table-container">
            <table class="admin-table" id="projects-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Proyek</th>
                        <th>Mitra</th>
                        <th>Periode</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $i => $project)
                    <tr>
                        <td style="color:var(--text-muted);font-size:0.8rem;">{{ $i + 1 }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $project->title }}</div>
                            @if($project->tech_stack)
                                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:0.2rem;">{{ Str::limit($project->tech_stack, 50) }}</div>
                            @endif
                        </td>
                        <td>
                            @if($project->partner_logo)
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <img src="{{ asset('storage/' . $project->partner_logo) }}" alt="{{ $project->partner_name }}" style="width:28px;height:28px;object-fit:contain;border-radius:4px;background:rgba(255,255,255,0.05);">
                                    <span style="font-size:0.85rem;">{{ $project->partner_name }}</span>
                                </div>
                            @else
                                {{ $project->partner_name ?? '—' }}
                            @endif
                        </td>
                        <td style="font-size:0.82rem;white-space:nowrap;">
                            {{ $project->start_date->format('d M Y') }}<br>
                            <span style="color:var(--text-muted);">
                                – {{ $project->end_date ? $project->end_date->format('d M Y') : 'Sekarang' }}
                            </span>
                        </td>
                        <td>{{ $project->category ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $project->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                                {{ $project->status === 'completed' ? '✓ Selesai' : '⏳ Berlangsung' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm" id="edit-project-{{ $project->id }}">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <button onclick="confirmDelete('{{ route('admin.projects.destroy', $project) }}')" class="btn btn-danger btn-sm" id="delete-project-{{ $project->id }}">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
