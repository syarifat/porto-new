@extends('admin.layout')
@section('title', 'Manajemen Sertifikat')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <div>
        <p style="color:var(--text-secondary); font-size:0.875rem;">Seret baris untuk mengatur urutan tampilan di landing page.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary" id="add-cert-btn">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Sertifikat
    </a>
</div>

<!-- Toast notification -->
<div id="sort-toast" style="
    position:fixed; bottom:2rem; right:2rem; z-index:9999;
    background:#171714; border:1px solid rgba(217,119,6,0.4);
    color:#e8e6e0; padding:0.75rem 1.25rem; border-radius:10px;
    font-size:0.85rem; font-weight:600; display:flex; align-items:center; gap:0.5rem;
    box-shadow:0 8px 24px rgba(0,0,0,0.4); opacity:0; transition:opacity 0.3s ease;
    pointer-events:none;
">
    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
    Urutan berhasil disimpan
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
<div class="card" style="padding:0; overflow:hidden;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:1px solid var(--border);">
                <th style="padding:0.85rem 1rem; width:44px; text-align:center; color:var(--text-secondary); font-size:0.75rem; font-weight:600;"></th>
                <th style="padding:0.85rem 0.5rem; width:36px; text-align:center; color:var(--text-secondary); font-size:0.75rem; font-weight:600;">#</th>
                <th style="padding:0.85rem 1rem; width:64px; color:var(--text-secondary); font-size:0.75rem; font-weight:600;">FOTO</th>
                <th style="padding:0.85rem 1rem; color:var(--text-secondary); font-size:0.75rem; font-weight:600;">SERTIFIKAT</th>
                <th style="padding:0.85rem 1rem; width:130px; color:var(--text-secondary); font-size:0.75rem; font-weight:600;">TANGGAL</th>
                <th style="padding:0.85rem 1rem; width:110px; text-align:right; color:var(--text-secondary); font-size:0.75rem; font-weight:600;">AKSI</th>
            </tr>
        </thead>
        <tbody id="cert-sortable">
            @foreach($certificates as $i => $cert)
            <tr data-id="{{ $cert->id }}" class="cert-row" style="border-bottom:1px solid var(--border); transition:background 0.15s;">
                <td style="padding:0.75rem 1rem; text-align:center; cursor:grab; color:var(--text-secondary);">
                    <span class="drag-handle" title="Seret untuk ubah urutan">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" opacity="0.5">
                            <circle cx="9" cy="6" r="1.5"/><circle cx="15" cy="6" r="1.5"/>
                            <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                            <circle cx="9" cy="18" r="1.5"/><circle cx="15" cy="18" r="1.5"/>
                        </svg>
                    </span>
                </td>
                <td style="padding:0.75rem 0.5rem; text-align:center; color:var(--text-secondary); font-size:0.8rem; font-weight:600;" class="row-num">{{ $i + 1 }}</td>
                <td style="padding:0.75rem 1rem;">
                    <img
                        src="{{ $cert->image_url }}"
                        alt="{{ $cert->title }}"
                        style="width:56px; height:40px; object-fit:cover; border-radius:6px; background:var(--bg-input); display:block;"
                        onerror="this.outerHTML='<div style=\'width:56px;height:40px;border-radius:6px;background:linear-gradient(135deg,var(--bg-input),rgba(217,119,6,0.1));display:flex;align-items:center;justify-content:center;font-size:1.2rem;\'>🏆</div>'"
                    >
                </td>
                <td style="padding:0.75rem 1rem;">
                    <div style="font-weight:600; font-size:0.875rem; margin-bottom:0.2rem; line-height:1.3;">{{ $cert->title }}</div>
                    @if($cert->issued_by)
                        <div style="font-size:0.78rem; color:var(--primary);">{{ $cert->issued_by }}</div>
                    @endif
                    @if($cert->credential_id)
                        <div style="font-size:0.72rem; color:var(--text-muted); margin-top:0.15rem;">ID: {{ $cert->credential_id }}</div>
                    @endif
                </td>
                <td style="padding:0.75rem 1rem; font-size:0.8rem; color:var(--text-secondary);">
                    {{ $cert->issued_date ? $cert->issued_date->format('d M Y') : '—' }}
                </td>
                <td style="padding:0.75rem 1rem; text-align:right;">
                    <div style="display:flex; gap:0.4rem; justify-content:flex-end;">
                        <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn btn-secondary btn-sm" id="edit-cert-{{ $cert->id }}" title="Edit">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <button onclick="confirmDelete('{{ route('admin.certificates.destroy', $cert) }}')" class="btn btn-danger btn-sm" id="delete-cert-{{ $cert->id }}" title="Hapus">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<!-- SortableJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(function() {
    const tbody = document.getElementById('cert-sortable');
    if (!tbody) return;

    const toast = document.getElementById('sort-toast');
    let toastTimer;

    function showToast() {
        clearTimeout(toastTimer);
        toast.style.opacity = '1';
        toastTimer = setTimeout(() => { toast.style.opacity = '0'; }, 3000);
    }

    Sortable.create(tbody, {
        handle: '.drag-handle',
        animation: 160,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: function() {
            // Renumber the # column
            tbody.querySelectorAll('tr').forEach((row, i) => {
                const numCell = row.querySelector('.row-num');
                if (numCell) numCell.textContent = i + 1;
            });

            // Collect new order
            const order = Array.from(tbody.querySelectorAll('tr[data-id]')).map(tr => tr.dataset.id);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('{{ route("admin.certificates.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ order }),
            })
            .then(res => res.json())
            .then(data => { if (data.success) showToast(); })
            .catch(err => console.error('Reorder failed:', err));
        }
    });

    // Highlight row on hover
    tbody.querySelectorAll('tr.cert-row').forEach(row => {
        row.addEventListener('mouseenter', () => row.style.background = 'var(--bg-hover)');
        row.addEventListener('mouseleave', () => row.style.background = '');
    });
})();
</script>

<style>
.sortable-ghost  { opacity: 0.35; background: rgba(217,119,6,0.06) !important; }
.sortable-chosen { background: rgba(217,119,6,0.04) !important; box-shadow: 0 4px 16px rgba(0,0,0,0.3); }
.drag-handle:hover svg { opacity: 1; }
.drag-handle:hover { color: var(--primary); }
</style>
@endsection
