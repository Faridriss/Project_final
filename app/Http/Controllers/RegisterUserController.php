<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

class RegisterUserController extends Controller
{
    public function showForm(){ //renvoie sur le formulaire d'enregistrement
        return view('auth.register');
    }

    public function store(Request $request){ //fonction pour le traitement du formulaire d'enregistrement
        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'login' => 'required|string|max:30|unique:users',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        //$user->type = NULL;
        $user->save();
   
        session()->flash('etat','Utilisateur ajouté');
 
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function modForm() // formulaire sur la modification du compte
    {
        $user = Auth::user();
        return view('auth.modify', ['user' => $user]);
    }

    public function modify(Request $request) // fonction pour le traitement du formulaire de modification
    {
        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'mdp' => 'required|string|confirmed' //|min:8',
        ]);

        $user = Auth::user(); // on récupere les infos de l'user déjà connecté
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        session()->flash('etat', 'données de l`utilisateur modifié');
        //Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}