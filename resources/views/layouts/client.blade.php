<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>✦</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Espace') — Veloria House</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #c9a84c; --sidebar-bg: #1a1a2e; }
        body { display: flex; min-height: 100vh; background: #f4f6f9; margin: 0; }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }
        .sidebar .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            text-align: center;
            padding: 1.8rem 1rem 1.4rem;
            border-bottom: 1px solid #2d2d4e;
            text-shadow: 0 0 18px rgba(201,168,76,.4);
        }
        .sidebar .user-area {
            padding: 1rem 1.2rem .9rem;
            border-bottom: 1px solid #2d2d4e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .user-avatar {
            width: 38px; height: 38px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #1a1a2e; font-weight: 900; font-size: .95rem; flex-shrink: 0;
        }
        .sidebar .user-name { color: #eee; font-size: .88rem; font-weight: 600; line-height: 1.2; }
        .sidebar .user-role {
            color: var(--gold);
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .sidebar .nav-section-title {
            color: #555;
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            padding: 1rem 1.4rem .3rem;
        }
        .sidebar .nav-link {
            color: #bbb;
            padding: .68rem 1.3rem;
            border-radius: 8px;
            margin: 2px 10px;
            font-size: .92rem;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link i { width: 18px; text-align: center; font-size: .9rem; }
        .sidebar .nav-link:hover {
            background: var(--gold);
            color: #fff;
            transform: scale(1.04);
            box-shadow: 0 4px 16px rgba(201,168,76,.4);
        }
        .sidebar .nav-link.active {
            background: var(--gold);
            color: #fff;
            box-shadow: 0 4px 16px rgba(201,168,76,.3);
        }

        /* ── Main content ── */
        .main {
            flex: 1;
            padding: 2rem;
            overflow-x: hidden;
            margin-left: 260px;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-radius: 12px;
            padding: .85rem 1.5rem;
            margin-bottom: 1.8rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin: 0;
            color: #1a1a2e;
        }
        .topbar .breadcrumb-pill {
            background: #f4f6f9;
            border-radius: 50px;
            padding: .35rem 1rem;
            font-size: .82rem;
            color: #888;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 3px 20px rgba(0,0,0,.07);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 14px;
            padding: 1.5rem;
            color: #fff;
            box-shadow: 0 6px 22px rgba(0,0,0,.15);
            transition: transform .2s ease, box-shadow .2s ease;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }
        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 36px rgba(0,0,0,.25);
            color: #fff;
            text-decoration: none;
        }
        .stat-card p { margin: 0 0 4px; opacity: .8; font-size: .78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
        .stat-card h2 { margin: 0; font-weight: 800; font-size: 2rem; }
        .stat-card i { opacity: .75; }

        /* ── Table ── */
        .table-hover tbody tr { transition: transform .15s ease, background .15s ease; }
        .table-hover tbody tr:hover { transform: translateX(4px); background-color: #fffbf0 !important; }

        /* ── Buttons ── */
        .btn-gold { background-color: var(--gold); color: #fff; border: none; transition: transform .15s, box-shadow .15s; }
        .btn-gold:hover { background-color: #a8893d; color: #fff; transform: scale(1.05); }
    </style>
</head>
<body>

<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
    <div class="brand">✦ Veloria House</div>

    <div class="user-area">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">Client</div>
        </div>
    </div>

    <div class="nav-section-title">Navigation</div>

    <nav class="nav flex-column flex-grow-1">
        <a href="{{ route('client.dashboard') }}"    class="nav-link @yield('nav_dashboard')">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('client.chambres') }}"     class="nav-link @yield('nav_chambres')">
            <i class="fas fa-door-open"></i> Chambres
        </a>
        <a href="{{ route('client.reservations') }}" class="nav-link @yield('nav_reservations')">
            <i class="fas fa-calendar-check"></i> Réservations
        </a>
        <a href="{{ route('client.paiements') }}"    class="nav-link @yield('nav_paiements')">
            <i class="fas fa-credit-card"></i> Paiements
        </a>
        <a href="{{ route('client.avis') }}"         class="nav-link @yield('nav_avis')">
            <i class="fas fa-star"></i> Mes avis
        </a>
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

<!-- ══ MAIN ══ -->
<div class="main">
    <div class="topbar">
        <h5>@yield('page_title', 'Mon Espace')</h5>
        <div class="breadcrumb-pill">
            <i class="fas fa-circle text-success" style="font-size:.45rem"></i>
            Connecté en tant que client
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>