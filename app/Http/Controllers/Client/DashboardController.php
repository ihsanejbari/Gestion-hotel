<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chambre;
use App\Models\Reservation;
use App\Models\Paiement;
use App\Models\Avis;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index()
{
    $reservations = Reservation::where('user_id', auth()->id())
        ->with('chambre')
        ->latest()
        ->take(3)
        ->get();

    $reservations_count = Reservation::where('user_id', auth()->id())->count();
    $chambres_count     = Chambre::where('statut', 'disponible')->count();
    $paiements_count    = Paiement::whereHas('reservation', fn($q) =>
        $q->where('user_id', auth()->id())
    )->count();

    return view('client.dashboard', compact(
        'reservations',
        'reservations_count',
        'chambres_count',
        'paiements_count'
    ));
}

    public function chambres() {
        $chambres = Chambre::where('statut', 'disponible')->get();
        return view('client.chambres', compact('chambres'));
    }

    public function reservations() {
        $reservations = Reservation::where('user_id', auth()->id())->with('chambre', 'paiement')->latest()->get();
        $chambres = Chambre::where('statut', 'disponible')->get();
        return view('client.reservations', compact('reservations', 'chambres'));
    }

    public function storeReservation(Request $request) {
        $request->validate([
            'chambre_id' => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'date_depart' => 'required|date|after:date_arrivee',
        ]);

        $chambre = Chambre::findOrFail($request->chambre_id);
        $jours = \Carbon\Carbon::parse($request->date_arrivee)->diffInDays($request->date_depart);

        Reservation::create([
            'user_id' => auth()->id(),
            'chambre_id' => $chambre->id,
            'date_arrivee' => $request->date_arrivee,
            'date_depart' => $request->date_depart,
            'prix_total' => $chambre->prix * $jours,
            'statut' => 'en_attente',
            'notes' => $request->notes,
        ]);

        $chambre->update(['statut' => 'occupee']);
        return redirect()->route('client.reservations')->with('success', 'Réservation créée !');
    }

    public function paiements() {
        $reservations_impayees = Reservation::where('user_id', auth()->id())
            ->where('statut', 'confirmee')
            ->whereDoesntHave('paiement')
            ->with('chambre')->get();
        $paiements = Paiement::whereHas('reservation', fn($q) => $q->where('user_id', auth()->id()))
            ->with('reservation.chambre')->latest()->get();
        return view('client.paiements', compact('reservations_impayees', 'paiements'));
    }

    public function storePaiement(Request $request) {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'methode' => 'required|in:especes,carte,virement',
        ]);

        $reservation = Reservation::where('user_id', auth()->id())->findOrFail($request->reservation_id);

        Paiement::create([
            'reservation_id' => $reservation->id,
            'montant' => $reservation->prix_total,
            'methode' => $request->methode,
            'statut' => 'paye',
            'date_paiement' => now(),
        ]);

        $reservation->update(['statut' => 'terminee']);
        return redirect()->route('client.paiements')->with('success', 'Paiement effectué !');
    }

    public function avis() {
        $mes_avis = Avis::where('user_id', auth()->id())->latest()->get();
        return view('client.avis', compact('mes_avis'));
    }

    public function storeAvis(Request $request) {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|min:10|max:500',
        ]);

        Avis::create([
            'user_id' => auth()->id(),
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('client.avis')->with('success', 'Avis publié !');
    }
}