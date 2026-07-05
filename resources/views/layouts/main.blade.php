<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            Gym Management
        </a>

        <!-- User Info & Auth Buttons -->
        <div class="navbar-nav">
            @auth
                <span class="navbar-text me-3">
                    Halo, <strong>{{ auth()->user()->name }}</strong>
                    <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 
                            (auth()->user()->role === 'staff' ? 'warning' : 'success') }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </span>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @else
                <!-- Tombol Login & Register -->
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">
                    Daftar
                </a>
            @endauth
        </div>
    </div>
</nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>