@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .welcome-card h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-card p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-left: 4px solid;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .stat-card.purple {
        border-color: #667eea;
    }

    .stat-card.pink {
        border-color: #f093fb;
    }

    .stat-card.blue {
        border-color: #4facfe;
    }

    .stat-card.green {
        border-color: #43e97b;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 15px;
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

    .stat-card.green .stat-icon {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 8px;
    }

    .quick-actions {
        margin-top: 30px;
    }

    .quick-actions h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .action-btn {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        color: #475569;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .action-btn:hover {
        border-color: #667eea;
        background: #f8fafc;
        transform: translateY(-3px);
        color: #667eea;
    }

    .action-btn i {
        font-size: 2rem;
    }

    .action-btn span {
        font-weight: 600;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .welcome-card {
            padding: 30px 25px;
        }

        .welcome-card h2 {
            font-size: 1.6rem;
        }

        .welcome-card p {
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .stat-card {
            padding: 25px 20px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 1.7rem;
        }

        .action-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .welcome-card {
            padding: 25px 20px;
        }

        .welcome-card h2 {
            font-size: 1.4rem;
        }

        .welcome-card p {
            font-size: 0.95rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stat-card {
            padding: 20px 15px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 0.8rem;
        }

        .stat-value {
            font-size: 1.5rem;
            margin-top: 5px;
        }

        .quick-actions h3 {
            font-size: 1.1rem;
        }

        .action-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .action-btn {
            padding: 18px 15px;
        }

        .action-btn i {
            font-size: 1.7rem;
        }

        .action-btn span {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .welcome-card {
            padding: 20px 15px;
            margin-bottom: 20px;
        }

        .welcome-card h2 {
            font-size: 1.2rem;
        }

        .welcome-card p {
            font-size: 0.85rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 20px;
        }

        .stat-card {
            padding: 18px 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.4rem;
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            font-size: 0.75rem;
            margin-bottom: 3px;
        }

        .stat-value {
            font-size: 1.4rem;
            margin-top: 0;
        }

        .quick-actions {
            margin-top: 20px;
        }

        .quick-actions h3 {
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .action-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .action-btn {
            flex-direction: row;
            justify-content: flex-start;
            padding: 15px;
            gap: 15px;
        }

        .action-btn i {
            font-size: 1.5rem;
        }

        .action-btn span {
            font-size: 0.9rem;
        }
    }
</style>

<div class="welcome-card">
    <h2>👋 Selamat Datang di Admin Panel</h2>
    <p>Kelola perpustakaan Anda dengan mudah dan efisien</p>
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
            <i class="bi bi-people"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total User</div>
            <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="bi bi-arrow-repeat"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Peminjaman Aktif</div>
            <div class="stat-value">{{ $activeBorrowings ?? 0 }}</div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Buku Tersedia</div>
            <div class="stat-value">{{ $availableBooks ?? 0 }}</div>
        </div>
    </div>
</div>

<div class="quick-actions">
    <h3>⚡ Aksi Cepat</h3>
    <div class="action-grid">
        <a href="{{ route('admin.book.index') }}" class="action-btn">
            <i class="bi bi-book"></i>
            <span>Kelola Buku</span>
        </a>
        <a href="{{ route('admin.user.index') }}" class="action-btn">
            <i class="bi bi-people"></i>
            <span>Kelola User</span>
        </a>
        <a href="#" class="action-btn">
            <i class="bi bi-arrow-repeat"></i>
            <span>Peminjaman</span>
        </a>
        <a href="#" class="action-btn">
            <i class="bi bi-graph-up"></i>
            <span>Laporan</span>
        </a>
    </div>
</div>
@endsection