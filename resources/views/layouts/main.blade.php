<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --surface: #ffffff;
            --surface-2: #f1f5f9;
            --text-muted: #6b7280;
        }
        body {
            background: linear-gradient(180deg, #eef2ff 0%, #f8fafc 100%);
            color: #1f2937;
        }
        .navbar {
            box-shadow: 0 3px 18px rgba(15, 23, 42, 0.08);
            background: #111827;
        }
        .navbar-brand span {
            color: var(--secondary);
        }
        .navbar .nav-link {
            color: rgba(255,255,255,0.82);
            transition: color 0.2s ease;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #ffffff;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: var(--surface);
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
        }
        .card-header {
            border-radius: 18px 18px 0 0;
        }
        .btn {
            border-radius: 12px;
        }
        .btn-outline-light {
            color: #f8fafc;
            border-color: rgba(248, 250, 252, 0.55);
        }
        .btn-outline-light:hover {
            color: #111827;
            background-color: rgba(248, 250, 252, 0.9);
        }
        .badge {
            font-weight: 600;
        }
        table thead th {
            letter-spacing: 0.03em;
            font-size: 0.85rem;
            text-transform: uppercase;
        }
        .form-control,
        .form-select {
            border-radius: 12px;
        }
        .alert {
            border-radius: 14px;
        }
        .pagination {
            --bs-pagination-padding-x: 0.6rem;
            --bs-pagination-padding-y: 0.35rem;
            --bs-pagination-font-size: 0.9rem;
        }
        .pagination .page-link {
            font-size: 0.9rem;
            line-height: 1.1;
            padding: 0.35rem 0.6rem;
            min-width: 2.1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                <span class="text-primary">Gym</span>Management
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(in_array(Auth::user()->role, ['admin', 'staff']))
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">Member</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('sessions.index') }}">Sesi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Laporan</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('my.dashboard') }}">My Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profil Saya</a></li>
                        @endif
                    @endauth
                </ul>

                <div class="navbar-nav">
                    @auth
                        <span class="navbar-text me-3">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : (Auth::user()->role === 'staff' ? 'warning' : 'success') }} ms-1">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-4 pb-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>