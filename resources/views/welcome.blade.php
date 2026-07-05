@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-lg-10 text-center">
            <h1 class="display-3 fw-bold text-dark mb-3">
                <span class="text-primary">Gym Management</span>
            </h1>
            <p class="lead fs-4 text-muted mb-5">
                Sistem Pengelolaan Gym & Fitness Center yang modern<br>
                Kelola keanggotaan, sesi latihan, pengukuran tubuh, dan nutrisi dengan mudah
            </p>

            <div class="row justify-content-center g-4 mt-4">
                <!-- Login Card -->
                <div class="col-md-5">
                    <div class="card h-100 shadow border-0 hover-shadow">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4 text-primary">
                                <i class="fas fa-sign-in-alt fa-4x"></i>
                            </div>
                            <h4 class="card-title mb-3">Sudah Punya Akun?</h4>
                            <p class="text-muted mb-4">Masuk untuk mengelola data gym</p>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3">
                                <i class="fas fa-arrow-right"></i> Login
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Register Card -->
                <div class="col-md-5">
                    <div class="card h-100 shadow border-0 hover-shadow">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4 text-success">
                                <i class="fas fa-user-plus fa-4x"></i>
                            </div>
                            <h4 class="card-title mb-3">Belum Punya Akun?</h4>
                            <p class="text-muted mb-4">Daftar sebagai Member atau Staff</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg px-5 py-3">
                                <i class="fas fa-plus"></i> Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <small class="text-muted">
                    Aplikasi ini dibuat untuk keperluan UAS Pemrograman Web Framework<br>
                    Fitur Lengkap: Manajemen Member • Sesi Latihan • Body Measurement • Nutrisi • Laporan
                </small>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 
                0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
}
</style>
@endsection