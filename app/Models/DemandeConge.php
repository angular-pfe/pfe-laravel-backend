<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeConge extends Model
{
    protected $fillable = [
       'idDemandeur',  
        'dateDebut',
        'dateFin',
        'nbrJours',
        'note',
        'idNiveauApprobation',
        'idEtatNiveauApprobation',
             
    ];

    // Relation avec l'utilisateur demandeur
    public function demandeur()
    {
        return $this->belongsTo(PUtilisateur::class, 'idDemandeur');
    }

    // Relation avec l'état d'approbation
    public function etat()
    {
        return $this->belongsTo(EtatNiveauApprobation::class, 'idEtatNiveauApprobation');
    }
    public function approbation()
{
    return $this->belongsTo(Approbation::class, 'idApprobation');
}

public function niveauApprobation()
{
    return $this->belongsTo(NiveauApprobation::class, 'idNiveauApprobation');
}

public function approbateur()
{
    return $this->belongsTo(PUtilisateur::class, 'idApprobateur');
}
}