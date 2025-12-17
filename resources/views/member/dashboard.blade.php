@extends('member.layouts.main')

@section('title', 'Dashboard')

@section('content')
<style>
    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        padding: 50px 40px;
        margin-bottom: 40px;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .welcome-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-section h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .welcome-section p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .stat-card.purple .stat-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stat-card.pink .stat-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .stat-card.blue .stat-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .quick-actions {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .action-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        border-color: #667eea;
    }

    .action-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
    }

    .action-card.secondary .action-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .action-card.tertiary .action-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .action-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .action-desc {
        font-size: 0.95rem;
        color: #64748b;
        margin: 0;
    }

    .recent-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 1.1rem;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .welcome-section {
            padding: 40px 30px;
        }

        .welcome-section h1 {
            font-size: 2rem;
        }

        .welcome-section p {
            font-size: 1.1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .stat-card {
            padding: 25px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 1.7rem;
        }

        .stat-value {
            font-size: 1.9rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .action-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .welcome-section {
            padding: 30px 25px;
        }

        .welcome-section h1 {
            font-size: 1.7rem;
        }

        .welcome-section p {
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 1.7rem;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .action-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .action-card {
            padding: 25px;
        }

        .action-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }

        .recent-section {
            padding: 25px 20px;
        }
    }

    @media (max-width: 576px) {
        .welcome-section {
            padding: 25px 20px;
        }

        .welcome-section h1 {
            font-size: 1.5rem;
        }

        .welcome-section p {
            font-size: 0.95rem;
        }

        .stat-card {
            padding: 18px;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }

        .stat-label {
            font-size: 0.8rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 1.2rem;
            gap: 8px;
        }

        .action-card {
            padding: 20px;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .action-title {
            font-size: 1.1rem;
        }

        .action-desc {
            font-size: 0.9rem;
        }

        .recent-section {
            padding: 20px 15px;
        }

        .empty-state {
            padding: 40px 15px;
        }

        .empty-state i {
            font-size: 3rem;
        }

        .empty-state p {
            font-size: 1rem;
        }
    }
</style>

<div class="welcome-section">
    <div class="welcome-content">
        <h1>👋 Selamat Datang, {{ Auth::user()->username }}!</h1>
        <p>Jelajahi koleksi buku kami dan mulai petualangan membaca Anda</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card purple">
        <div class="stat-icon">
            <i class="bi bi-book"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Buku</div>
            <div class="stat-value">{{ $totalBooks ?? 0 }}</div>
        </div>
    </div>

    <div class="stat-card pink">
        <div class="stat-icon">
            <i class="bi bi-arrow-repeat"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-value">{{ $activeBorrows ?? 0 }}</div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Riwayat Pinjam</div>
            <div class="stat-value">{{ $totalHistory ?? 0 }}</div>
        </div>
    </div>
</div>

<div class="quick-actions">
    <h2 class="section-title">
        <i class="bi bi-lightning-charge"></i> Aksi Cepat
    </h2>
    <div class="action-grid">
        <a href="{{ route('member.book.index') }}" class="action-card">
            <div class="action-icon">
                <i class="bi bi-search"></i>
            </div>
            <h3 class="action-title">Cari Buku</h3>
            <p class="action-desc">Jelajahi koleksi buku yang tersedia</p>
        </a>

        <a href="{{ route('member.loan.index') }}" class="action-card secondary">
            <div class="action-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <h3 class="action-title">Riwayat Peminjaman</h3>
            <p class="action-desc">Lihat peminjaman aktif dan riwayat</p>
        </a>

        <a href="{{ route('member.book.index') }}" class="action-card tertiary">
            <div class="action-icon">
                <i class="bi bi-star"></i>
            </div>
            <h3 class="action-title">Buku Populer</h3>
            <p class="action-desc">Temukan buku yang paling banyak dipinjam</p>
        </a>
    </div>
</div>

<div class="recent-section">
    <h2 class="section-title">
        <i class="bi bi-clock"></i> Peminjaman Terakhir
    </h2>
    
    @if(isset($recentBorrows) && count($recentBorrows) > 0)
        {{-- Tampilkan daftar peminjaman terakhir --}}
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            Anda memiliki {{ count($recentBorrows) }} peminjaman aktif
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada peminjaman. Mulai pinjam buku sekarang!</p>
        </div>
    @endif
</div>

@endsection