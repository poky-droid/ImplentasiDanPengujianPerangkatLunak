@extends('layout.app')

@section('title', 'List Owner')
@section('page-title', 'List Owner')

@section('content')

<div class="table-section">
    <div class="table-header">
        <h2 class="section-title">Daftar Owner Kos</h2>
        <div style="display:flex; gap:12px; align-items:center; margin-left:auto;">
            <div class="search-box">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    type="text"
                    class="search-input"
                    placeholder="Cari Owner..."
                    oninput="filterTable(this.value)"
                >
            </div>
            <button class="btn btn-primary" onclick="openModal('modalTambahOwner')">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </button>
        </div>
    </div>

    <div class="table-wrapper">
        <table id="ownerTable">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>no.Hp</th>
                    <th>Bergabung</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($owners as $i => $owner)
                <tr data-search="{{ strtolower($owner->name . ' ' . $owner->email . ' ' . $owner->phone) }}">
                    <td class="td-muted">{{ $owners->firstItem() + $i }}</td>
                    <td style="font-weight:600;">{{ $owner->name }}</td>
                    <td class="td-muted">{{ $owner->email }}</td>
                    <td class="td-muted">{{ $owner->phone ?? '-' }}</td>
                    <td class="td-muted">{{ $owner->created_at->format('d M Y') }}</td>
                    <td>
                        @if($owner->status === 'aktif')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Non-aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <button class="btn-icon" title="Edit" onclick="editOwner({{ $owner->id }}, '{{ $owner->name }}', '{{ $owner->email }}', '{{ $owner->phone }}', '{{ $owner->status }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <button class="btn-icon danger" title="Hapus" onclick="hapusOwner({{ $owner->id }}, '{{ $owner->name }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#9ca3af; padding:40px;">Belum ada data owner</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($owners->hasPages())
    <div class="pagination">
        @if($owners->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $owners->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($owners->getUrlRange(1, $owners->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $owners->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($owners->hasMorePages())
            <a href="{{ $owners->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

<!-- MODAL TAMBAH OWNER -->
<div class="modal-overlay" id="modalTambahOwner">
    <div class="modal">
        <h3 class="modal-title">Tambah Owner Baru</h3>
        <form method="POST" action="{{ route('admin.owners.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input" placeholder="Masukkan nama..." required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="text" name="phone" class="form-input" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-aktif</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalTambahOwner')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT OWNER -->
<div class="modal-overlay" id="modalEditOwner">
    <div class="modal">
        <h3 class="modal-title">Edit Owner</h3>
        <form method="POST" id="editOwnerForm" action="">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="editOwnerName" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="editOwnerEmail" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="text" name="phone" id="editOwnerPhone" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" id="editOwnerStatus" class="form-select">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-aktif</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalEditOwner')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL HAPUS OWNER -->
<div class="modal-overlay" id="modalHapusOwner">
    <div class="modal" style="max-width:400px;">
        <h3 class="modal-title">Hapus Owner</h3>
        <p style="color:#6b7280; font-size:14px;">Yakin ingin menghapus owner <strong id="hapusOwnerNama"></strong>?</p>
        <form method="POST" id="hapusOwnerForm" action="">
            @csrf
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalHapusOwner')">Batal</button>
                <button type="submit" class="btn btn-primary" style="background:#ef4444;">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function filterTable(val) {
    document.querySelectorAll('#ownerTable tbody tr[data-search]').forEach(row => {
        row.style.display = row.dataset.search.includes(val.toLowerCase()) ? '' : 'none';
    });
}
function editOwner(id, name, email, phone, status) {
    document.getElementById('editOwnerName').value = name;
    document.getElementById('editOwnerEmail').value = email;
    document.getElementById('editOwnerPhone').value = phone;
    document.getElementById('editOwnerStatus').value = status;
    document.getElementById('editOwnerForm').action = `/admin/owners/${id}`;
    openModal('modalEditOwner');
}
function hapusOwner(id, name) {
    document.getElementById('hapusOwnerNama').textContent = name;
    document.getElementById('hapusOwnerForm').action = `/admin/owners/${id}`;
    openModal('modalHapusOwner');
}
</script>
@endpush
