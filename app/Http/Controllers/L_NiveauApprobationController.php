<?php

namespace App\Http\Controllers;
use App\Models\L_NiveauApprobation;

use Illuminate\Http\Request;

class L_NiveauApprobationController extends Controller
{
    public function index()
    {
        $niveaux=L_NiveauApprobation::all();
        return response()->json([
            'status' => 'success',
            'data' => $niveaux
        ], 200);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'idApprobation' => 'required|uuid',
            'libelle' => 'required|string',
            'couleur' => 'required|string',
            'isInitialNode' => 'boolean',
            'isFinalNode' => 'boolean',
        ]);

        $data['id'] = (string) \Illuminate\Support\Str::uuid();

        $niveaux=L_NiveauApprobation::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $niveaux
        ], 200); 
    }

    public function update(Request $request, $id)
    {
        $niveaux= L_NiveauApprobation::findOrFail($id);

        $data = $request->validate([
            'idApprobation' => 'required|uuid',
            'libelle' => 'string',
            'couleur' => 'string',
            'isInitialNode' => 'boolean',
            'isFinalNode' => 'boolean',
        ]);



        $niveaux->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $niveaux
        ], 200);   
    }
    
    public function destroy($id)
    {
        $niveaux = L_NiveauApprobation::findOrFail($id);
        $niveaux->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'NiveauApprobation deleted successfully.'
        ], 200);   
     }

    }