<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;
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
    public $incrementing = true;
    protected $keyType = 'int';

    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }
    
    public function getAuthPassword() {
        return $this->psw;  // Si votre champ de mot de passe est "psw"
    }
    public function setPswAttribute($value)
   
{

    // N'applique le hash que si ce n'est pas déjà crypté
    if (Hash::needsRehash($value)) {
        $this->attributes['psw'] = Hash::make($value);
    } else {
        $this->attributes['psw'] = $value;
    }
}

    }
