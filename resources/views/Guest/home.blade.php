@extends('layouts.guest')
@section('title', 'Accueil')

@section('content')

{{-- ══ HERO ══ --}}
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center text-white">
        <p class="hero-subtitle">BIENVENUE À</p>
        <h1 class="hero-title">Veloria House</h1>
        <p class="hero-desc">
            Confort, élégance et service exceptionnel au cœur d'Agadir. Vivez<br>
            une expérience hôtelière inoubliable.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('guest.chambres') }}" class="btn-hero btn-hero-gold">
                <i class="fas fa-door-open me-2"></i>Voir nos chambres
            </a>
            <a href="{{ route('register') }}" class="btn-hero btn-hero-outline">
                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
            </a>
        </div>
    </div>
</section>

<style>
.hero-section {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1600&q=80') center center / cover no-repeat;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(10,10,30,.62) 0%, rgba(10,10,30,.45) 60%, rgba(10,10,30,.7) 100%);
}
.hero-content {
    position: relative;
    z-index: 2;
    max-width: 780px;
    padding: 0 1.5rem;
}
.hero-subtitle {
    font-size: .82rem;
    letter-spacing: 5px;
    color: #c9a84c;
    font-weight: 600;
    margin-bottom: .6rem;
}
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 900;
    line-height: 1.08;
    margin-bottom: 1.2rem;
    color: #fff;
    text-shadow:
        0 0 30px rgba(201,168,76,.55),
        0 0 80px rgba(201,168,76,.25),
        0 2px 8px rgba(0,0,0,.5);
    animation: glowPulse 3s ease-in-out infinite;
}
@keyframes glowPulse {
    0%, 100% { text-shadow: 0 0 30px rgba(201,168,76,.55), 0 0 80px rgba(201,168,76,.25), 0 2px 8px rgba(0,0,0,.5); }
    50%       { text-shadow: 0 0 50px rgba(201,168,76,.8),  0 0 120px rgba(201,168,76,.4), 0 2px 8px rgba(0,0,0,.5); }
}
.hero-desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,.82);
    line-height: 1.7;
    margin-bottom: 2.2rem;
}
.hero-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.btn-hero {
    padding: .78rem 2rem;
    border-radius: 6px;
    font-size: .97rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
}
.btn-hero-gold {
    background: #c9a84c;
    color: #fff;
    box-shadow: 0 4px 18px rgba(201,168,76,.45);
}
.btn-hero-gold:hover {
    background: #b8943e;
    color: #fff;
    transform: scale(1.07);
    box-shadow: 0 8px 30px rgba(201,168,76,.65);
}
.btn-hero-outline {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,.75);
}
.btn-hero-outline:hover {
    background: rgba(255,255,255,.12);
    color: #fff;
    border-color: #fff;
    transform: scale(1.07);
    box-shadow: 0 6px 24px rgba(255,255,255,.15);
}
</style>

