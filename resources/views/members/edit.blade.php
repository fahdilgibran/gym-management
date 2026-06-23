@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Data Member</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('members.update', $member) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Member Code</label>
                        <input type="text" name="member_code" class="form-control" value="{{ old('member_code', $member->member_code) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $member->birth_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="M" {{ $member->gender == 'M' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="F" {{ $member->gender == 'F' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Jenis Membership</label>
                        <select name="membership_type" class="form-control">
                            <option value="monthly" {{ $member->membership_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="quarterly" {{ $member->membership_type == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                            <option value="annual" {{ $member->membership_type == 'annual' ? 'selected' : '' }}>Annual</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $member->start_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="expire_date" class="form-control" value="{{ old('expire_date', $member->expire_date?->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning">Update Data Member</button>
                <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection