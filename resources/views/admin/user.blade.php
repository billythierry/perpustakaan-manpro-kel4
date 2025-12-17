@extends('admin.layouts.main')

@section('title', 'Manajemen User')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow-x: auto;
    }

    .badge-role {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-anggota {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        color: #065f46;
    }

    .btn-sm {
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(240, 147, 251, 0.4);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        border: none;
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(250, 112, 154, 0.4);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .page-header h2 {
            font-size: 1.5rem;
        }

        .table {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .page-header h2 {
            font-size: 1.3rem;
            text-align: center;
        }

        .page-header .btn-primary {
            width: 100%;
        }

        .table-container {
            border-radius: 12px;
        }

        .table {
            font-size: 0.85rem;
            min-width: 650px;
        }

        .table thead th,
        .table tbody td {
            padding: 10px 8px;
        }

        .badge-role {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        .btn-sm {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }

        .action-buttons .btn-sm {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .page-header h2 {
            font-size: 1.1rem;
        }

        .table {
            font-size: 0.8rem;
            min-width: 600px;
        }

        .table thead th,
        .table tbody td {
            padding: 8px 6px;
        }

        .badge-role {
            font-size: 0.7rem;
            padding: 4px 8px;
        }

        .btn-sm {
            font-size: 0.7rem;
            padding: 4px 8px;
        }

        .btn-sm i {
            font-size: 0.8rem;
        }

        /* Modal Responsive */
        .modal-header h5 {
            font-size: 1.1rem;
        }

        .modal-body .form-label {
            font-size: 0.9rem;
        }

        .modal-body .form-control,
        .modal-body .form-select {
            font-size: 0.9rem;
        }
    }
</style>

<div class="page-header">
    <h2>Manajemen User</h2>
    <button id="btnAdd" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah User
    </button>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-container">
    <table class="table table-hover mb-0" id="userTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $item)
            <tr data-id="{{ $item->user_id }}">
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $item->username }}</strong></td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->address }}</td>
                <td>
                    <span class="badge-role {{ $item->role == 'admin' ? 'badge-admin' : 'badge-anggota' }}">
                        {{ ucfirst($item->role) }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-warning btnEdit">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </button>
                        <button class="btn btn-sm btn-danger btnDelete">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div id="userModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title">
                    <i class="bi bi-person-plus me-2"></i>Tambah User
                </h5>
                <button class="btn-close" id="btnCancel"></button>
            </div>

            <form id="userForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id">

                <div class="modal-body">
                    {{-- USERNAME --}}
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control editable" id="username" name="username" required>
                        <div class="text-danger small" id="error-username"></div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control editable" id="email" name="email" required>
                        <div class="text-danger small" id="error-email"></div>
                    </div>

                    {{-- ADDRESS --}}
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control editable" id="address" name="address" required>
                        <div class="text-danger small" id="error-address"></div>
                    </div>

                    {{-- PASSWORD (HANYA SAAT TAMBAH) --}}
                    <div class="mb-3 addOnly">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="text-danger small" id="error-password"></div>
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            <option value="anggota">Anggota</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="text-danger small" id="error-role"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelFooter">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">
                        <i class="bi bi-check-circle me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const modalEl = document.getElementById('userModal');
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById('userForm');

    // RESET FORM
    function resetForm() {
        form.reset();
        document.getElementById('user_id').value = '';
        document.querySelectorAll('.text-danger.small').forEach(e => e.textContent = '');
        document.getElementById('modalTitle').innerHTML = '<i class="bi bi-person-plus me-2"></i>Tambah User';
        setEditMode(false);
    }

    // MODE EDIT → hanya role aktif
    function setEditMode(isEdit) {
        const editables = document.querySelectorAll('.editable');

        editables.forEach(input => {
            input.disabled = isEdit;
        });

        // Password hanya muncul saat tambah
        document.querySelectorAll('.addOnly').forEach(el => {
            el.style.display = isEdit ? 'none' : 'block';
        });
    }

    // SHOW ERRORS
    function showErrors(errors) {
        document.querySelectorAll('.text-danger.small').forEach(e => e.textContent = '');
        Object.keys(errors).forEach(key => {
            const el = document.getElementById(`error-${key}`);
            if (el) el.textContent = errors[key][0];
        });
    }

    // ADD
    document.getElementById('btnAdd').onclick = () => {
        resetForm();
        modal.show();
    };

    // CLOSE MODAL
    document.getElementById('btnCancel').onclick = () => modal.hide();
    document.getElementById('btnCancelFooter').onclick = () => modal.hide();

    // EDIT
    document.querySelectorAll('.btnEdit').forEach(btn => {
        btn.onclick = () => {

            const id = btn.closest('tr').dataset.id;

            fetch(`/admin/user/${id}`)
                .then(r => r.json())
                .then(data => {

                    resetForm();

                    document.getElementById('user_id').value = data.user_id;
                    document.getElementById('username').value = data.username;
                    document.getElementById('email').value = data.email;
                    document.getElementById('address').value = data.address;
                    document.getElementById('role').value = data.role;

                    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Edit Role User';

                    setEditMode(true);

                    modal.show();
                });
        };
    });

    // DELETE
    document.querySelectorAll('.btnDelete').forEach(btn => {
        btn.onclick = () => {
            const id = btn.closest('tr').dataset.id;

            if (!confirm("Yakin ingin menghapus user ini?")) return;

            fetch(`/admin/user/${id}`, {
                method: "DELETE",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(r => {
                if (r.ok) location.reload();
                else alert("Gagal menghapus user");
            });
        };
    });

    // SUBMIT FORM (ADD/UPDATE)
    form.onsubmit = (e) => {
        e.preventDefault();

        const id = document.getElementById('user_id').value;
        const url = id ? `/admin/user/${id}` : `/admin/user`;

        const formData = new FormData(form);
        if (id) formData.append('_method', 'PUT');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(async res => {

            if (res.status === 422) {
                const data = await res.json();
                showErrors(data.errors);
                return;
            }

            if (res.ok) {
                modal.hide();
                location.reload();
            }
        });
    };

});
</script>

@endsection