{{-- ══ STATS ══ --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center g-4">
            @foreach([['50+','Chambres disponibles'],['1000+','Clients satisfaits'],['15+','Années d\'expérience'],['4.8★','Note moyenne']] as $s)
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <h2 class="fw-bold mb-1" style="color:#c9a84c">{{ $s[0] }}</h2>
                    <p class="text-muted mb-0 small">{{ $s[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CHAMBRES ══ --}}
<section class="py-5" style="background:#f9f7f4">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase small fw-bold" style="color:#c9a84c;letter-spacing:3px">Notre sélection</p>
            <h2 class="fw-bold" style="font-family:'Playfair Display',serif;font-size:2.2rem">Nos Chambres</h2>
        </div>
        <div class="row g-4">
            @forelse($chambres as $chambre)
            <div class="col-md-4">
                <div class="room-card">
                    <div class="room-img-wrap">
                        @if($chambre->image)
                            <img src="{{ Storage::url($chambre->image) }}" class="room-img" alt="">
                        @else
                            <div class="room-img room-img-placeholder">
                                <i class="fas fa-bed fa-3x text-white opacity-50"></i>
                            </div>
                        @endif
                        <span class="room-badge">{{ ucfirst($chambre->type) }}</span>
                    </div>
                    <div class="room-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0 fw-bold">Chambre {{ $chambre->numero }}</h5>
                            <span class="text-muted small"><i class="fas fa-users me-1"></i>{{ $chambre->capacite }} pers.</span>
                        </div>
                        <p class="text-muted small mb-3">{{ Str::limit($chambre->description, 90) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5" style="color:#c9a84c">{{ number_format($chambre->prix, 2) }} <small class="text-muted fw-normal fs-6">MAD/nuit</small></span>
                            <a href="{{ route('register') }}" class="btn-room">Réserver</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">Aucune chambre disponible.</div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('guest.chambres') }}" class="btn-hero btn-hero-gold" style="display:inline-flex">
                Voir toutes nos chambres
            </a>
        </div>
    </div>
</section>

<style>
.room-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
    transition: transform .22s ease, box-shadow .22s ease;
}
.room-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(0,0,0,.14); }
.room-img-wrap { position: relative; }
.room-img { width: 100%; height: 210px; object-fit: cover; display: block; }
.room-img-placeholder { background: #555; display: flex; align-items: center; justify-content: center; }
.room-badge {
    position: absolute; top: 12px; left: 12px;
    background: #c9a84c; color: #fff;
    font-size: .75rem; font-weight: 700;
    padding: .25rem .7rem; border-radius: 50px;
    letter-spacing: .5px; text-transform: uppercase;
}
.room-body { padding: 1.2rem 1.3rem 1.4rem; }
.btn-room {
    background: #1a1a2e; color: #fff;
    padding: .45rem 1.1rem; border-radius: 6px;
    font-size: .88rem; font-weight: 600;
    text-decoration: none;
    transition: transform .18s, background .18s, box-shadow .18s;
}
.btn-room:hover {
    background: #c9a84c; color: #fff;
    transform: scale(1.07);
    box-shadow: 0 4px 14px rgba(201,168,76,.45);
}
</style>

{{-- ══ AVIS ══ --}}
@if($avis->count())
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase small fw-bold" style="color:#c9a84c;letter-spacing:3px">Témoignages</p>
            <h2 class="fw-bold" style="font-family:'Playfair Display',serif;font-size:2.2rem">Ce que disent nos clients</h2>
        </div>
        <div class="row g-4">
            @foreach($avis as $a)
            <div class="col-md-4">
                <div class="avis-card">
                    <div class="stars mb-2">
                        @for($i=1;$i<=5;$i++)
                            <i class="fas fa-star {{ $i<=$a->note ? 'star-on' : 'star-off' }}"></i>
                        @endfor
                    </div>
                    <p class="avis-text">"{{ Str::limit($a->commentaire, 120) }}"</p>
                    <div class="avis-author">
                        <div class="avis-avatar">{{ strtoupper(substr($a->user->name,0,1)) }}</div>
                        <div>
                            <strong class="d-block">{{ $a->user->name }}</strong>
                            <small class="text-muted">{{ $a->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.avis-card {
    background: #fff;
    border-radius: 14px;
    padding: 1.6rem;
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    border-top: 3px solid #c9a84c;
    transition: transform .2s, box-shadow .2s;
}
.avis-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,.12); }
.star-on  { color: #c9a84c; font-size: .9rem; }
.star-off { color: #ddd;    font-size: .9rem; }
.avis-text { color: #555; font-style: italic; line-height: 1.65; margin: .8rem 0 1.2rem; }
.avis-author { display: flex; align-items: center; gap: 10px; }
.avis-avatar {
    width: 38px; height: 38px;
    background: #1a1a2e; color: #c9a84c;
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    font-weight: 800; font-size: .95rem; flex-shrink: 0;
}
</style>
@endif

@endsection