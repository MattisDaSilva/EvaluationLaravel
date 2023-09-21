<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;

class VentesController extends Controller
{
    public function index()
    {
        $ventes = Vente::all(); 
        return view('ventes.index', ['ventes' => $ventes]);
    }

    public function create()
    {
        return view('ventes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'numero_unique' => 'required|unique:ventes', 
            'date' => 'required|date',
            'heure' => 'required|time',
            'quantite' => 'required|numeric',
            'produit_id' => 'required|exists:produits,id', 
        ]);

        Vente::create([
            'numero_unique' => $request->input('numero_unique'),
            'date' => $request->input('date'),
            'heure' => $request->input('heure'),
            'quantite' => $request->input('quantite'),
            'produit_id' => $request->input('produit_id'),
        ]);

        return redirect('/ventes')->with('success', 'La vente a été créée avec succès.');
    }

    public function edit($id)
    {
        $vente = Vente::findOrFail($id); 
        return view('ventes.edit', ['vente' => $vente]);
    }

    public function update(Request $request, $id)
    {
        return redirect('/ventes')->with('success', 'La vente a été mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $vente = Vente::findOrFail($id); 
        $vente->delete();

        return redirect('/ventes')->with('success', 'La vente a été supprimée avec succès.');
    }
}
