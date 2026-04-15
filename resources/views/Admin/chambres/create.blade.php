@extends('layouts.admin')
@section('title', 'Nouvelle chambre')
@section('page_title', 'Ajouter une chambre')
@section('nav_chambres', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.chambres.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Numéro *</label>
                            <input type="text" name="numero" class="form-control" value="{{ old('numero') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                @foreach(['simple','double','suite','familiale'] as $t)
                                    <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Prix / nuit (MAD) *</label>
                            <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Capacité (pers.) *</label>
                            <input type="number" name="capacite" class="form-control" value="{{ old('capacite', 1) }}" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Statut *</label>
                            <select name="statut" class="form-select" required>
                                @foreach(['disponible','occupee','maintenance'] as $s)
                                    <option value="{{ $s }}" {{ old('statut') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Photo</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-12 d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-gold">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                            <a href="{{ route('admin.chambres.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>.btn-gold { background-color: #c9a84c; color: #fff; } .btn-gold:hover { background-color: #a8893d; color: #fff; }</style>
@endsection