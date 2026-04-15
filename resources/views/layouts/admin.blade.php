<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Veloria House</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>✦</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #c9a84c; --sidebar-bg: #1a1a2e; }
        body { display: flex; min-height: 100vh; background: #f4f6f9; }

        /* ── Sidebar ── */
        .sidebar { width: 260px; background: var(--sidebar-bg); min-height: 100vh; flex-shrink: 0; display: flex; flex-direction: column; }

        .sidebar .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            text-align: center;
            padding: 2rem 1rem 1.5rem;
            border-bottom: 1px solid #2d2d4e;
            text-shadow: 0 0 18px rgba(201,168,76,.4);
        }
        .sidebar .brand .diamond {
            display: inline-block;
            margin-right: 6px;
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .sidebar .nav-link {
            color: #ccc;
            padding: .7rem 1.3rem;
            border-radius: 8px;
            margin: 3px 10px;
            font-size: .95rem;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
        }
        .sidebar .nav-link:hover {
            background: var(--gold);
            color: #fff;
            transform: scale(1.04);
            box-shadow: 0 4px 16px rgba(201,168,76,.4);
        }
        .sidebar .nav-link.active {
            background: var(--gold);
            color: #fff;
            box-shadow: 0 4px 16px rgba(201,168,76,.35);
        }
        .sidebar .nav-link i { width: 22px; }

        /* ── Main ── */
        .main { flex: 1; padding: 2rem; overflow-x: hidden; }
        .topbar {
            background: #fff;
            border-radius: 10px;
            padding: .75rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 14px;
            padding: 1.5rem;
            color: #fff;
            box-shadow: 0 6px 20px rgba(0,0,0,.15);
            transition: transform .2s ease, box-shadow .2s ease;
            cursor: default;
        }
        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 36px rgba(0,0,0,.25);
        }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 18px rgba(0,0,0,.08);
            transition: box-shadow .2s ease;
        }

        /* ── Table rows ── */
        .table-hover tbody tr {
            transition: transform .15s ease, background .15s ease;
        }
        .table-hover tbody tr:hover {
            transform: translateX(4px);
            background-color: #fffbf0 !important;
        }

        /* ── Status badges ── */
        .badge-en_attente { background: #fff3cd; color: #856404; }
        .badge-confirmee  { background: #d1e7dd; color: #0f5132; }
        .badge-annulee    { background: #f8d7da; color: #842029; }
        .badge-terminee   { background: #cfe2ff; color: #084298; }

        /* ── Buttons ── */
        .btn-gold { background-color: var(--gold); color: #fff; border: none; }
        .btn-gold:hover { background-color: #a8893d; color: #fff; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <span class="diamond">✦</span> 
        {{ auth()->user()->role === 'admin' ? 'Admin Panel' : 'Client Panel' }}
    </div>
    <nav class="nav flex-column pt-3 flex-grow-1">

    @if(auth()->user()->role === 'admin')

        <a href="{{ route('admin.dashboard') }}" class="nav-link @yield('nav_dashboard')">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('admin.chambres.index') }}" class="nav-link @yield('nav_chambres')">
            <i class="fas fa-door-open"></i> Chambres
        </a>
        <a href="{{ route('admin.reservations.index') }}" class="nav-link @yield('nav_reservations')">
            <i class="fas fa-calendar-check"></i> Réservations
        </a>
        <a href="{{ route('admin.avis.index') }}" class="nav-link @yield('nav_avis')">
            <i class="fas fa-star"></i> Avis
        </a>

    @else

        <a href="{{ route('client.dashboard') }}" class="nav-link @yield('nav_dashboard')">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('client.chambres') }}" class="nav-link">
            <i class="fas fa-door-open"></i> Chambres
        </a>
        <a href="{{ route('client.reservations') }}" class="nav-link">
            <i class="fas fa-calendar-check"></i> Réservations
        </a>
        <a href="{{ route('client.paiements') }}" class="nav-link">
            <i class="fas fa-credit-card"></i> Paiements
        </a>
        <a href="{{ route('client.avis') }}" class="nav-link">
            <i class="fas fa-star"></i> Mes avis
        </a>
        <a href="{{ route('client.profile.edit') }}" class="nav-link">
            <i class="fas fa-user"></i> Profil
        </a>

    @endif

</nav>
    <div class="p-3 border-top border-secondary">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm w-100">
                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
        <span class="text-muted"><i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>