<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\E_EtatNiveauApprobation;
use App\Models\L_NiveauApprobation;

class NiveauApprobationSeeder extends Seeder
{
    public function run()
    {
        // Récupère le premier niveau d’approbation
        $niveau = L_NiveauApprobation::first();

        if (!$niveau) {
            $this->command->error('Aucun niveau d’approbation trouvé. Insérez d’abord un niveau.');
            return;
        }

        // Définir les états à créer
        $etats = [
            ['libelle' => 'En attente', 'couleur' => '#999999'],
            ['libelle' => 'Acceptée', 'couleur' => 'vert'],
            ['libelle' => 'Rejetée', 'couleur' => 'rouge'],
        ];

        // Insérer les états
        foreach ($etats as $etat) {
            E_EtatNiveauApprobation::create([
                'libelle' => $etat['libelle'],
                'couleur' => $etat['couleur'],
                'idNiveauApprobation' => $niveau->id,
            ]);
        }

        $this->command->info('États d’approbation insérés avec succès !');
    }
}
