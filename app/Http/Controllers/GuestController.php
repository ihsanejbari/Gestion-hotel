<?php
namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Avis;

class GuestController extends Controller {
    public function home() {
        $chambres = Chambre::where('statut', 'disponible')->take(3)->get();
        $avis = Avis::with('user')->where('visible', true)->latest()->take(6)->get();
        return view('guest.home', compact('chambres', 'avis'));
    }

    public function chambres() {
        $chambres = Chambre::where('statut', 'disponible')->get();
        return view('guest.chambres', compact('chambres'));
    }

    public function avis() {
        $avis = Avis::with('user')->where('visible', true)->latest()->get();
        return view('guest.avis', compact('avis'));
    }
}