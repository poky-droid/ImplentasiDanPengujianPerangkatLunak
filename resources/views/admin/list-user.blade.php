@extends('layout.app')

@section('title', 'List User')
@section('page-title', 'List User')

@section('content')

<div class="table-section">
    <div class="table-header">
        <h2 class="section-title">Daftar user</h2>
        <div style="display:flex; gap:12px; align-items:center; margin-left:auto;">
            <div class="search-box">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    type="text"
                    id="searchInput"
                    class="search-input"
                    placeholder="Cari User..."
                    oninput="filterTable(this.value)"
                >
            </div>
            <button class="btn btn-primary" onclick="openModal('modalTambahUser')">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </button>
        </div>
    </div>

    <div class="table-wrapper">
        <table id="userTable">
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
                @forelse($users as $i => $user)
                <tr data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . $user->phone) }}">
                    <td class="td-muted">{{ $users->firstItem() + $i }}</td>
                    <td style="font-weight:600;">{{ $user->name }}</td>
                    <td class="td-muted">{{ $user->email }}</td>
                    <td class="td-muted">{{ $user->phone ?? '-' }}</td>
                    <td class="td-muted">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        @if($user->status === 'aktif')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Non-aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <button class="btn-icon" title="Edit" onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', '{{ $user->status }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <button class="btn-icon danger" title="Hapus" onclick="hapusUser({{ $user->id }}, '{{ $user->name }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#9ca3af; padding:40px;">
                        Belum ada data user
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="pagination">
        @if($users->onFirstPage())
            <button class="page-btn" disabled>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
        @else
            <a href="{{ $users->previousPageUrl() }}" class="page-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        @endif

        @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $users->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach

        @if($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="page-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        @else
            <button class="page-btn" disabled>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        @endif
    </div>
    @endif
</div>

<!-- MODAL TAMBAH USER -->
<div class="modal-overlay" id="modalTambahUser">
    <div class="modal">
        <h3 class="modal-title">Tambah User Baru</h3>
        <form method="POST" action="{{ route('admin.users.store') }}">
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
                <button type="button" class="btn btn-outline" onclick="closeModal('modalTambahUser')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal-overlay" id="modalEditUser">
    <div class="modal">
        <h3 class="modal-title">Edit User</h3>
        <form method="POST" id="editUserForm" action="">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="editName" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="editEmail" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="text" name="phone" id="editPhone" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" id="editStatus" class="form-select">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-aktif</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalEditUser')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL HAPUS USER -->
<div class="modal-overlay" id="modalHapusUser">
    <div class="modal" style="max-width:400px;">
        <h3 class="modal-title">Hapus User</h3>
        <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">Apakah Anda yakin ingin menghapus user <strong id="hapusNama"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <form method="POST" id="hapusUserForm" action="">
            @csrf
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalHapusUser')">Batal</button>
                <button type="submit" class="btn btn-primary" style="background:#ef4444;">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function filterTable(val) {
    const rows = document.querySelectorAll('#userTable tbody tr[data-search]');
    rows.forEach(row => {
        row.style.display = row.dataset.search.includes(val.toLowerCase()) ? '' : 'none';
    });
}

function editUser(id, name, email, phone, status) {
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editStatus').value = status;
    document.getElementById('editUserForm').action = `/admin/users/${id}`;
    openModal('modalEditUser');
}

function hapusUser(id, name) {
    document.getElementById('hapusNama').textContent = name;
    document.getElementById('hapusUserForm').action = `/admin/users/${id}`;
    openModal('modalHapusUser');
}
</script>
@endpush
