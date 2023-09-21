<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque; 

class MarquesController extends Controller
{
    public function index()
    {
        $marques = Marque::all(); 
        return view('marques.index', ['marques' => $marques]);
    }

    public function create()
    {
        return view('marques.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:marques',
            'pays' => 'required',
        ]);

        // Créez une nouvelle marque
        Marque::create([
            'nom' => $request->input('nom'),
            'pays' => $request->input('pays'),
        ]);

        return redirect('/marques')->with('success', 'La marque a été créée avec succès.');
    }

    public function edit($id)
    {
        $marque = Marque::findOrFail($id);
        return view('marques.edit', ['marque' => $marque]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'pays' => 'required',
        ]);

        $marque = Marque::findOrFail($id);

        $marque->update([
            'nom' => $request->input('nom'),
            'pays' => $request->input('pays'),
        ]);

        return redirect('/marques')->with('success', 'La marque a été mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $marque = Marque::findOrFail($id);
        $marque->delete();

        return redirect('/marques')->with('success', 'La marque a été supprimée avec succès.');
    }
}
