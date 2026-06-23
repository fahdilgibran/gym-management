@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Tambah Member Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Member Code</label>
                        <input type="text" name="member_code" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. Telepon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="M">Laki-laki</option>
                            <option value="F">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Jenis Membership</label>
                        <select name="membership_type" class="form-control">
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="annual">Annual</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="expire_date" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Member</button>
                <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto generate Member Code
    document.addEventListener('DOMContentLoaded', function() {
        const codeInput = document.querySelector('input[name="member_code"]');
        if (codeInput) {
            codeInput.value = 'MEM-' + Math.floor(1000 + Math.random() * 9000);
        }
    });
</script>
@endsection