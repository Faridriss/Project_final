<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;


    public $timestamps = false;

    public function cours()
    {
        return $this->belongsToMany(Cours::class,'cours_etudiants');
    }

    public function seance()
    {
        return $this->belongsToMany(Seance::class, 'presences');
    }


}
