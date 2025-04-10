<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class PUtilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'p_utilisateur';

    protected $fillable = [
        'login',
        'username',
        'mail',
        'psw',
        'nomPrenom',
        'tel',
        'soldeCongeInitial',
        'role'
    ];

    protected $hidden = ['psw'];

    public function setPswAttribute($value)
    {
        $this->attributes['psw'] = bcrypt($value);
    }
}