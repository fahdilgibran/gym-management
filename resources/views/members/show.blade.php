@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Detail Member - {{ $member->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Member Code:</strong> {{ $member->member_code }}</p>
                    <p><strong>Nama:</strong> {{ $member->name }}</p>
                    <p><strong>Email:</strong> {{ $member->email ?? '-' }}</p>
                    <p><strong>Telepon:</strong> {{ $member->phone }}</p>
                    <p><strong>Gender:</strong> {{ $member->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Lahir:</strong> {{ $member->birth_date ? $member->birth_date->format('Y-m-d') : '-' }}</p>
                    <p><strong>Jenis Membership:</strong> {{ ucfirst($member->membership_type) }}</p>
                    <p><strong>Tanggal Mulai:</strong> {{ $member->start_date ? $member->start_date->format('Y-m-d') : '-' }}</p>
                    <p><strong>Tanggal Berakhir:</strong> {{ $member->expire_date ? $member->expire_date->format('Y-m-d') : '-' }}</p>
                    <p><strong>Status:</strong> 
                        @if($member->status == 'active')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($member->status == 'expired')
                            <span class="badge bg-danger">Expired</span>
                        @else
                            <span class="badge bg-warning">Suspended</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection