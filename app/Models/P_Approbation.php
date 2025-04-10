<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_Approbation extends Model
{
    protected $table = 'P_Approbation';
    protected $fillable = ['id','libelle','isDefault'];
    public $incrementing=false;
    public $keyType='string';


    public function niveauxApprobation()
    {
        return $this->hasMany(L_NiveauApprobation::class, 'idApprobation');
    }
}
