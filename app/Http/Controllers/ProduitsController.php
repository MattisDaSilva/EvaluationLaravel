<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitsController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', ['produits' => $produits]);
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:produits',
            'reference' => 'required|unique:produits',
            'prix' => 'required|numeric',
            'marque_id' => 'required|exists:marques,id',
        ]);

        Produit::create([
            'nom' => $request->input('nom'),
            'reference' => $request->input('reference'),
            'prix' => $request->input('prix'),
            'marque_id' => $request->input('marque_id'),
        ]);

        return redirect('/produits')->with('success', 'Le produit a été créé avec succès.');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', ['produit' => $produit]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'reference' => 'required',
            'prix' => 'required|numeric',
            'marque_id' => 'required|exists:marques,id',
        ]);

        $produit = Produit::findOrFail($id);

        $produit->update([
            'nom' => $request->input('nom'),
            'reference' => $request->input('reference'),
            'prix' => $request->input('prix'),
            'marque_id' => $request->input('marque_id'),
        ]);

        return redirect('/produits')->with('success', 'Le produit a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect('/produits')->with('success', 'Le produit a été supprimé avec succès.');
    }
}
