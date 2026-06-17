@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Member Gym</h2>
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            + Tambah Member Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Member Code</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Membership</th>
                <th>Expire Date</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td><strong>{{ $member->member_code }}</strong></td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email ?? '-' }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ ucfirst($member->membership_type) }}</td>
                <td>{{ $member->start_date ? $member->start_date->format('Y-m-d') : '-' }}</td>
                <td>{{ $member->expire_date ? $member->expire_date->format('Y-m-d') : '-' }}</td>
                <td>
                    @if($member->status == 'active')
                        <span class="badge bg-success">Aktif</span>
                    @elseif($member->status == 'expired')
                        <span class="badge bg-danger">Expired</span>
                    @else
                        <span class="badge bg-warning">Suspended</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection