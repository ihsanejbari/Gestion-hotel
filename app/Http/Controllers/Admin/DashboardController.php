<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chambre;
use App\Models\Reservation;
use App\Models\Paiement;
use App\Models\User;
use App\Models\Avis;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'chambres' => Chambre::count(),
            'reservations' => Reservation::count(),
            'clients' => User::where('role', 'client')->count(),
            'revenus' => Paiement::where('statut', 'paye')->sum('montant'),
            'en_attente' => Reservation::where('statut', 'en_attente')->count(),
        ];
        $reservations_recentes = Reservation::with(['user', 'chambre'])->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'reservations_recentes'));
    }
}