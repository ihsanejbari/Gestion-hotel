@extends('layouts.client')
@section('title', 'Mon espace')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold">Bonjour, {{ auth()->user()->name }} 👋</h4>
    <p class="text-muted">Bienvenue dans votre espace personnel —  Veloria House.</p>
</div>

{{-- STATS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="card text-center p-3" style="border-top: 4px solid #c9a84c">
            <div class="fw-bold fs-3" style="color:#c9a84c">{{ $chambres_count }}</div>
            <p class="text-muted small mb-0">Chambres disponibles</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card text-center p-3" style="border-top: 4px solid #667eea">
            <div class="fw-bold fs-3" style="color:#667eea">{{ $reservations_count }}</div>
            <p class="text-muted small mb-0">Mes réservations</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card text-center p-3" style="border-top: 4px solid #43e97b">
            <div class="fw-bold fs-3" style="color:#43e97b">{{ $paiements_count }}</div>
            <p class="text-muted small mb-0">Paiements effectués</p>
        </div>
    </div>
</div>

{{-- RACCOURCIS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <a href="{{ route('client.chambres') }}" class="text-decoration-none">
            <div class="card text-center p-3 h-100">
                <div style="font-size:2rem;color:#c9a84c">🛏</div>
                <p class="mb-0 fw-semibold small mt-2">Chambres</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('client.reservations') }}" class="text-decoration-none">
            <div class="card text-center p-3 h-100">
                <div style="font-size:2rem;color:#667eea">📅</div>
                <p class="mb-0 fw-semibold small mt-2">Réservations</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('client.paiements') }}" class="text-decoration-none">
            <div class="card text-center p-3 h-100">
                <div style="font-size:2rem;color:#43e97b">💳</div>
                <p class="mb-0 fw-semibold small mt-2">Paiements</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('client.avis') }}" class="text-decoration-none">
            <div class="card text-center p-3 h-100">
                <div style="font-size:2rem;color:#f5576c">⭐</div>
                <p class="mb-0 fw-semibold small mt-2">Mes avis</p>
            </div>
        </a>
    </div>
</div>

{{-- DERNIÈRES RÉSERVATIONS --}}
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold">Mes dernières réservations</span>
        <a href="{{ route('client.reservations') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Chambre</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Total</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                    <tr>
                        <td>N°{{ $r->chambre->numero }}
                            <small class="text-muted d-block">{{ ucfirst($r->chambre->type) }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($r->date_arrivee)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->date_depart)->format('d/m/Y') }}</td>
                        <td class="fw-bold">{{ number_format($r->prix_total, 2) }} MAD</td>
                        <td>
                            @php
                                $colors = [
                                    'en_attente' => 'warning',
                                    'confirmee'  => 'success',
                                    'annulee'    => 'danger',
                                    'terminee'   => 'info'
                                ];
                            @endphp
                            <span class="badge bg-{{ $colors[$r->statut] ?? 'secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $r->statut)) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Aucune réservation. <a href="{{ route('client.chambres') }}">Voir les chambres</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection