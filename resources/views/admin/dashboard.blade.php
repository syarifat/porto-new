@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div style="margin-bottom: 2rem;">
    <p style="color: var(--text-secondary); font-size: 0.9rem;">Selamat datang kembali, <strong style="color: var(--text)">{{ session('admin_username') }}</strong>! Kelola portfolio Anda dari sini.</p>
</div>

<!-- Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <div class="card" style="padding: 1.5rem; border-top: 3px solid #6366f1;">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;">📁</div>
            <div>
                <div style="font-size:2rem;font-family:'Space Grotesk',sans-serif;font-weight:700;line-height:1;">{{ $totalProjects }}</div>
                <div style="font-size:0.8rem;color:var(--text-muted);margin-top:0.15rem;">Total Proyek</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 1.5rem; border-top: 3px solid #8b5cf6;">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(139,92,246,0.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;">🏆</div>
            <div>
                <div style="font-size:2rem;font-family:'Space Grotesk',sans-serif;font-weight:700;line-height:1;">{{ $totalCertificates }}</div>
                <div style="font-size:0.8rem;color:var(--text-muted);margin-top:0.15rem;">Sertifikat</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 1.5rem; border-top: 3px solid #06b6d4;">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(6,182,212,0.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;">🤝</div>
            <div>
                <div style="font-size:2rem;font-family:'Space Grotesk',sans-serif;font-weight:700;line-height:1;">{{ $totalClients }}</div>
                <div style="font-size:0.8rem;color:var(--text-muted);margin-top:0.15rem;">Klien dengan Logo</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions + Recent Projects -->
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;" class="dash-grid">
    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Aksi Cepat</span>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:0.75rem;">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary" style="justify-content:center;" id="quick-add-project">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Proyek Baru
            </a>
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-secondary" style="justify-content:center;" id="quick-add-cert">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Sertifikat
            </a>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="justify-content:center;" id="quick-view-site">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Website
            </a>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Proyek Terbaru</span>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        @if($recentProjects->isEmpty())
            <div class="table-empty">
                <div>📂</div>
                <p>Belum ada proyek.</p>
            </div>
        @else
            <div class="table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Mitra</th>
                            <th>Periode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentProjects as $project)
                        <tr>
                            <td style="font-weight:500;">{{ Str::limit($project->title, 30) }}</td>
                            <td>{{ $project->partner_name ?? '—' }}</td>
                            <td style="font-size:0.8rem;">
                                {{ $project->start_date->format('M Y') }}
                                @if($project->end_date) – {{ $project->end_date->format('M Y') }} @else – Skrg @endif
                            </td>
                            <td>
                                <span class="badge {{ $project->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $project->status === 'completed' ? 'Selesai' : 'Berlangsung' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .dash-grid { grid-template-columns: 1fr !important; }
    }
</style>
@endsection
