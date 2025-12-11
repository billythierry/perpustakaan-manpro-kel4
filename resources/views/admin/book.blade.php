@extends('admin.layouts.main')

@section('title', 'Manajemen Buku')

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

    .book-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .no-image-placeholder {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        color: #64748b;
        text-align: center;
    }

    .stock-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .stock-high {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        color: #065f46;
    }

    .stock-medium {
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        color: #7c3d00;
    }

    .stock-low {
        background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);
        color: #7f1d1d;
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

    .image-preview {
        margin-top: 10px;
        padding: 10px;
        background: #f8fafc;
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .image-preview a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .image-preview a:hover {
        text-decoration: underline;
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
            min-width: 750px;
        }

        .table thead th,
        .table tbody td {
            padding: 10px 8px;
        }

        .book-img,
        .no-image-placeholder {
            width: 40px;
            height: 40px;
            font-size: 0.7rem;
        }

        .stock-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
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
            min-width: 700px;
        }

        .table thead th,
        .table tbody td {
            padding: 8px 6px;
        }

        .book-img,
        .no-image-placeholder {
            width: 35px;
            height: 35px;
            font-size: 0.65rem;
        }

        .stock-badge {
            font-size: 0.7rem;
            padding: 3px 7px;
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

        .image-preview {
            font-size: 0.8rem;
            padding: 8px;
        }
    }
</style>

<div class="page-header">
    <h2>Daftar Buku</h2>
    <button id="btnAdd" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Buku
    </button>
</div>

{{-- Notifikasi Sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-container">
    <table class="table table-hover mb-0" id="bookTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Image</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($book as $item)
            <tr data-id="{{ $item->book_id }}">
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $item->title }}</strong></td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->publisher }}</td>
                <td>{{ $item->year }}</td>
                <td>
                    @php
                        $stockClass = 'stock-high';
                        if($item->stock <= 5 && $item->stock > 2) $stockClass = 'stock-medium';
                        elseif($item->stock <= 2) $stockClass = 'stock-low';
                    @endphp
                    <span class="stock-badge {{ $stockClass }}">{{ $item->stock }}</span>
                </td>
                <td>
                    @if($item->image) 
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="book-img">
                    @else
                        <div class="no-image-placeholder">No Image</div>
                    @endif
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

<div id="bookModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">
                    <i class="bi bi-book me-2"></i>Tambah Buku
                </h5>
                <button type="button" class="btn-close" id="btnCancel" aria-label="Close"></button>
            </div>
            <form id="bookForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="book_id" id="book_id"> 
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        <div class="text-danger small" id="error-title"></div>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis:</label>
                        <input type="text" name="author" id="author" class="form-control" required>
                        <div class="text-danger small" id="error-author"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Penerbit:</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" required>
                        <div class="text-danger small" id="error-publisher"></div>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun:</label>
                        <input type="number" name="year" id="year" class="form-control" required min="1900" max="{{ date('Y') }}">
                        <div class="text-danger small" id="error-year"></div>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok:</label>
                        <input type="number" name="stock" id="stock" class="form-control" required min="0">
                        <div class="text-danger small" id="error-stock"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <div class="image-preview" id="current-image-note">
                            <small class="text-muted">Hanya isi jika ingin mengganti gambar.</small>
                        </div>
                        <div class="text-danger small" id="error-image"></div>
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
document.addEventListener('DOMContentLoaded', function() {

    const modalElement = document.getElementById('bookModal');
    const modal = new bootstrap.Modal(modalElement);
    const form = document.getElementById('bookForm');

    // Reset form
    function resetForm() {
        form.reset();
        document.getElementById('book_id').value = '';
        document.querySelectorAll('.text-danger.small').forEach(e => e.textContent = '');
        document.getElementById('modalTitle').innerHTML = '<i class="bi bi-book me-2"></i>Tambah Buku';
        document.getElementById('current-image-note').innerHTML = '<small class="text-muted">Hanya isi jika ingin mengganti gambar.</small>';
    }

    // Tampilkan error validasi
    function showErrors(errors) {
        document.querySelectorAll('.text-danger.small').forEach(e => e.textContent = '');
        Object.keys(errors).forEach(key => {
            const element = document.getElementById(`error-${key}`);
            if (element) {
                element.textContent = errors[key][0];
            }
        });
    }

    // Tombol Tambah Buku
    document.getElementById('btnAdd').onclick = function () {
        resetForm();
        modal.show();
    };

    // Tombol Close
    document.getElementById('btnCancel').onclick = () => modal.hide();
    document.getElementById('btnCancelFooter').onclick = () => modal.hide();

    // Tombol Edit Buku
    document.querySelectorAll('.btnEdit').forEach(btn => {
        btn.onclick = function () {
            const id = btn.closest('tr').dataset.id;

            fetch(`/admin/book/${id}`)
            .then(res => res.json())
            .then(data => {

                document.getElementById('book_id').value = data.book_id;
                document.getElementById('title').value = data.title;
                document.getElementById('author').value = data.author;
                document.getElementById('publisher').value = data.publisher;
                document.getElementById('year').value = data.year;
                document.getElementById('stock').value = data.stock;

                if (data.image) {
                    document.getElementById('current-image-note').innerHTML =
                        `<small>Saat ini: <a href="{{ asset('') }}${data.image}" target="_blank">Lihat Gambar</a>. Kosongkan field ini jika tidak ingin mengganti.</small>`;
                }

                document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Edit Buku';
                modal.show();
            });
        };
    });

    // Tombol Delete Buku
    document.querySelectorAll('.btnDelete').forEach(btn => {
        btn.onclick = function () {
            const id = btn.closest('tr').dataset.id;

            if (!confirm('Yakin ingin menghapus buku ini?')) return;

            fetch(`/admin/book/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => {
                if (res.ok) location.reload();
                else alert("Gagal menghapus data");
            });
        };
    });

    // Submit (Tambah / Edit)
    form.onsubmit = function (e) {
        e.preventDefault();

        const id = document.getElementById('book_id').value;
        const url = id ? `/admin/book/${id}` : `/admin/book`;

        const formData = new FormData(form);
        if (id) formData.append('_method', 'PUT'); // spoofing method

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
        })
        .then(async res => {

            // Jika validasi Laravel gagal → kode 422
            if (res.status === 422) {
                const data = await res.json();
                showErrors(data.errors);
                return;
            }

            // Jika sukses → reload & tampilkan pesan sukses
            if (res.ok) {
                modal.hide();
                location.reload();
            }

        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan");
        });
    };

});
</script>

@endsection