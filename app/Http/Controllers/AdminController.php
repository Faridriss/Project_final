<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Cours;
use App\Models\Seance;

class AdminController extends Controller
{
    //route pour retourner vers le menu principal
    public function home()
    {
        return view('home');
    }

    public function showForm() //renvoie sur le formulaire d'enregistrement
    { 
        return view('auth.register');
    }

    public function store(Request $request) //fonction pour le traitement du formulaire d'enregistrement
    { 
        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'login' => 'required|string|max:30|unique:users',
            'mdp' => 'required|string|confirmed' //|min:8',
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        //$user->type = NULL;
        $user->save();

        session()->flash('etat', 'Utilisateur crée');

        return view("admin.home");
    }


    /* 
    ==========================================
    ======Gestion de l'administrateur=========
    ==========================================     
*/


    public function liste_newUser() // liste de tous les utilisateurs qui viennent de se créer un compte
    {
        $noms = User::Where('type','=', NULL)->paginate(8);
        return view("admin.liste_newUser", ['nom' => $noms]);
    }

    public function liste() // liste de tous les utilisateurs
    {
        $noms = User::paginate(8);
        return view("admin.liste", ['nom' => $noms]);
    }

    public function suppForm($id) //formulaire pour la suppression d'un user
    {
        $nom = User::findOrFail($id);
        return view('admin.supp_form', ['nom' => $nom]);
    }


    public function supp(Request $request, $id) //fonction qui gere la suppresion
    {
        $nom = User::findOrFail($id);

        if ($request->has('Oui')) {

            $nom->cours()->detach();

            $nom->delete();
            //si la supp est faite
            $request->session()->flash('etat', 'Suppression effectuee');
        } else {
            $request->session()->flash('etat', 'Suppression annulee');
        }
        return redirect()->route('admin.liste'); // on retourne dans la liste des users
    }

    //modification des données d'un user ($id)

    public function modForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.mod', ['user' => $user]);
    }

    public function mod(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'mdp' => 'required|string|confirmed' //|min:8',
        ]);

        $user = User::findOrFail($id); // on récupere les infos de l'user que l'on a séléctionné
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mdp = Hash::make($request->mdp);
        $user->type = $request->type;

        if ($request->has('Enseignant')) { //regarde si l'admin a appuyé sur le boutton enseignant
            $user->type = 'enseignant';
        }
        if ($request->has('Gestionnaire')) { //regarde si l'admin a appuyé sur le boutton gestionnaire
            $user->type = 'gestionnaire';
        }
        if ($request->has('Administrateur')) { //regarde si l'admin a appuyé sur le boutton Utilisateur
            $user->type = 'admin';
        }
        $user->save();
        session()->flash('etat', 'mot de passe du pizzaiolo modifié');
        return redirect()->route('admin.liste');
    }

/* 
    ==========================================
    ======= Recherche de l'utilisateur =======
    ==========================================     
*/
        
    
        /*      fonction qui gere la recherche par login        */
    public function user_par_login(Request $request)
    {
        $d = $request->get('rech');
        $user = User::where('login','like',"%$d%")->orWhere('nom','like',"%$d%")->orWhere('prenom', 'like', "%$d%")->paginate(5);
        return view('admin.liste_rech', ['nom' => $user]);
    }

    /*      fonction qui gere la recherche par nom        */
    public function user_par_nom(Request $request)
    {
        $d = $request->get('rech');
        $user = User::where('nom', 'like', "%$d%")->paginate(5);

        return view('admin.liste_rech', ['nom' => $user]);
    }

    /*      fonction qui gere la recherche par prenom        */
    public function user_par_prenom(Request $request)
    {
        $d = $request->get('rech');
        $user = User::where('prenom', 'like', "%$d%")->paginate(5);

        return view('admin.liste_rech', ['nom' => $user]);
    }

/* 
    ==========================================
    ======= Filtrage des utilisateurs ========
    ==========================================     
*/

    /*      fonction qui gere le filtrage des enseignants        */

    public function liste_enseignant()
    {

        $user = User::paginate(8);
        return view('admin.liste_enseignant', ['nom' => $user]);
    }

    /*      fonction qui gere le filtrage des gestionnaires        */

    public function liste_gestionnaire()
    {

        $user = User::paginate(8);
        return view('admin.liste_gestionnaire', ['nom' => $user]);
    }

/* 
    ==========================================
    =========== gestion des cours ============
    ==========================================     
*/

public function cours()
    {

        $cours = Cours::paginate(8);
        return view('admin.cours', ['nom' => $cours]);
    }

    //======= Ajout d'un cours ============

    public function ajout_coursForm() //formulaire pour l'ajout d'un étudiant
    {
        return view('admin.ajout_coursform');
    }

    public function ajout_cours(Request $request)
    {
        /*Vérifions que les données ecrites sont bonnes*/
        $validated = $request->validate([
            'intitule' => 'required|string|max:30',
        ]);
        if ($validated == false) {
            $request->session()->flash('etat', 'Données erronées !');
        } else {
            $cours = new Cours();
            $cours->intitule = $validated['intitule'];
            $cours->save();
            $request->session()->flash('etat', 'Ajout effectué !');

            return redirect()->route('admin.cours'); // retourne page principale gestionnaire
        }
    }

    //======= Suppression d'un cours ============

    public function supp_coursForm($id) //formulaire de suppression
    {
        $nom = Cours::findOrFail($id);
        return view('admin.supp_coursform', ['nom' => $nom]);
    }

    public function supp_cours(Request $request, $id) //fonction qui gere la suppresion d'un cours
    {

        if ($request->has('Oui')) {

            $cours = Cours::find($id);
            $cours->etudiants()->detach();
            $cours->users()->detach();
            $seances = $cours->seance;
            if (is_array($seances) || is_object($seances)) {
            foreach ($seances as $s) {
                $seance = Seance::findOrFail($s->id);
                $presents = $seance->etudiants;
                foreach ($presents as $present) {
                    $etu = Etudiant::findOrFail($present->id);
                    $seance->etudiants()->detach($etu->id);
                }
                $seance->cours()->dissociate();
            }
        }
            $cours->seance()->delete();
            $cours->delete();
            //si la supp est faite
            $request->session()->flash('etat', 'Suppression effectuee');
        } else {
            
            $request->session()->flash('etat', 'Suppression annulee');
        }
        return redirect()->route('admin.cours'); // on retourne dans la liste des cours
    }

    /* ======== modification d'un cours ======== */

    public function mod_coursForm($id)
    {
        $cours = Cours::findOrFail($id);
        return view('admin.mod_cours', ['cours' => $cours]);
    }

    public function mod_cours(Request $request, $id)
    {

        $request->validate([
            'intitule' => 'required|string|max:30',
        ]);

        $cours = Cours::findOrFail($id); // on récupere les infos de l'user que l'on a séléctionné
        $cours->intitule = $request->intitule;
        $cours->save();

        session()->flash('etat', 'données du cours modifiées');

        return redirect()->route('admin.cours');
    }

    /*      fonction qui gere la recherche par intitulé d'un cours        */
    public function rech_par_intitule(Request $request)
    {
        $d = $request->get('rech');
        $cours = Cours::where('intitule', 'like', "%$d%")->paginate(5);

        return view('admin.cours', ['nom' => $cours]);
    }


}
