@extends('layouts.guest')
@section('title', 'Avis clients')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-1">Avis de nos clients</h2>
    <p class="text-muted mb-4">Ce que pensent les voyageurs qui ont séjourné chez nous</p>
    <div class="row g-4">
        @forelse($avis as $a)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-3">
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $a->note ? '' : 'text-muted' }}" style="{{ $i <= $a->note ? 'color:#c9a84c' : '' }}"></i>
                    @endfor
                    <span class="ms-1 small text-muted">({{ $a->note }}/5)</span>
                </div>
                <p class="text-muted fst-italic flex-grow-1">"{{ $a->commentaire }}"</p>
                <div class="pt-2 border-top mt-auto">
                    <strong>{{ $a->user->name }}</strong>
                    <small class="text-muted d-block">{{ $a->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">Aucun avis pour le moment.</div>
        @endforelse
    </div>
</div>
@endsection