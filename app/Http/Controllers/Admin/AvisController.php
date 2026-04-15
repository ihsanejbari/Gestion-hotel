<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;

class AvisController extends Controller {
    public function index() {
        $avis = Avis::with('user')->latest()->paginate(10);
        return view('admin.avis.index', compact('avis'));
    }

    public function destroy(Avis $avi) {
        $avi->delete();
        return back()->with('success', 'Avis supprimé.');
    }
}