<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Veloria House</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .brand { color: #c9a84c; font-weight: 700; font-size: 1.5rem; }
        .btn-gold { background: #c9a84c; color: #fff; border: none; }
        .btn-gold:hover { background: #a8893d; color: #fff; }
        .form-control:focus { border-color: #c9a84c; box-shadow: 0 0 0 .2rem rgba(201,168,76,.25); }
    </style>
</head>
<body>
<div class="auth-card">
    <div class="text-center mb-4">
        <div class="brand">✦ Veloria House</div>
        <p class="text-muted small mt-1">Créez votre compte client</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2">
            @foreach($errors->all() as $e)<div class="small">{{ $e }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold small">Nom complet</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" placeholder="Votre nom" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">Adresse email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" placeholder="email@exemple.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">Mot de passe</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Min. 8 caractères" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold small">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-gold w-100 py-2">
            Créer mon compte
        </button>
    </form>

    <hr class="my-4">
    <p class="text-center text-muted small mb-0">
        Déjà un compte ?
        <a href="{{ route('login') }}" style="color:#c9a84c" class="fw-semibold">Se connecter</a>
    </p>
    <p class="text-center mt-2">
        <a href="{{ route('home') }}" class="text-muted small">← Retour à l'accueil</a>
    </p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>