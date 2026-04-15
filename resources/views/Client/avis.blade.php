@extends('layouts.client')
@section('title', 'Mes avis')
@section('page_title', 'Mes avis')
@section('nav_avis', 'active')

@section('content')

<div class="row g-4">

    {{-- FORMULAIRE --}}
    <div class="col-lg-4">
        <div class="card" style="position:sticky;top:2rem">
            <div class="card-header bg-white fw-bold py-3">
                <i class="fas fa-star me-2" style="color:#c9a84c"></i>Laisser un avis
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('client.avis.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Note *</label>
                        <div class="d-flex gap-2 flex-wrap">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="note"
                                       value="{{ $i }}" id="note{{ $i }}"
                                       {{ old('note') == $i ? 'checked' : '' }} required>
                                <label class="form-check-label" for="note{{ $i }}">
                                    {{ $i }}<i class="fas fa-star ms-1" style="color:#c9a84c;font-size:.75rem"></i>
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Commentaire *</label>
                        <textarea name="commentaire" class="form-control" rows="5"
                                  placeholder="Partagez votre expérience à Veloria House..."
                                  required minlength="10" maxlength="500">{{ old('commentaire') }}</textarea>
                        <small class="text-muted">Entre 10 et 500 caractères.</small>
                    </div>
                    <button type="submit" class="btn btn-gold w-100">
                        <i class="fas fa-paper-plane me-2"></i>Publier mon avis
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MES AVIS --}}
    <div class="col-lg-8">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:.78rem;letter-spacing:1.5px">
            Mes avis publiés ({{ $mes_avis->count() }})
        </h6>

        @forelse($mes_avis as $a)
        <div class="card mb-3" style="border-top: 3px solid #c9a84c">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star" style="{{ $i <= $a->note ? 'color:#c9a84c' : 'color:#e0e0e0' }};font-size:.9rem"></i>
                        @endfor
                        <span class="ms-1 small text-muted">({{ $a->note }}/5)</span>
                    </div>
                    <small class="text-muted">{{ $a->created_at->format('d/m/Y') }}</small>
                </div>
                <p class="mb-0 text-muted" style="line-height:1.65">{{ $a->commentaire }}</p>
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body text-center text-muted py-5">
                <i class="fas fa-star fa-3x d-block mb-3 opacity-25"></i>
                <p class="mb-0">Vous n'avez pas encore publié d'avis.</p>
                <small>Utilisez le formulaire pour partager votre expérience.</small>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection