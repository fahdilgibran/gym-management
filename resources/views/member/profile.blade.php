@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Edit Profil Saya</h2>
            <p class="text-muted mb-0">Perbarui data profil dan membership Anda di sini.</p>
        </div>
        <a href="{{ route('my.dashboard') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-4">
                <div class="card-body">
                    @if($user->photo)
                        <a href="{{ asset('storage/' . $user->photo) }}" target="_blank">
                            <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle img-fluid mb-3 shadow-sm" style="width: 180px; height: 180px; object-fit: cover;">
                        </a>
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 180px; height: 180px;">
                            <i class="fas fa-user fa-5x text-muted"></i>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <span class="badge bg-success">{{ ucfirst($user->role) }}</span>

                    @php
                        $member = $user->gymMember;
                        $statusBadge = 'secondary';
                        $statusText = 'Tidak Aktif';
                        $daysLeft = null;
                        $membershipType = $member?->membership_type ?? $user->membership_type ?? 'monthly';
                        $expireDate = $member?->expire_date ?? $user->expire_date;
                        $startDate = $member?->start_date ?? $user->start_date;
                        $status = $member?->status ?? 'active';

                        if ($status === 'active') {
                            $statusBadge = 'success';
                            $statusText = 'Aktif';
                        } elseif ($status === 'expired') {
                            $statusBadge = 'warning';
                            $statusText = 'Kadaluarsa';
                        } else {
                            $statusBadge = 'secondary';
                            $statusText = 'Ditangguhkan';
                        }

                        if ($expireDate) {
                            $daysLeft = now()->startOfDay()->diffInDays($expireDate->copy()->startOfDay(), false);
                        }
                    @endphp

                    <div class="mt-4 p-3 rounded-4 border" style="background: #f8fafc; text-align: left;">
                        <p class="text-uppercase text-muted small mb-2">Informasi Membership</p>
                        <p class="mb-2"><strong>Tipe:</strong> {{ ucfirst($membershipType) }}</p>
                        <p class="mb-2"><strong>Mulai:</strong> {{ $startDate ? $startDate->format('d M Y') : '-' }}</p>
                        <p class="mb-2"><strong>Expired:</strong> {{ $expireDate ? $expireDate->format('d M Y') : '-' }}</p>
                        <p class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $statusBadge }}">{{ $statusText }}</span></p>
                        @if($daysLeft !== null)
                            <p class="mb-0"><strong>Sisa Hari:</strong> <span class="fw-semibold {{ $daysLeft < 0 ? 'text-danger' : ($daysLeft <= 7 ? 'text-warning' : 'text-success') }}">{{ $daysLeft < 0 ? abs($daysLeft) . ' hari sudah lewat' : $daysLeft . ' hari' }}</span></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Foto Profil</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="M" {{ old('gender', $user->gymMember?->gender) == 'M' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="F" {{ old('gender', $user->gymMember?->gender) == 'F' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->gymMember?->birth_date?->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipe Membership</label>
                                <select name="membership_type" class="form-select">
                                    <option value="monthly" {{ old('membership_type', $user->gymMember?->membership_type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="quarterly" {{ old('membership_type', $user->gymMember?->membership_type) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="annual" {{ old('membership_type', $user->gymMember?->membership_type) == 'annual' ? 'selected' : '' }}>Annual</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('my.dashboard') }}" class="btn btn-outline-secondary">Kembali ke My Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection