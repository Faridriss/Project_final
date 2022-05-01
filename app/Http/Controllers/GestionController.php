<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Seance;
use App\Models\User;
use App\Models\Cours;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class GestionController extends Controller
{
    //route pour retourner vers le menu principal
    public function home()
    {
        return view('home');
    }
    public function gestion()
    {
        return view('gestionnaire.gestion');
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

        return view('gestionnaire.home');
    }
    /* 
    ==========================================
    ========= Gestion du Gestionnaire ========
    ==========================================     
    */

    public function cours()
    {

        $cours = Cours::paginate(7);
        return view('gestionnaire.cours', ['nom' => $cours]);
    }

    /*      fonction qui gere la recherche par intitulé d'un cours        */
    public function rech_par_intitule(Request $request)
    {
        $d = $request->get('rech');
        $cours = Cours::where('intitule', 'like', "%$d%")->paginate(5);

        return view('gestionnaire.cours', ['nom' => $cours]);
    }

    public function enseignant()
    {

        $enseignant = User::Where('type','=','enseignant')->paginate(7);
        return view('gestionnaire.enseignant', ['nom' => $enseignant]);
    }


    //======= Ajout d'un étudiant ============

    public function etudiant()
    {
        $user = Etudiant::paginate(5);
        return view('gestionnaire.etudiant', ['nom' => $user]);
    }

    

    public function ajoutForm() //formulaire pour l'ajout d'un étudiant
    {
        return view('gestionnaire.ajout_form');
    }

    public function ajout(Request $request)
    {
        /*Vérifions que les données ecrites sont bonnes*/
        $validated = $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'noet' => 'required|string|max:10',
        ]);
        if ($validated == false) {
            $request->session()->flash('etat', 'Données erronées !');
        } else { /*si elles sont bonnes le personnage va etre créer, on créer un nouveau Nom() et ont lui rentre les données que l'utilisateur a choisit*/
            $etudiant = new Etudiant();
            $etudiant->nom = $validated['nom'];
            $etudiant->prenom = $validated['prenom'];
            $etudiant->noet = $validated['noet'];
            $etudiant->save();
            $request->session()->flash('etat', 'Ajout effectué !');
            
            return redirect()->route('gestionnaire.etudiant'); // retourne page principale gestionnaire
        }
    }

    /* ======= Suppression d'un étudiant ======= */

    public function suppForm($id) //formulaire de suppression
    {
        $nom = Etudiant::findOrFail($id);
        return view('gestionnaire.supp_form', ['nom' => $nom]);
    }


    public function supp_etudiant(Request $request, $id) //fonction qui gere la suppresion d'un étudiant
    {
        $nom = Etudiant::findOrFail($id);


        if ($request->has('Oui')) {

            $nom->cours()->detach();
            $nom->seance()->detach();



            $nom->delete();
            //si la supp est faite
            $request->session()->flash('etat', 'Suppression effectuee');
        } else {
            $request->session()->flash('etat', 'Suppression annulee');
        }
        return redirect()->route('gestionnaire.etudiant'); // on retourne dans la liste des etudiants
    }

    /*======= Modification d'un étudiant =========*/
    public function modForm($id){
        $e = Etudiant::findOrFail($id);
        return view('gestionnaire.mod_etudiant', ['nom' => $e]);
    }

    public function mod(Request $request, $id)
    {
        $e = Etudiant::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'noet' => 'required|string|max:10',
            
        ]);

        $e = Etudiant::findOrFail($id); // on récupere les infos de l'user que l'on a séléctionné
        $e->nom = $request->nom;
        $e->prenom = $request->prenom;
        $e->noet = $request->noet;
        $e->save();
        session()->flash('etat', 'Etudiant modifié');
        return redirect()->route('gestionnaire.etudiant');
    }


    /*      fonction qui gere la recherche de l'etudiant par nom        */
    public function rech_etudiant(Request $request)
    {
        $d = $request->get('rech');
        $e = Etudiant::where('nom', 'like', "%$d%")->orWhere('prenom', 'like', "%$d%")->orWhere('noet', 'like', "%$d%")->paginate(8);
        return view('gestionnaire.etudiant', ['nom' => $e]);
    }

    //======= Ajout d'une séance ============


    public function seance()
    {
        $seances = Seance::paginate(7);
        $cours = [];
        foreach ($seances as $d) {
            $cours[$d->id] = Cours::findOrFail($d->cours_id);
        }
        return view('gestionnaire.seance', ['seance' => $seances, 'cours' => $cours]);
    }

    public function ajout_seanceform()
    {
        $cours = Cours::get();
        return view('gestionnaire.ajout_seanceform', ['nom' => $cours]);
    }

    public function ajout_seance(Request $request)
    {
        /*Vérifions que les données ecrites sont bonnes*/
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'id' => 'required',
        ]);
        if ($validated == false) {
            $request->session()->flash('etat', 'Données erronées !');
        } 
        else {
            $seance = new Seance();
            $seance->date_debut = $validated['date_debut'];
            $seance->date_fin = $validated['date_fin'];
            $seance->cours_id = $validated['id'];
            $seance->save();
            $request->session()->flash('etat', 'Seance ajouté !');
            $liste = Seance::paginate(5);
            
            return redirect()->route('gestionnaire.seance'); // retourne page principale gestionnaire
        }

    }

    //======= Suppression d'une seance ============

    public function supp_seanceForm($id)//formulaire de suppression
    { 
    
        $seance = Seance::findOrFail($id);
        return view('gestionnaire.supp_seanceform', ['nom' => $seance]);
    }

    public function supp_seance(Request $request, $id) //fonction qui gere la suppresion d'une séance
    {
        $seance = Seance::findOrFail($id);
        
        if ($request->has('Oui')) {
            $seance->etudiants()->detach();
            $seance->cours()->dissociate();
            $seance->delete();
            //si la supp est faite
            $request->session()->flash('etat', 'Suppression effectuee');
        } else {
            $request->session()->flash('etat', 'Suppression annulee');
        }
        return redirect()->route('gestionnaire.seance'); // on retourne dans la liste des cours
    }

    /* ======== modification d'une séance ======== */

    public function mod_seanceForm($id)
    {
        $seance = Seance::findOrFail($id);
        $cours = $seance->cours;
        $c = Cours::get();
        return view('gestionnaire.mod_seance', ['cours' => $cours, 'seance' =>$seance, 'c' => $c]);
    }

    public function mod_seance(Request $request, $id) {

        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'id' => 'required',
        ]);

        $seance = Seance::findOrFail($id); // on récupere les infos de l'user que l'on a séléctionné
        $seance->date_debut = $validated['date_debut'];
        $seance->date_fin = $validated['date_fin'];
        $seance->cours_id = $validated['id'];
        $seance->save();

        session()->flash('etat', 'données de la séance modifiées');

        return redirect()->route('gestionnaire.seance');
    }

    //========= Association etudiant->cours ============

    public function association_solo($id, $id2){
        $e = Etudiant::findOrFail($id);
        $c = Cours::findOrFail($id2);
        $e->cours()->attach($c);
        session()->flash('etat', 'étudiant associer au cours');
        return redirect()->route('gestionnaire.etudiant');
    }

    public function choisir_cours($id)
    {
        $cours = Cours::paginate(5);
        return view('gestionnaire.choisir_cours', ['nom' => $cours,'id' => $id]);
    }

    public function cours_etudiants($id){
        $c = Cours::findOrFail($id);
        $e = $c->etudiants;
        return view('gestionnaire.liste_etu', ['etu' => $e, 'cours'=> $c,'id' => $id]);
    }

    //formulaire de l'asso multiple
    public function association_multiple_form($id)
    {
        $c = Cours::findOrFail($id);
        $e = Etudiant::get();
        
        return view('gestionnaire.etudiant_form', ['etudiant' => $e, 'cours' => $c]);
    }

    ///function permettant l'asso multiple
    public function association_multiple(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $cours = Cours::findOrFail($id);
        $etudiants = $request->get('id');

        if (is_array($etudiants) || is_object($etudiants)){
            foreach ($etudiants as $d) {
            $e = Etudiant::findOrFail($d);
            $e->cours()->attach($cours);
            $e->save();
            }
            session()->flash('etat', "Les étudiants ont bien été associé au cours ");
        }
        
        return redirect()->route('gestionnaire.home');
    }

    //======== supprimer Association etudiant->cours =========

    public function desassociation($id, $id2)
    {
        $e = Etudiant::findOrFail($id2);
        $c = Cours::findOrFail($id);
        $c->etudiants()->detach($e);
        $c->save();
        session()->flash('etat', 'étudiant désassocier du cours');
        return redirect()->route('gestionnaire.cours');
    }

    //association enseignant->cours
    public function association_prof($id, $id2)
    {
        $p = User::findOrFail($id);
        $c = Cours::findOrFail($id2);
        $p->cours()->attach($c);
        session()->flash('etat', 'Enseignant associer au cours');
        return redirect()->route('gestionnaire.enseignant');
    }

    public function choisir_cours_prof($id)
    {
        $cours = Cours::paginate(7);
        return view('gestionnaire.choisir_cours_prof', ['nom' => $cours, 'id' => $id]);
    }

    public function cours_prof($id)
    {
        $c = Cours::findOrFail($id);
        $p = $c->users;
        return view('gestionnaire.liste_prof', ['etu' => $p, 'cours' => $c, 'id' => $id]);
    }

    //desassociation prof->cours
    public function desassociation_prof($id, $id2)
    {
        $p = User::findOrFail($id2);
        $c = Cours::findOrFail($id);
        $c->users()->detach($p);
        session()->flash('etat', 'enseignant désassocier du cours');
        return redirect()->route('gestionnaire.cours');
    }

    //liste des séances pour un cours
    public function seance_cours($id)
    {
        $c = Cours::findOrFail($id);
        $s = $c->seance;
        return view('gestionnaire.seance_cours', ['seance' => $s, 'cours' => $c]);
    }

    /* 
    ==========================================
    ========== liste des présences ===========
    ==========================================     
*/

    //presences par l'etudiant
    public function presence_etudiant($id){
        $e = Etudiant::findOrFail($id);
        $s = $e->seance;
        $cours = [];
        foreach ($s as $d) {
            $cours[$d->id] = Cours::findOrFail($d->cours_id);
        }
        return view('gestionnaire.presence_etudiant', ['seance' => $s, 'etudiant' => $e, 'cours' => $cours]);
    }

    //presences par la séance
    public function presence_seance($id)
    {
        $s = Seance::findOrFail($id);
        $e = $s->etudiants;
        $cours = $s->cours;
        return view('gestionnaire.presence_seance', ['seance' => $s, 'etudiant' => $e, 'cours' => $cours]);
    }

    //presences par cours
    public function presence_cours($id)
    {
        $cours = Cours::findOrFail($id);
        $seances = Seance::Where('cours_id','=','$cours->id');
       
        foreach($seances as $d){
            $etudiants= $d->etudiants;
        
        return view('gestionnaire.presence_cours', ['seance' => $seances, 'etudiant' => $etudiants, 'cours' => $cours]);
        }
    }
}
