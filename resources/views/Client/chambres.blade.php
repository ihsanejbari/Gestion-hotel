@extends('layouts.client')
@section('title', 'Chambres disponibles')

@section('content')
<h4 class="fw-bold mb-4">Chambres disponibles</h4>
<div class="row g-4">
    @forelse($chambres as $chambre)
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius:14px;overflow:hidden">
            @if($chambre->image)
                <img src="{{ Storage::url($chambre->image) }}"
                     style="height:210px;object-fit:cover;width:100%" alt="">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light"
                     style="height:210px">
                    <span style="font-size:3rem;opacity:.3">🛏</span>
                </div>
            @endif
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">Chambre {{ $chambre->numero }}</h5>
                    <span class="badge bg-success">Disponible</span>
                </div>
                <p class="text-muted small mb-2">
                    {{ ucfirst($chambre->type) }} · {{ $chambre->capacite }} pers.
                </p>
                <p class="text-muted small">{{ Str::limit($chambre->description, 90) }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="fw-bold fs-5" style="color:#c9a84c">
                        {{ number_format($chambre->prix, 2) }} MAD
                        <small class="text-muted fw-normal" style="font-size:.75rem">/nuit</small>
                    </span>
                    <a href="{{ route('client.reservations') }}?chambre_id={{ $chambre->id }}"
                       class="btn btn-sm fw-semibold"
                       style="background:#c9a84c;color:#fff;border-radius:8px;padding:.4rem 1rem">
                        Réserver
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">
        <span style="font-size:3rem;opacity:.2;display:block;margin-bottom:1rem">🛏</span>
        Aucune chambre disponible pour le moment.
    </div>
    @endforelse
</div>
@endsection