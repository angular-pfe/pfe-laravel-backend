<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class L_NiveauApprobation extends Model
{
    protected $table = 'L_NiveauApprobation';
    protected $fillable = ['id','idApprobation','libelle','couleur','isInitialNode','isFinalNode'];
    public $incrementing=false;
    public $keyType='string';

    public function approbation()
    {
        return $this->belongsTo(P_Approbation::class, 'idApprobation');
    }

    public function etatsNiveauApprobation()
    {
        return $this->hasMany(E_EtatNiveauApprobation::class, 'idNiveauApprobation');
    }

}
