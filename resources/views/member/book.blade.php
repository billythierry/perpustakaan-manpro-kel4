@extends('member.layouts.main')

@section('title', 'Daftar Buku')

@section('content')
<style>
    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .page-header p {
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .search-bar {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }

    .search-input-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .search-input-group input {
        flex: 1;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input-group input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-input-group button {
        padding: 14px 30px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .search-input-group button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .book-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .book-image {
        width: 100%;
        height: 320px;
        object-fit: cover;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    }

    .book-image-placeholder {
        width: 100%;
        height: 320px;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: #94a3b8;
    }

    .book-content {
        padding: 20px;
    }

    .book-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-author {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .book-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
        margin-bottom: 15px;
    }

    .book-year {
        font-size: 0.85rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .book-stock {
        font-size: 0.85rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
    }

    .stock-available {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        color: #065f46;
    }

    .stock-limited {
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        color: #7c3d00;
    }

    .stock-out {
        background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);
        color: #7f1d1d;
    }

    .book-action {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .book-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
    }

    .book-action:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        transform: none;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .empty-state i {
        font-size: 5rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        color: #475569;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 1rem;
        color: #94a3b8;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
        }

        .book-image,
        .book-image-placeholder {
            height: 280px;
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.8rem;
        }

        .page-header p {
            font-size: 1rem;
        }

        .search-bar {
            padding: 20px;
        }

        .search-input-group {
            flex-direction: column;
        }

        .search-input-group input,
        .search-input-group button {
            width: 100%;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .book-image,
        .book-image-placeholder {
            height: 250px;
        }

        .book-content {
            padding: 15px;
        }

        .book-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .page-header p {
            font-size: 0.95rem;
        }

        .search-bar {
            padding: 15px;
        }

        .search-input-group input {
            padding: 12px 16px;
            font-size: 0.95rem;
        }

        .search-input-group button {
            padding: 12px 24px;
        }

        .books-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .book-image,
        .book-image-placeholder {
            height: 280px;
        }

        .book-title {
            font-size: 1rem;
        }

        .book-author {
            font-size: 0.9rem;
        }

        .empty-state {
            padding: 60px 15px;
        }

        .empty-state i {
            font-size: 4rem;
        }

        .empty-state h3 {
            font-size: 1.3rem;
        }
    }
</style>

<div class="page-header">
    <h1>📚 Koleksi Buku</h1>
    <p>Temukan buku favoritmu dan mulai membaca</p>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="search-bar">
    <form action="{{ route('member.book.index') }}" method="GET">
        <div class="search-input-group">
            <input type="text" name="search" placeholder="Cari judul buku, penulis, atau penerbit..." value="{{ request('search') }}">
            <button type="submit">
                <i class="bi bi-search me-2"></i>Cari
            </button>
        </div>
    </form>
</div>

@if(isset($books) && count($books) > 0)
    <div class="books-grid">
        @foreach($books as $book)
        <div class="book-card" onclick="showBookDetail({{ $book->book_id }})">
            @if($book->image)
                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
            @else
                <div class="book-image-placeholder">
                    <i class="bi bi-book"></i>
                </div>
            @endif
            
            <div class="book-content">
                <h3 class="book-title">{{ $book->title }}</h3>
                <div class="book-author">
                    <i class="bi bi-person"></i>
                    {{ $book->author }}
                </div>
                
                <div class="book-meta">
                    <span class="book-year">
                        <i class="bi bi-calendar"></i>
                        {{ $book->year }}
                    </span>
                    <span class="book-stock {{ $book->stock > 5 ? 'stock-available' : ($book->stock > 0 ? 'stock-limited' : 'stock-out') }}">
                        {{ $book->stock > 0 ? 'Tersedia: ' . $book->stock : 'Habis' }}
                    </span>
                </div>
                
                <button class="book-action" {{ $book->stock <= 0 ? 'disabled' : '' }} onclick="event.stopPropagation(); showBookDetail({{ $book->book_id }})">
                    <i class="bi bi-eye"></i>
                    Lihat Detail
                </button>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="bi bi-search"></i>
        <h3>Buku Tidak Ditemukan</h3>
        <p>Coba gunakan kata kunci lain untuk pencarian</p>
    </div>
@endif

{{-- Modal Detail Buku --}}
<div class="modal fade" id="bookDetailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-book me-2"></i>Detail Buku
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="bookDetailContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showBookDetail(bookId) {
    const modal = new bootstrap.Modal(document.getElementById('bookDetailModal'));
    modal.show();
    
    fetch(`/Anggota/book/${bookId}`)
        .then(response => response.json())
        .then(data => {
            const content = `
                <div class="row">
                    <div class="col-md-4">
                        ${data.image 
                            ? `<img src="{{ asset('') }}${data.image}" alt="${data.title}" class="img-fluid rounded" style="width: 100%; height: 350px; object-fit: cover;">`
                            : `<div style="width: 100%; height: 350px; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 5rem; color: #94a3b8;"><i class="bi bi-book"></i></div>`
                        }
                    </div>
                    <div class="col-md-8">
                        <h3 class="mb-3">${data.title}</h3>
                        <div class="mb-3">
                            <p class="mb-2"><strong><i class="bi bi-person me-2"></i>Penulis:</strong> ${data.author}</p>
                            <p class="mb-2"><strong><i class="bi bi-building me-2"></i>Penerbit:</strong> ${data.publisher}</p>
                            <p class="mb-2"><strong><i class="bi bi-calendar me-2"></i>Tahun:</strong> ${data.year}</p>
                            <p class="mb-2"><strong><i class="bi bi-box me-2"></i>Stok:</strong> 
                                <span class="badge ${data.stock > 5 ? 'bg-success' : (data.stock > 0 ? 'bg-warning' : 'bg-danger')}">
                                    ${data.stock > 0 ? data.stock + ' buku tersedia' : 'Habis'}
                                </span>
                            </p>
                        </div>
                        <hr>
                        ${data.stock > 0 
                            ? `<button class="btn btn-primary w-100" onclick="borrowBook(${data.book_id})">
                                <i class="bi bi-arrow-right-circle me-2"></i>Ajukan Peminjaman
                               </button>`
                            : `<button class="btn btn-secondary w-100" disabled>
                                <i class="bi bi-x-circle me-2"></i>Stok Habis
                               </button>`
                        }
                    </div>
                </div>
            `;
            document.getElementById('bookDetailContent').innerHTML = content;
        })
        .catch(error => {
            document.getElementById('bookDetailContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat detail buku
                </div>
            `;
        });
}

// function borrowBook(bookId) {
//     if (!confirm('Apakah Anda yakin ingin meminjam buku ini?')) return;
    
//     fetch(`/Anggota/peminjaman/borrow/${bookId}`, {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert('Peminjaman berhasil diajukan!');
//             location.reload();
//         } else {
//             alert(data.message || 'Gagal mengajukan peminjaman');
//         }
//     })
//     .catch(error => {
//         alert('Terjadi kesalahan');
//     });
// }
</script>

@endsection