@extends('layouts.client')
@section('title', 'Paiements')
@section('page_title', 'Mes paiements')
@section('nav_paiements', 'active')

@section('content')

{{-- RÉSERVATIONS À PAYER --}}
@if($reservations_impayees->count())
<div class="card mb-4" style="border-left: 4px solid #f0ad4e">
    <div class="card-header bg-white fw-bold py-3 d-flex align-items-center gap-2">
        <i class="fas fa-exclamation-triangle text-warning"></i>
        Réservations à régler
        <span class="badge bg-warning text-dark ms-auto">{{ $reservations_impayees->count() }}</span>
    </div>
    <div class="card-body">
        @foreach($reservations_impayees as $r)
        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 mb-2"
             style="background:#fffbf0;border:1px solid rgba(201,168,76,.25)">
            <div>
                <strong>Chambre N°{{ $r->chambre->numero }}</strong>
                <small class="d-block text-muted">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ \Carbon\Carbon::parse($r->date_arrivee)->format('d/m/Y') }}
                    → {{ \Carbon\Carbon::parse($r->date_depart)->format('d/m/Y') }}
                </small>
                <span class="fw-bold" style="color:#c9a84c">{{ number_format($r->prix_total, 2) }} MAD</span>
            </div>
            <form method="POST" action="{{ route('client.paiements.store') }}" class="d-flex align-items-center gap-2">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $r->id }}">
                <select name="methode" class="form-select form-select-sm" style="width:140px" required>
                    <option value="carte">💳 Carte bancaire</option>
                    <option value="especes">💵 Espèces</option>
                    <option value="virement">🏦 Virement</option>
                </select>
                <button type="submit" class="btn btn-success btn-sm px-3">
                    <i class="fas fa-check me-1"></i>Payer
                </button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3">
    <i class="fas fa-check-circle fa-lg"></i>
    <span>Toutes vos réservations sont à jour. Aucun paiement en attente.</span>
</div>
@endif

{{-- HISTORIQUE --}}
<div class="card">
    <div class="card-header bg-white fw-bold py-3">
        <i class="fas fa-history me-2 text-muted"></i>Historique des paiements
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Chambre</th>
                        <th>Montant</th>
                        <th>Méthode</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paiements as $p)
                    <tr>
                        <td>
                            <strong>N°{{ $p->reservation->chambre->numero }}</strong>
                            <small class="d-block text-muted">{{ ucfirst($p->reservation->chambre->type) }}</small>
                        </td>
                        <td class="fw-bold" style="color:#c9a84c">{{ number_format($p->montant, 2) }} MAD</td>
                        <td>
                            @php $icons = ['carte'=>'💳','especes'=>'💵','virement'=>'🏦']; @endphp
                            {{ $icons[$p->methode] ?? '' }} {{ ucfirst($p->methode) }}
                        </td>
                        <td><span class="badge bg-success">{{ ucfirst($p->statut) }}</span></td>
                        <td class="text-muted small">
                            {{ $p->date_paiement ? \Carbon\Carbon::parse($p->date_paiement)->format('d/m/Y H:i') : '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="fas fa-receipt fa-2x d-block mb-2 opacity-25"></i>
                            Aucun paiement enregistré.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection