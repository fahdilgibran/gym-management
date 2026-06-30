@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Catat Nutrisi Harian - {{ $member->name }}</h2>
    <p class="text-muted">Member Code: <strong>{{ $member->member_code }}</strong></p>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('nutrition.store', $member->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="log_date" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kalori Intake (kkal)</label>
                        <input type="number" name="calories_intake" class="form-control" placeholder="Contoh: 2200">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Protein (gram)</label>
                        <input type="number" name="protein_grams" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Karbohidrat (gram)</label>
                        <input type="number" name="carbs_grams" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lemak (gram)</label>
                        <input type="number" name="fats_grams" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Makanan</label>
                    <textarea name="meals_description" class="form-control" rows="4" 
                        placeholder="Contoh: Nasi ayam + sayur + telur + whey protein"></textarea>
                </div>

                <div class="mb-3">
                    <label>Catatan Tambahan</label>
                    <textarea name="notes" class="form-control" rows="3" 
                        placeholder="Contoh: Sedang defisit kalori, kurangi karbo..."></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan Catatan Nutrisi</button>
                <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection