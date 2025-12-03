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
    // Inisialisasi Modal Bootstrap 5
    const modal = new bootstrap.Modal(document.getElementById('bookModal'));
    const form = document.getElementById('bookForm');
    const modalTitle = document.getElementById('modalTitle');
    const currentImageNote = document.getElementById('current-image-note');
    
    // Fungsi Reset Form & Errors
    function resetForm() {
        form.reset();
        document.getElementById('book_id').value = '';
        document.querySelectorAll('.text-danger.small').forEach(el => el.textContent = '');
        modalTitle.textContent = 'Tambah Buku';
        currentImageNote.textContent = 'Hanya isi jika ingin mengganti gambar.';
    }
    
    // Fungsi Display Errors
    function displayErrors(errors) {
        document.querySelectorAll('.text-danger.small').forEach(el => el.textContent = '');
        for (const [key, value] of Object.entries(errors)) {
            const errorElement = document.getElementById(`error-${key}`);
            if (errorElement) {
                errorElement.textContent = value[0];
            }
        }
    }

    // Tombol tambah
    document.getElementById('btnAdd').onclick = function() {
        resetForm();
        modal.show();
    };
    
    // Tombol Batal
    document.getElementById('btnCancel').onclick = () => modal.hide();
    document.getElementById('btnCancelFooter').onclick = () => modal.hide();

    // Tombol edit
    document.querySelectorAll('.btnEdit').forEach(btn => {
        btn.onclick = function() {
            const row = btn.closest('tr');
            const id = row.dataset.id;
            
            fetch(`/admin/book/${id}/show`) 
                .then(res => res.json())
                .then(data => {
                    document.getElementById('book_id').value = data.book_id;
                    document.getElementById('title').value = data.title;
                    document.getElementById('author').value = data.author;
                    document.getElementById('publisher').value = data.publisher;
                    document.getElementById('year').value = data.year;
                    document.getElementById('stock').value = data.stock;
                    
                    // Update Note Gambar saat Edit
                    if (data.image) {
                        currentImageNote.innerHTML = `Saat ini: <a href="{{ asset('') }}${data.image}" target="_blank">Lihat Gambar</a>. Kosongkan field di atas jika tidak ingin mengganti.`;
                    } else {
                        currentImageNote.textContent = 'Belum ada gambar saat ini.';
                    }

                    modalTitle.textContent = 'Edit Buku';
                    modal.show();
                });
        };
    });

    // Tombol delete
    document.querySelectorAll('.btnDelete').forEach(btn => {
        btn.onclick = function() {
            const row = btn.closest('tr');
            const id = row.dataset.id;
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                fetch(`/admin/book/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(response => {
                    if (response.ok) {
                        // Jika sukses, reload halaman untuk menampilkan notifikasi success dari controller
                        location.reload(); 
                    } else {
                        alert('Gagal menghapus data.');
                    }
                });
            }
        };
    });

    // Simpan (create/update)
    form.onsubmit = function(e) {
        e.preventDefault();
        const id = document.getElementById('book_id').value;
        const url = id ? `/admin/book/${id}` : `/admin/book`;
        
        // Wajib menggunakan FormData untuk mengirim file
        const formData = new FormData(form);
        
        // Tambahkan spoofing method untuk PUT/PATCH, wajib jika ada file upload
        if (id) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST', // Selalu POST saat mengirim FormData, lalu Laravel akan membaca _method=PUT
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        }).then(response => response.json())
          .then(data => {
            if (data.errors) {
                // Tampilkan error validasi
                displayErrors(data.errors);
            } else {
                modal.hide();
                // Reload halaman untuk melihat perubahan dan notifikasi sukses
                location.reload(); 
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data.');
          });
    };
});
</script>
@endsection