@extends('layouts.admin')
@section('title', 'Réservations')
@section('page_title', 'Gestion des réservations')
@section('nav_reservations', 'active')

@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th><th>Client</th><th>Chambre</th><th>Arrivée</th><th>Départ</th><th>Total</th><th>Statut</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>
                            <strong>{{ $r->user->name }}</strong>
                            <small class="d-block text-muted">{{ $r->user->email }}</small>
                        </td>
                        <td>N°{{ $r->chambre->numero }} <small class="text-muted">({{ $r->chambre->type }})</small></td>
                        <td>{{ \Carbon\Carbon::parse($r->date_arrivee)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->date_depart)->format('d/m/Y') }}</td>
                        <td class="fw-bold">{{ number_format($r->prix_total, 2) }} MAD</td>
                        <td>
                            @php $c = ['en_attente'=>'warning','confirmee'=>'success','annulee'=>'danger','terminee'=>'info']; @endphp
                            <span class="badge bg-{{ $c[$r->statut] ?? 'secondary' }} text-dark">
                                {{ ucfirst(str_replace('_',' ',$r->statut)) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.reservations.show', $r) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.reservations.destroy', $r) }}" class="d-inline"
                                  onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Aucune réservation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reservations->hasPages())
    <div class="card-footer bg-white">{{ $reservations->links() }}</div>
    @endif
</div>
@endsection