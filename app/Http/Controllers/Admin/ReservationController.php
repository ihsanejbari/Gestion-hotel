<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller {
    public function index() {
        $reservations = Reservation::with(['user', 'chambre', 'paiement'])->latest()->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation) {
        $reservation->load(['user', 'chambre', 'paiement']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation) {
        $request->validate(['statut' => 'required']);
        $reservation->update(['statut' => $request->statut]);
        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(Reservation $reservation) {
        $reservation->chambre->update(['statut' => 'disponible']);
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Réservation supprimée.');
    }
}