<?php

namespace App\Http\Controllers;

use App\Models\PUtilisateur;

use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    
    public function index()
    {
        return PUtilisateur::all();
    }

    
   
    public function store(Request $request)
    {       
        $validated = $request->validate([
        'login' => 'required',
        'username' =>'required',
        'mail' =>'required',
        'psw' => 'required',
        'nomPrenom' => 'required',
        'tel' => 'nullable',
        'soldeCongeInitial' => 'required|integer',
        'role' => 'required|in:administrateur,employé,approbateur'
    ]);
    $utilisateur = PUtilisateur::create($validated);
    return response()->json([
        'status' => 'success',
        'data' => $utilisateur
    ], 201); 
    }

   
   
    public function update(Request $request, string $id)
    {
        $utilisateur = PUtilisateur::findOrFail($id);

        $validated = $request->validate([
            'login' => 'sometimes',
            'username' => 'sometimes',
            'mail' => 'sometimes',
            'psw' => 'sometimes',
            'nomPrenom' => 'sometimes',
            'tel' => 'nullable',
            'soldeCongeInitial' => 'sometimes|integer',
            'role' => 'sometimes|in:administrateur,employé,approbateur'
        ]);

        $utilisateur->update($validated);
        return response()->json([
            'status' => 'success',
            'data' => $utilisateur
        ], 200);      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateur = PUtilisateur::findOrFail($id);
        $utilisateur->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully.'
        ], 200);  
    }
}
