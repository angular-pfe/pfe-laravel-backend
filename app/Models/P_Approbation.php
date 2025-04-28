<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_Approbation extends Model
{
    protected $table = 'P_Approbation';
    protected $fillable = ['libelle','isDefault'];
    public $incrementing=true;
    public $keyType='int';


    public function niveauxApprobation()
    {
        return $this->hasMany(L_NiveauApprobation::class, 'idApprobation');
    }
}
