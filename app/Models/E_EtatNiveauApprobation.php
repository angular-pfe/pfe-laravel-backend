<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class E_EtatNiveauApprobation extends Model
{
    protected $table = 'E_EtatNiveauApprobation';
    protected $fillable=['idNiveauApprobation','libelle','couleur','isValidation','passageNiveau','isDefault'];
    public $incrementing=true;
    public $keyType='int';

    public function niveauApprobation()
    {
        return $this->belongsTo(L_NiveauApprobation::class, 'idNiveauApprobation');
    }
}
