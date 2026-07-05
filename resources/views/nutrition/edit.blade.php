@extends('layouts.main')

@section('content')
<div class="container">
    <h2>🥗 Edit Catatan Nutrisi - {{ $member->name }}</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('nutrition.update', $log) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="log_date" class="form-control" value="{{ $log->log_date->format('Y-m-d') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kalori Intake</label>
                        <input type="number" name="calories_intake" class="form-control" value="{{ $log->calories_intake }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Protein (g)</label>
                        <input type="number" name="protein_grams" class="form-control" value="{{ $log->protein_grams }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Karbohidrat (g)</label>
                        <input type="number" name="carbs_grams" class="form-control" value="{{ $log->carbs_grams }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lemak (g)</label>
                        <input type="number" name="fats_grams" class="form-control" value="{{ $log->fats_grams }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Makanan</label>
                    <textarea name="meals_description" class="form-control" rows="4">{{ $log->meals_description }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="notes" class="form-control" rows="3">{{ $log->notes }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Update Catatan Nutrisi</button>
                <a href="{{ route('nutrition.index', $member->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection