<?php

namespace App\Http\Controllers;
use App\Models\E_EtatNiveauApprobation;
use Illuminate\Http\Request;

class E_EtatNiveauApprobationController extends Controller
{
    public function index()
    {
        $etats=E_EtatNiveauApprobation::all();
        return response()->json([
            'status' => 'success',
            'data' => $etats
        ], 200);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'idNiveauApprobation' => 'required|uuid',
            'libelle' => 'required|string',
            'couleur' => 'required|string',
            'isValidation' => 'boolean',
            'passageNiveau' => 'boolean',
            'isDefault' => 'boolean',
        ]);

        $data['id'] = (string) \Illuminate\Support\Str::uuid();
        $etats=E_EtatNiveauApprobation::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $etats
        ], 200); 
    }
    public function update(Request $request, $id)
    {
        $etats = E_EtatNiveauApprobation::findOrFail($id);

        $data = $request->validate([
            'idNiveauApprobation' => 'required|uuid',
            'libelle' => 'string',
            'couleur' => 'string',
            'isValidation' => 'boolean',
            'passageNiveau' => 'boolean',
            'isDefault' => 'boolean',
        ]);


        $etats->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $etats
        ], 200);  
    }
    public function destroy($id)
    {
        $etats = E_EtatNiveauApprobation::findOrFail($id);
        $etats->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'EtatApprobation deleted successfully.'
        ], 200);   
    }
}
