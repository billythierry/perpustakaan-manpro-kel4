@extends('admin.layouts.main')

@section('title', 'Book Management')

@section('content')
<div class="container mt-4">

    <h1>Manajemen Buku</h1>
    
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <button id="btnAdd" class="btn btn-primary mb-3">Tambah Buku</button>

    <table class="table table-bordered table-striped" id="bookTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Image</th> {{-- Kolom Image Ditambahkan --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($book as $item)
            <tr data-id="{{ $item->book_id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->publisher }}</td>
                <td>{{ $item->year }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                    {{-- Logika Tampilan Image Ditambahkan --}}
                    @if($item->image) 
                        {{-- Asumsi kolom 'image' menyimpan path relatif --}}
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" width="50" height="50" style="object-fit: cover;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-warning btnEdit">Edit</button>
                    <button class="btn btn-sm btn-danger btnDelete">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="bookModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Buku</h5>
                    <button type="button" class="btn-close" id="btnCancel" aria-label="Close"></button>
                </div>
                <form id="bookForm" enctype="multipart/form-data"> {{-- Wajib ada enctype untuk upload file --}}
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
                        
                        {{-- Input Image Ditambahkan --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="form-text text-muted" id="current-image-note">Hanya isi jika ingin mengganti gambar.</small>
                            <div class="text-danger small" id="error-image"></div>
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
document.addEventListener('DOMContentLoaded', function() {

    const modalElement = document.getElementById('bookModal');
    const modal = new bootstrap.Modal(modalElement);
    const form = document.getElementById('bookForm');

    // Reset form
    function resetForm() {
        form.reset();
        document.getElementById('book_id').value = '';
        document.querySelectorAll('.text-danger.small').forEach(e => e.textContent = '');
        document.getElementById('modalTitle').textContent = 'Tambah Buku';
        document.getElementById('current-image-note').textContent = 'Hanya isi jika ingin mengganti gambar.';
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
                        `Saat ini: <a href="{{ asset('') }}${data.image}" target="_blank">Lihat Gambar</a>. Kosongkan field ini jika tidak ingin mengganti.`;
                }

                document.getElementById('modalTitle').textContent = 'Edit Buku';
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