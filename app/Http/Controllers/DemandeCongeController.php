<?php
namespace App\Http\Controllers;
use App\Models\DemandeConge;
use App\Models\E_EtatNiveauApprobation;
use App\Models\L_NiveauApprobation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeCongeController extends Controller {

    // Ligne 9
public function store(Request $request)
{
    $request->validate([
        'dateDebut' => 'required|date|after:now',
        'dateFin' => 'required|date|after:dateDebut',
        'note' => 'required|string|max:500',
    ]);

    if (Carbon::parse($request->dateDebut)->gt(Carbon::parse($request->dateFin))) {
        return response()->json([
            'status' => 'error',
            'message' => 'La date de fin doit être postérieure à la date de début'
        ], 422);
    }

    // 🔽 Ajout : Sécuriser les valeurs nulles
    $etat = E_EtatNiveauApprobation::firstWhere('libelle', 'En attente');
    $niveau = L_NiveauApprobation::first();

    if (!$etat || !$niveau) {
        return response()->json([
            'status' => 'error',
            'message' => 'Impossible de récupérer les niveaux ou états d\'approbation.'
        ], 500);
    }
    $demande = DemandeConge::create([
        'idDemandeur' => auth()->id(), // Ligne 27
        'dateDebut' => $request->dateDebut,
        'dateFin' => $request->dateFin,
        'nbrJours' => Carbon::parse($request->dateDebut)->diffInDays($request->dateFin) + 1,
        'note' => $request->note,
        'idEtatNiveauApprobation' => $etat->id, // 🔄 remplacé pour éviter l’erreur
        'idNiveauApprobation' => $niveau->id      // 🔄 remplacé aussi
    ]);

    return response()->json($demande, 201); // Ligne 35
}


public function index()
{

    try {
        $demandes = DemandeConge::query()
        ->with([
            'demandeur:id,mail,nomPrenom',
          //  'etatNiveauApprobation:id,libelle,couleur'
        ])
        ->latest('dateSoumission')
        ->paginate(request('per_page', 10));
        return response()->json([
            'status' => 'success',
            'data' => $demandes->through(fn($item) => [
                'id' => $item->id,
                'dates' => Carbon::parse($item->dateDebut)->format('d/m/Y') . ' - ' . Carbon::parse($item->dateFin)->format('d/m/Y'),
                // 'statut' => $item->etatNiveauApprobation->libelle,
                'demandeur' => $item->demandeur->nomPrenom
            ])
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur de base de données'
        ], 500);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur inattendue'
        ], 500);
    }
}

    public function update(Request $request, string $id)
    {
        $demande = DemandeConge::findOrFail($id);

        $validated = $request->validate([
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'note' => 'required|string|max:500',
        ]);

        // Recalcul si les dates changent
        $nbrJours = Carbon::parse($request->dateDebut)
            ->diffInDays(Carbon::parse($request->dateFin)) + 1;

        $demande->update([
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'nbrJours' => $nbrJours,
            'note' => $request->note,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $demande
        ], 200);
    }

    public function destroy(string $id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Demande supprimée !'
        ], 200);
    }
}