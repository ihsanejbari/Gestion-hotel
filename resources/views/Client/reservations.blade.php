@extends('layouts.client')
@section('title', 'Mes réservations')

@section('content')
<div class="row g-4">

    {{-- FORMULAIRE --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px;border-radius:14px">
            <div class="card-header bg-white fw-bold border-0 pt-4 px-4"
                 style="border-radius:14px 14px 0 0">
                <i class="fas fa-plus-circle me-2 text-success"></i>Nouvelle réservation
            </div>
            <div class="card-body px-4 pb-4">
                <form method="POST" action="{{ route('client.reservations.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Chambre *</label>
                        <select name="chambre_id" class="form-select" required>
                            <option value="">-- Choisir une chambre --</option>
                            @foreach($chambres as $c)
                                <option value="{{ $c->id }}"
                                    {{ (request('chambre_id') == $c->id || old('chambre_id') == $c->id) ? 'selected' : '' }}>
                                    N°{{ $c->numero }} — {{ ucfirst($c->type) }}
                                    ({{ number_format($c->prix, 2) }} MAD/nuit)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Date d'arrivée *</label>
                        <input type="date" name="date_arrivee" class="form-control"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('date_arrivee') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Date de départ *</label>
                        <input type="date" name="date_depart" class="form-control"
                               value="{{ old('date_depart') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Notes</label>
                        <textarea name="notes" class="form-control" rows="2"
                                  placeholder="Demandes spéciales...">{{ old('notes') }}</textarea>
                    </div>

                    {{-- Calcul du total en temps réel --}}
                    <div id="prix-preview" class="alert alert-light border py-2 px-3 mb-3 d-none">
                        <small class="text-muted">Estimation :</small>
                        <strong id="prix-total" class="d-block" style="color:#c9a84c;font-size:1.1rem"></strong>
                    </div>

                    <button type="submit" class="btn w-100 fw-semibold py-2"
                            style="background:#c9a84c;color:#fff;border-radius:8px">
                        <i class="fas fa-check me-2"></i>Confirmer la réservation
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- LISTE --}}
    <div class="col-lg-8">
        <h5 class="fw-bold mb-3">Mes réservations</h5>

        @forelse($reservations as $r)
        <div class="card mb-3 border-0 shadow-sm" style="border-radius:12px">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold mb-1">
                            Chambre N°{{ $r->chambre->numero }}
                            <span class="text-muted fw-normal">— {{ ucfirst($r->chambre->type) }}</span>
                        </h6>
                        <p class="text-muted small mb-1">
                            📅
                            {{ \Carbon\Carbon::parse($r->date_arrivee)->format('d/m/Y') }}
                            →
                            {{ \Carbon\Carbon::parse($r->date_depart)->format('d/m/Y') }}
                            <span class="ms-1">({{ \Carbon\Carbon::parse($r->date_arrivee)->diffInDays($r->date_depart) }} nuits)</span>
                        </p>
                        @if($r->notes)
                        <p class="text-muted small mb-1">📝 {{ $r->notes }}</p>
                        @endif
                        @if($r->paiement)
                        <small class="text-success">
                            <i class="fas fa-check-circle me-1"></i>Payé
                        </small>
                        @endif
                    </div>
                    <div class="text-end">
                        @php
                            $colors = [
                                'en_attente' => 'warning',
                                'confirmee'  => 'success',
                                'annulee'    => 'danger',
                                'terminee'   => 'info',
                            ];
                        @endphp
                        <span class="badge bg-{{ $colors[$r->statut] ?? 'secondary' }} mb-2 d-block">
                            {{ ucfirst(str_replace('_', ' ', $r->statut)) }}
                        </span>
                        <strong style="color:#c9a84c;font-size:1.05rem">
                            {{ number_format($r->prix_total, 2) }} MAD
                        </strong>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card border-0 shadow-sm" style="border-radius:12px">
            <div class="card-body text-center text-muted py-5">
                <span style="font-size:3rem;opacity:.2;display:block;margin-bottom:1rem">📅</span>
                Aucune réservation.
                <a href="{{ route('client.chambres') }}" style="color:#c9a84c">
                    Voir les chambres disponibles
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- Script calcul automatique du total --}}
<script>
const prix = {
    @foreach($chambres as $c)
    {{ $c->id }}: {{ $c->prix }},
    @endforeach
};

function updateTotal() {
    const chambreId  = document.querySelector('[name="chambre_id"]').value;
    const arrivee    = document.querySelector('[name="date_arrivee"]').value;
    const depart     = document.querySelector('[name="date_depart"]').value;
    const preview    = document.getElementById('prix-preview');
    const totalEl    = document.getElementById('prix-total');

    if (chambreId && arrivee && depart) {
        const d1   = new Date(arrivee);
        const d2   = new Date(depart);
        const days = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));
        if (days > 0 && prix[chambreId]) {
            const total = (days * prix[chambreId]).toFixed(2);
            totalEl.textContent = days + ' nuits × ' + prix[chambreId].toFixed(2) + ' = ' + total + ' MAD';
            preview.classList.remove('d-none');
            return;
        }
    }
    preview.classList.add('d-none');
}

document.querySelector('[name="chambre_id"]').addEventListener('change', updateTotal);
document.querySelector('[name="date_arrivee"]').addEventListener('change', updateTotal);
document.querySelector('[name="date_depart"]').addEventListener('change', updateTotal);

// Déclencher si chambre déjà sélectionnée via URL
window.addEventListener('load', updateTotal);
</script>
@endsection