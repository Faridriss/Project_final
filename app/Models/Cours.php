<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;


    public $timestamps = false;

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'cours_etudiants');
    }
    
    public function seance(){
        return $this->hasMany(Seance::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'cours_users');
    }

}
