@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Pengukuran Tubuh - {{ $member->name }}</h2>
        <a href="{{ route('measurements.create', $member->id) }}" class="btn btn-primary">
            + Catat Pengukuran Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Berat (kg)</th>
                <th>Body Fat (%)</th>
                <th>Muscle Mass (kg)</th>
                <th>Dada (cm)</th>
                <th>Pinggang (cm)</th>
                <th>Lengan (cm)</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($measurements as $m)
            <tr>
                <td>{{ $m->measurement_date->format('d M Y') }}</td>
                <td><strong>{{ $m->weight_kg }} kg</strong></td>
                <td>{{ $m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-' }}</td>
                <td>{{ $m->muscle_mass_kg ?? '-' }} kg</td>
                <td>{{ $m->chest_cm ?? '-' }} cm</td>
                <td>{{ $m->waist_cm ?? '-' }} cm</td>
                <td>{{ $m->arm_cm ?? '-' }} cm</td>
                <td>
                    <a href="{{ route('measurements.edit', $m) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                    
                    <form action="{{ route('measurements.destroy', $m) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus pengukuran ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $measurements->links() }}
    </div>

    <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary mt-3">Kembali ke Detail Member</a>
</div>
@endsection