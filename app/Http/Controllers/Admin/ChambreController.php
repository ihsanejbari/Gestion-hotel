<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller {
    public function index() {
        $chambres = Chambre::latest()->paginate(10);
        return view('admin.chambres.index', compact('chambres'));
    }

    public function create() {
        return view('admin.chambres.create');
    }

    public function store(Request $request) {
        $request->validate([
            'numero' => 'required|unique:chambres',
            'type' => 'required',
            'prix' => 'required|numeric|min:0',
            'capacite' => 'required|integer|min:1',
            'statut' => 'required',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chambres', 'public');
        }

        Chambre::create($data);
        return redirect()->route('admin.chambres.index')->with('success', 'Chambre ajoutée.');
    }

    public function edit(Chambre $chambre) {
        return view('admin.chambres.edit', compact('chambre'));
    }

    public function update(Request $request, Chambre $chambre) {
        $request->validate([
            'numero' => 'required|unique:chambres,numero,' . $chambre->id,
            'type' => 'required',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chambres', 'public');
        }

        $chambre->update($data);
        return redirect()->route('admin.chambres.index')->with('success', 'Chambre modifiée.');
    }

    public function destroy(Chambre $chambre) {
        $chambre->delete();
        return redirect()->route('admin.chambres.index')->with('success', 'Chambre supprimée.');
    }
}