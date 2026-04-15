@extends('layouts.admin')
@section('title', 'Chambres')
@section('page_title', 'Gestion des chambres')
@section('nav_chambres', 'active')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.chambres.create') }}" class="btn btn-gold">
        <i class="fas fa-plus me-2"></i>Nouvelle chambre
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th><th>N°</th><th>Type</th><th>Capacité</th><th>Prix/nuit</th><th>Statut</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chambres as $c)
                    <tr>
                        <td>
                            @if($c->image)
                                <img src="{{ Storage::url($c->image) }}" style="width:50px;height:40px;object-fit:cover;border-radius:6px" alt="">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width:50px;height:40px;border-radius:6px">
                                    <i class="fas fa-bed text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $c->numero }}</td>
                        <td>{{ ucfirst($c->type) }}</td>
                        <td>{{ $c->capacite }} pers.</td>
                        <td>{{ number_format($c->prix, 2) }} MAD</td>
                        <td>
                            @php
                                $badges = ['disponible' => 'success', 'occupee' => 'danger', 'maintenance' => 'warning'];
                            @endphp
                            <span class="badge bg-{{ $badges[$c->statut] ?? 'secondary' }}">{{ ucfirst($c->statut) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.chambres.edit', $c) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.chambres.destroy', $c) }}" class="d-inline"
                                  onsubmit="return confirm('Supprimer cette chambre ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Aucune chambre.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($chambres->hasPages())
    <div class="card-footer bg-white">{{ $chambres->links() }}</div>
    @endif
</div>

<style>.btn-gold { background-color: #c9a84c; color: #fff; } .btn-gold:hover { background-color: #a8893d; color: #fff; }</style>
@endsection