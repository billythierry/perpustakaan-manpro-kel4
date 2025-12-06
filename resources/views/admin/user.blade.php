@extends('admin.layouts.main')

@section('title', 'User Management')

@section('content')
<div class="container mt-4">

    <h1>Manajemen User</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <button id="btnAdd" class="btn btn-primary mb-3">Tambah User</button>

    <table class="table table-bordered table-striped" id="userTable">
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
                <td>{{ $item->username }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    <button class="btn btn-sm btn-warning btnEdit">Edit</button>
                    <button class="btn btn-sm btn-danger btnDelete">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- MODAL --}}
    <div id="userModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="modalTitle" class="modal-title">Tambah User</h5>
                    <button class="btn-close" id="btnCancel"></button>
                </div>

                <form id="userForm">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="modal-body">

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control editable" id="username" name="username">
                            <div class="text-danger small" id="error-username"></div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control editable" id="email" name="email">
                            <div class="text-danger small" id="error-email"></div>
                        </div>

                        {{-- ADDRESS --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control editable" id="address" name="address">
                            <div class="text-danger small" id="error-address"></div>
                        </div>

                        {{-- PASSWORD (HANYA SAAT TAMBAH) --}}
                        <div class="mb-3 addOnly">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
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
                        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
                    </div>

                </form>

            </div>
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
        document.getElementById('modalTitle').textContent = 'Tambah User';
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

                    document.getElementById('modalTitle').textContent = 'Edit Role User';

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
