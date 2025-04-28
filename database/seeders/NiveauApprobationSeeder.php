<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\L_NiveauApprobation;

class NiveauApprobationSeeder extends Seeder
{
    public function run(): void
    {
        L_NiveauApprobation::firstOrCreate(
            ['libelle' => 'Niveau 1']
        );
    }
}
