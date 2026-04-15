@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Tableau de bord')
@section('nav_dashboard', 'active')

@section('content')
{{-- STATS --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#667eea,#764ba2)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 opacity-75">Chambres</p>
                    <h2 class="mb-0 fw-bold">{{ $stats['chambres'] }}</h2>
                </div>
                <i class="fas fa-door-open fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f093fb,#f5576c)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 opacity-75">Réservations</p>
                    <h2 class="mb-0 fw-bold">{{ $stats['reservations'] }}</h2>
                </div>
                <i class="fas fa-calendar-check fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#4facfe,#00f2fe)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 opacity-75">Clients</p>
                    <h2 class="mb-0 fw-bold">{{ $stats['clients'] }}</h2>
                </div>
                <i class="fas fa-users fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#43e97b,#38f9d7)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 opacity-75">Revenus</p>
                    <h2 class="mb-0 fw-bold">{{ number_format($stats['revenus'], 0) }} MAD</h2>
                </div>
                <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

{{-- RÉSERVATIONS RÉCENTES --}}
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Réservations récentes</h6>
        @if($stats['en_attente'] > 0)
            <span class="badge bg-warning text-dark">{{ $stats['en_attente'] }} en attente</span>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Client</th>
                        <th>Chambre</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations_recentes as $r)
                    <tr>
                        <td>{{ $r->user->name }}</td>
                        <td>N°{{ $r->chambre->numero }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->date_arrivee)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->date_depart)->format('d/m/Y') }}</td>
                        <td>{{ number_format($r->prix_total, 2) }} MAD</td>
                        <td>
                            <span class="badge badge-{{ $r->statut }} px-2 py-1 rounded">
                                {{ ucfirst(str_replace('_', ' ', $r->statut)) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.reservations.show', $r) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Aucune réservation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm btn-outline-secondary">Voir toutes →</a>
    </div>
</div>
@endsection