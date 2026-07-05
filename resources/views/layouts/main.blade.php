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
            --primary: #0d6efd;
        }
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.1);
        }
        .btn {
            border-radius: 8px;
        }
        .badge {
            font-weight: 500;
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