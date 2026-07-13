@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="mb-1 h4">Daftar Member Gym</h2>
                <p class="mb-0 text-white-75">Kelola data member, status, dan masa berlaku keanggotaan.</p>
            </div>
            <a href="{{ route('members.create') }}" class="btn btn-light btn-sm">+ Tambah Member Baru</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
            @endif

            <form method="GET" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Cari member</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, kode member, atau email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Filter status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Cari Member</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary text-uppercase small">
                        <tr>
                            <th class="fw-semibold">Kode</th>
                            <th class="fw-semibold">Nama</th>
                            <th class="fw-semibold">Email</th>
                            <th class="fw-semibold">Telepon</th>
                            <th class="fw-semibold">Membership</th>
                            <th class="fw-semibold">Mulai</th>
                            <th class="fw-semibold">Expired</th>
                            <th class="fw-semibold">Status</th>
                            <th class="fw-semibold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td><strong>{{ $member->member_code }}</strong></td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email ?? '-' }}</td>
                                <td>{{ $member->phone ?? $member->user?->phone ?? '-' }}</td>
                                <td>{{ ucfirst($member->membership_type ?? 'monthly') }}</td>
                                <td>{{ $member->start_date ? $member->start_date->format('Y-m-d') : '-' }}</td>
                                <td>{{ $member->expire_date ? $member->expire_date->format('Y-m-d') : '-' }}</td>
                                <td>
                                    @if($member->status === 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($member->status === 'expired')
                                        <span class="badge bg-danger">Expired</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Suspended</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Aksi member">
                                        <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus member ini? Data dan riwayatnya juga akan terhapus.')">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Belum ada member yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>
@endsection