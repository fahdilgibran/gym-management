@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Pengukuran Tubuh - {{ $member->name }}</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('measurements.update', $measurement) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengukuran</label>
                        <input type="date" name="measurement_date" class="form-control" value="{{ $measurement->measurement_date->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control" value="{{ $measurement->weight_kg }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Body Fat (%)</label>
                        <input type="number" step="0.1" name="body_fat_percentage" class="form-control" value="{{ $measurement->body_fat_percentage }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Muscle Mass (kg)</label>
                        <input type="number" step="0.1" name="muscle_mass_kg" class="form-control" value="{{ $measurement->muscle_mass_kg }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Lingkar Dada (cm)</label>
                        <input type="number" step="0.1" name="chest_cm" class="form-control" value="{{ $measurement->chest_cm }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Lingkar Pinggang (cm)</label>
                        <input type="number" step="0.1" name="waist_cm" class="form-control" value="{{ $measurement->waist_cm }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lingkar Lengan (cm)</label>
                        <input type="number" step="0.1" name="arm_cm" class="form-control" value="{{ $measurement->arm_cm }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="notes" class="form-control" rows="4">{{ $measurement->notes }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Update Pengukuran</button>
                <a href="{{ route('measurements.index', $member->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection