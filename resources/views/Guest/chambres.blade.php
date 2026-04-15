@extends('layouts.guest')
@section('title', 'Nos Chambres')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-1">Nos Chambres</h2>
    <p class="text-muted mb-4">Toutes nos chambres disponibles</p>
    <div class="row g-4">
        @forelse($chambres as $chambre)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">
                @if($chambre->image)
                    <img src="{{ Storage::url($chambre->image) }}" class="card-img-top" style="height:180px;object-fit:cover" alt="">
                @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:180px">
                        <i class="fas fa-bed fa-2x text-white opacity-50"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h6 class="fw-bold">Chambre {{ $chambre->numero }}</h6>
                    <p class="small text-muted mb-1">
                        <i class="fas fa-tag me-1"></i>{{ ucfirst($chambre->type) }}
                        &nbsp;|&nbsp;
                        <i class="fas fa-users me-1"></i>{{ $chambre->capacite }} pers.
                    </p>
                    <p class="small text-muted">{{ Str::limit($chambre->description, 70) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold" style="color:#c9a84c">{{ number_format($chambre->prix, 2) }} MAD</span>
                        <a href="{{ route('register') }}" class="btn btn-gold btn-sm">Réserver</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">Aucune chambre disponible.</div>
        @endforelse
    </div>
</div>
@endsection