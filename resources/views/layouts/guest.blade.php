<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Veloria House')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --gold: #c9a84c; }
        .navbar-brand span { color: var(--gold); }
        .btn-gold { background-color: var(--gold); color: #fff; border: none; }
        .btn-gold:hover { background-color: #a8893d; color: #fff; }
        .hero { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 90vh; display: flex; align-items: center; }
        .card { border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform .2s; }
        .card:hover { transform: translateY(-4px); }
        footer { background: #1a1a2e; color: #aaa; }
        .star { color: var(--gold); }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">✦ Veloria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.chambres') }}">Chambres</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.avis') }}">Avis</a></li>
            </ul>
            <div class="d-flex gap-2">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-gold btn-sm">Dashboard</a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="btn btn-gold btn-sm">Mon espace</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-gold btn-sm">Inscription</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@yield('content')

<footer class="py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1">© {{ date('Y') }} Veloria House — Tous droits réservés</p>
        <small>Confort & Élégance depuis 2010</small>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>