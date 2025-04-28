<?php

namespace App\Http\Controllers;
use App\Models\P_Approbation;
use Illuminate\Http\Request;

class P_ApprobationController extends Controller
{
    public function index()
    {
        $approbations=P_Approbation::all();
        return response()->json([
            'status' => 'success',
            'data' => $approbations
        ], 200); 
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'libelle' => 'required|string',
            'isDefault' => 'boolean',
        ]);

        $data['id'] = (string) \Illuminate\Support\Str::uuid();

        $approbation= P_Approbation::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $approbation
        ], 200); 
    }

    public function update(Request $request, $id)
    {
        $approbation = P_Approbation::findOrFail($id);

        $data = $request->validate([
            'libelle' => 'string',
            'isDefault' => 'boolean',
        ]);

        $approbation->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $approbation
        ], 200);   
    }

    public function destroy($id)
    {
        $approbation = P_Approbation::findOrFail($id);
        $approbation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Approbation deleted successfully.'
        ], 200);   
     }
    
}

