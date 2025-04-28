<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends seeder{
public function run(): void
{
    $this->call([
        EtatNiveauApprobationSeeder::class,
        NiveauApprobationSeeder::class,
    ]);
}
}
