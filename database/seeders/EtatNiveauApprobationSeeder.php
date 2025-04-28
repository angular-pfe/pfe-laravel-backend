<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Ajouter cette ligne

namespace Database\Seeders; // Namespace correct

use Illuminate\Database\Seeder;
use App\Models\E_EtatNiveauApprobation; // Import du modèle

class EtatNiveauApprobationSeeder extends Seeder 
{
    public function run()
    {
        // Liste des états à insérer
        $etats = [
            ['libelle' => 'En attente', 'couleur' => '#FFA500'],
            ['libelle' => 'Validé', 'couleur' => '#008000'],
            ['libelle' => 'Rejeté', 'couleur' => '#FF0000'],
        ];

        // Insertion garantie (crée ou met à jour)
        foreach ($etats as $etat) {
            E_EtatNiveauApprobation::updateOrCreate(
                ['libelle' => $etat['libelle']], // Critère de recherche
                $etat // Données à insérer
            );
        }
    }
}