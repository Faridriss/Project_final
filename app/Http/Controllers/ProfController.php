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


class ProfController extends Controller
{
    //route pour retourner vers le menu principal
    public function home()
    {
        return view('home');
    }

    //afficher les étudiants
    public function etudiant()
    {

        $user = Etudiant::paginate(7);
        return view('prof.etudiant', ['nom' => $user]);
    }

    //liste de cours
    public function cours()
    {
        $cours = Cours::paginate(7);
        return view('prof.cours', ['nom' => $cours]);
    }

    //liste de séances
    public function seances()
    {
        $seances = Seance::paginate(7);
        $cours = [];
        foreach($seances as $d){
            $cours[$d->id] = Cours::findOrFail($d->cours_id);
        }
        return view('prof.seances', ['seance' => $seances, 'cours' => $cours]);
    }

    /* 
    ==========================================
    ============ Gestion du Prof =============
    ==========================================     
    */

    //liste des cours associés
    public function cours_asso()
    {
        $user = Auth::user();
        $cours = $user->cours;
        return view('prof.liste_asso', ['cours' => $cours, 'user' => $user]);
    }


    //association etudiant->seance(présences)
    public function association_solo($id, $id2)
    {
        $e = Etudiant::findOrFail($id);
        $s = Seance::findOrFail($id2);
        $e->seance()->attach($s);
        session()->flash('etat', 'étudiant associer à la seance');
        return redirect()->route('prof.etudiant');
    }

    public function choisir_seance($id)
    {
        $seance = Seance::paginate(7);
        return view('prof.choisir_seance', ['nom' => $seance, 'id' => $id]);
    }

    //liste des étudiants inscrit à un cours
    public function cours_etudiants($id)
    {
        $c = Cours::findOrFail($id);
        $qte = 0;
        $seances = $c->seance;
        $etudiants = $c->etudiants;
        foreach($seances as $s){
            foreach($etudiants as $e){
                if($s->presences == $e->presences){
                    $qte++;
                }
            }
        }

       
        return view('prof.cours_etudiants', ['etu' => $etudiants, 'cours' => $c,'qte' => $qte]);
    }



    //formulaire pour l'association multiple
    public function association_multiple_form($id)
    {
        $s = Seance::findOrFail($id);
        $c = $s->cours;
        $e = Etudiant::get();

        return view('prof.etudiant_form', ['etudiant' => $e, 'seance' => $s, 'cours' => $c]);
    }

    //association multiple
    public function association_multiple(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $seances = Seance::findOrFail($id);
        $etudiants = $request->get('id');

        if (is_array($etudiants) || is_object($etudiants)) {
            foreach ($etudiants as $d) {
                $e = Etudiant::findOrFail($d);
                $e->seance()->attach($seances);
                $e->save();
            }
            session()->flash('etat', "Les étudiants ont bien été associé au cours ");
        }

        return redirect()->route('gestionnaire.home');
    }

    //liste des présent une séance
    public function liste_present($id)
    {
        $seance = Seance::findOrFail($id);
        $present = [];
        $e = $seance->etudiants;
        $et = Etudiant::all();
        foreach($et as $i){
            foreach($e as $j){
                if($i == $j){
                    $present[$i->id] = $i;
                }
            }

        }

        return view('prof.liste_present',['etudiant' => $e]);
    }

    public function liste_absent($id)
    {
        $seance = Seance::findOrFail($id);
        $present = [];
        $e = $seance->etudiants;
        $et = Etudiant::where();
        for ($i = 0; $i < sizeof($et); $i++) {
            for ($j = 0; $j < sizeof($e); $i++) {
                if($et[$i] == $e[$j]){
                    $i++;
                }
                
            }
        }

        return view('prof.liste_present', ['etudiant' => $present]);
    }


}