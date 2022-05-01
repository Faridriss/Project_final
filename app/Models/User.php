<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false; // enleve les meta informations

    protected $hidden = ['mdp']; //controller et vue n'auront pas acces direct

    protected $fillable = ['nom', 'prenom', 'login', 'mdp', 'type']; //mettre a jour au moment de la creation

    protected $attributes = ['type' => NULL]; // valeur par defaut de type

    //renvoie le mdp
    public function getAuthPassword()
    {
        return $this->mdp;
    }

    //test si user est admin
    public function isAdmin()
    {
        return $this->type == 'admin';
    }

    //test si user est gestionnaire
    public function isGestionnaire()
    {
        return $this->type == 'gestionnaire';
    }

    //test si user est enseignant
    public function isEnseignant()
    {
        return $this->type == 'enseignant';
    }

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'cours_users');
    }


}
