@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Nutrisi - {{ $member->name }}</h2>
        <a href="{{ route('nutrition.create', $member->id) }}" class="btn btn-primary">
            + Catat Nutrisi Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Kalori</th>
                <th>Protein</th>
                <th>Karbo</th>
                <th>Lemak</th>
                <th>Deskripsi Makanan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->log_date->format('d M Y') }}</td>
                <td>{{ $log->calories_intake ?? '-' }} kkal</td>
                <td>{{ $log->protein_grams ?? '-' }}g</td>
                <td>{{ $log->carbs_grams ?? '-' }}g</td>
                <td>{{ $log->fats_grams ?? '-' }}g</td>
                <td>{{ Str::limit($log->meals_description, 60) ?? '-' }}</td>
                <td>{{ Str::limit($log->notes, 50) ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>

    <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary mt-3">Kembali ke Detail Member</a>
</div>
@endsection