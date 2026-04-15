@extends('layouts.admin')
@section('title', 'Réservation #' . $reservation->id)
@section('page_title', 'Détail réservation #' . $reservation->id)
@section('nav_reservations', 'active')

@section('content')
<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-bold"><i class="fas fa-user me-2 text-primary"></i>Client</div>
            <div class="card-body">
                <p><strong>Nom :</strong> {{ $reservation->user->name }}</p>
                <p><strong>Email :</strong> {{ $reservation->user->email }}</p>
                <p class="mb-0"><strong>Rôle :</strong> {{ ucfirst($reservation->user->role) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-bold"><i class="fas fa-door-open me-2 text-warning"></i>Chambre</div>
            <div class="card-body">
                <p><strong>Numéro :</strong> {{ $reservation->chambre->numero }}</p>
                <p><strong>Type :</strong> {{ ucfirst($reservation->chambre->type) }}</p>
                <p class="mb-0"><strong>Prix/nuit :</strong> {{ number_format($reservation->chambre->prix, 2) }} MAD</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white fw-bold"><i class="fas fa-calendar me-2 text-success"></i>Séjour</div>
            <div class="card-body">
                <p><strong>Arrivée :</strong> {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</p>
                <p><strong>Départ :</strong> {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</p>
                <p><strong>Durée :</strong>
                    {{ \Carbon\Carbon::parse($reservation->date_arrivee)->diffInDays($reservation->date_depart) }} nuits
                </p>
                <p class="mb-0"><strong>Total :</strong> <span class="fw-bold fs-5 text-success">{{ number_format($reservation->prix_total, 2) }} MAD</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white fw-bold"><i class="fas fa-cog me-2 text-danger"></i>Changer le statut</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}">
                    @csrf @method('PUT')
                    <select name="statut" class="form-select mb-3">
                        @foreach(['en_attente','confirmee','annulee','terminee'] as $s)
                            <option value="{{ $s }}" {{ $reservation->statut == $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_',' ',$s)) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                </form>
            </div>
        </div>
        @if($reservation->paiement)
        <div class="card mt-3">
            <div class="card-header bg-white fw-bold"><i class="fas fa-credit-card me-2 text-info"></i>Paiement</div>
            <div class="card-body">
                <p><strong>Montant :</strong> {{ number_format($reservation->paiement->montant, 2) }} MAD</p>
                <p><strong>Méthode :</strong> {{ ucfirst($reservation->paiement->methode) }}</p>
                <p class="mb-0"><strong>Statut :</strong>
                    <span class="badge bg-success">{{ ucfirst($reservation->paiement->statut) }}</span>
                </p>
            </div>
        </div>
        @endif
    </div>
    @if($reservation->notes)
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white fw-bold">Notes</div>
            <div class="card-body">{{ $reservation->notes }}</div>
        </div>
    </div>
    @endif
</div>
<div class="mt-3">
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">← Retour</a>
</div>
@endsection