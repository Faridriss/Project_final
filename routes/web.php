<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route vers le menu principale
Route::view('/', [AdminController::class, 'home'])->name('home');

Route::view('/home', 'home')->middleware('auth');

//Route vers le login
Route::get('/login', [AuthenticatedSessionController::class, 'showForm'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout')->middleware('auth');

//Route vers le register
Route::get('/register', [RegisterUserController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/modify', [RegisterUserController::class, 'modForm'])->name('auth.modForm');
Route::post('/modify', [RegisterUserController::class, 'modify'])->name('auth.modify');

/*
    ========================
        Routes pour Admin :
    ========================
*/

Route::view('/admin', 'admin.home')->middleware('auth')->middleware('is_admin')->name('admin.home'); //lien vers la page principale des admins

Route::get('/admin/liste_newUser', [AdminController::class, 'liste_newUser'])->middleware('auth')->middleware('is_admin')->name('admin.liste_newUser');


//créer un utilisateur
Route::get('/admin/register', [AdminController::class, 'showForm'])->middleware('auth')->middleware('is_admin')->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'store'])->middleware('auth')->middleware('is_admin');
//liste des utilisateurs
Route::get('/admin/liste', [AdminController::class, 'liste'])->middleware('auth')->middleware('is_admin')->name('admin.liste');
//suppression des utilisateurs
Route::get('/admin/liste/{id}/supp', [AdminController::class, 'suppForm'])->middleware('auth')->middleware('is_admin')->name('admin.supp_form');
Route::post('/admin/liste/{id}/supp', [AdminController::class, 'supp'])->middleware('auth')->middleware('is_admin')->name('admin.supp');

//modifier les utilisateurs
Route::get('/admin/liste/{id}/modifier', [AdminController::class, 'modForm'])->middleware('auth')->middleware('is_admin')->name('admin.mod_form');
Route::post('/admin/liste/{id}/modifier', [AdminController::class, 'mod'])->middleware('auth')->middleware('is_admin');

//recherche par login/nom/prenom
Route::post('/admin/liste/rech_par_login', [\App\Http\Controllers\AdminController::class, 'user_par_login'])->middleware('auth')->middleware('is_admin')->name('admin.login_rech');

//filtrage des enseignants
Route::get('/admin/liste/enseignant', [\App\Http\Controllers\AdminController::class, 'liste_enseignant'])->middleware('auth')->middleware('is_admin')->name('admin.filtre_enseignant');
//filtrage des gestionnaires
Route::get('/admin/liste/gestiionnaire', [\App\Http\Controllers\AdminController::class, 'liste_gestionnaire'])->middleware('auth')->middleware('is_admin')->name('admin.filtre_gestionnaire');

/* ======= gestion des cours =========*/
Route::get('/admin/cours', [\App\Http\Controllers\AdminController::class, 'cours'])->middleware('auth')->middleware('is_admin')->name('admin.cours');
//ajout d'un cours
Route::get('/admin/ajout_cours', [\App\Http\Controllers\AdminController::class, 'ajout_coursForm'])->middleware('auth')->middleware('is_admin')->name('admin.add_coursForm');
Route::post('/admin/ajout_cours', [\App\Http\Controllers\AdminController::class, 'ajout_cours'])->middleware('auth')->middleware('is_admin')->name('admin.add_cours');

//suppression d'un cours
Route::get('/admin/cours/{id}/supp', [AdminController::class, 'supp_coursForm'])->middleware('auth')->middleware('is_admin')->name('admin.supp_coursform');
Route::post('/admin/cours/{id}/supp', [AdminController::class, 'supp_cours'])->middleware('auth')->middleware('is_admin')->name('admin.supp_cours');

//modification d'un cours
Route::get('/admin/cours/{id}/modifier', [AdminController::class, 'mod_coursForm'])->middleware('auth')->middleware('is_admin')->name('admin.mod_coursform');
Route::post('/admin/cours/{id}/modifier', [AdminController::class, 'mod_cours'])->middleware('auth')->middleware('is_admin');

//recherche d'un cours
Route::post('/admin/cours/rech_par_intitule', [\App\Http\Controllers\AdminController::class, 'rech_par_intitule'])->middleware('auth')->middleware('is_admin')->name('admin.rech_par_intitule');


/*
    ==============================
        Routes pour Gestionnaire :
    ==============================
*/

Route::view('/gestionnaire', 'gestionnaire.home')->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.home'); //lien vers la page principale des gestionnaires
Route::view('/gestionnaire/liste_presence', 'gestionnaire.presences')->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.presences'); //lien vers la page principale des gestionnaires
Route::get('/gestionnaire/etudiant', [\App\Http\Controllers\GestionController::class, 'etudiant'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.etudiant');
Route::get('/gestionnaire/enseignant', [\App\Http\Controllers\GestionController::class, 'enseignant'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.enseignant');

Route::get('/gestionnaire/gestion', [\App\Http\Controllers\GestionController::class, 'gestion'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.gestion');
Route::get('/gestionnaire/seance', [\App\Http\Controllers\GestionController::class, 'seance'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.seance');

//ajout d'un étudiant
Route::get('/gestionnaire/ajout_etudiant', [\App\Http\Controllers\GestionController::class, 'ajoutForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.addForm');
Route::post('/gestionnaire/ajout_etudiant', [\App\Http\Controllers\GestionController::class, 'ajout'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.add');

//suppresion d'un etudiant
Route::get('/gestionnaire/etudiant/{id}/supp', [GestionController::class, 'suppForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.supp_form');
Route::post('/gestionnaire/etudiant/{id}/supp', [GestionController::class, 'supp_etudiant'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.supp');

//modification d'un etudiant
Route::get('/gestionnaire/etudiant/{id}/mod', [GestionController::class, 'modForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.mod_form');
Route::post('/gestionnaire/etudiant/{id}/mod', [GestionController::class, 'mod'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.mod');

//recherche étudiant
Route::post('/gestionnaire/etudiant/rech_étudiant', [\App\Http\Controllers\GestionController::class, 'rech_etudiant'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.rech_etudiant');

//ajout d'une séance
//Route::get('/gestionnaire/ajout_seance', [\App\Http\Controllers\GestionController::class, 'ajout_seanceForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.add_seanceForm');
Route::get('/gestionnaire/ajout_seance', [\App\Http\Controllers\GestionController::class, 'ajout_seanceform'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.choisir_seance');
Route::post('/gestionnaire/ajout_seance', [\App\Http\Controllers\GestionController::class, 'ajout_seance'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.add_seance');



//suppression d'une seance
Route::get('/gestionnaire/seance/{id}/supp', [GestionController::class, 'supp_seanceForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.supp_seanceform');
Route::post('/gestionnaire/seance/{id}/supp', [GestionController::class, 'supp_seance'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.supp_seance');

//modif d'une séance
Route::get('/gestionnaire/seance/{id}/modif', [GestionController::class, 'mod_seanceForm'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.mod_seanceform');
Route::post('/gestionnaire/seance/{id}/modif', [GestionController::class, 'mod_seance'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.mod_seance');

//association d'un étudiant à un cours
Route::get('/gestionnaire/{id}/choisir_cours', [\App\Http\Controllers\GestionController::class, 'choisir_cours'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.choisir_cours');
Route::get('/gestionnaire/{id}/choisir_cours/{id2}/associate', [\App\Http\Controllers\GestionController::class, 'association_solo'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.association_solo');
//association multiple
Route::get('/gestionnaire/{id}/choisir_cours/associate_mult', [\App\Http\Controllers\GestionController::class, 'association_multiple_form'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.association_multiple_form');
Route::post('/gestionnaire/{id}/choisir_cours/associate_mult', [\App\Http\Controllers\GestionController::class, 'association_multiple'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.association_multiple');

//desassocier un étudiant du cours
Route::get('/gestionnaire/cours/{id}/cours_etu/{id2}/', [\App\Http\Controllers\GestionController::class, 'desassociation'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.desassociation');

//liste des cours
Route::post('/gestionnaire/cours/rech_par_intitule', [\App\Http\Controllers\GestionController::class, 'rech_par_intitule'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.rech_par_intitule');
Route::get('/gestionnaire/cours', [\App\Http\Controllers\GestionController::class, 'cours'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.cours');

//liste des étudiants associé à un cours
Route::get('/gestionnaire/cours/cours_etu/{id}/', [\App\Http\Controllers\GestionController::class, 'cours_etudiants'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.cours_etudiants');

//association d'un prof à un cours
Route::get('/gestionnaire/{id}/choisir_cours_prof', [\App\Http\Controllers\GestionController::class, 'choisir_cours_prof'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.choisir_cours_prof');
Route::get('/gestionnaire/{id}/choisir_cours/{id2}/associateprof', [\App\Http\Controllers\GestionController::class, 'association_prof'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.association_prof');

//desassocier prof a un cours
Route::get('/gestionnaire/cours/{id}/cours_prof/{id2}/', [\App\Http\Controllers\GestionController::class, 'desassociation_prof'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.desassociation_prof');

//liste des profs associé à un cours
Route::get('/gestionnaire/cours/cours_prof/{id}/', [\App\Http\Controllers\GestionController::class, 'cours_prof'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.cours_prof');

//liste des séance associé à un cours
Route::get('/gestionnaire/cours/seance_cours/{id}/', [\App\Http\Controllers\GestionController::class, 'seance_cours'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.seance_cours');



/*
    ==============================
        Routes pour Enseignant :
    ==============================
*/

Route::view('/prof', 'prof.home')->middleware('auth')->middleware('is_enseignant')->name('prof.home'); //lien vers la page principale des enseignants

//lien vers la liste des étudiants
Route::get('/prof/etudiant', [\App\Http\Controllers\ProfController::class, 'etudiant'])->middleware('auth')->middleware('is_enseignant')->name('prof.etudiant');

//lien vers la liste des cours
Route::get('/prof/cours', [\App\Http\Controllers\ProfController::class, 'cours'])->middleware('auth')->middleware('is_enseignant')->name('prof.cours');

Route::get('/prof/cours_associé', [\App\Http\Controllers\ProfController::class, 'cours_asso'])->middleware('auth')->middleware('is_enseignant')->name('prof.liste_asso');


//lien vers la liste des seances
Route::get('/prof/seances', [\App\Http\Controllers\ProfController::class, 'seances'])->middleware('auth')->middleware('is_enseignant')->name('prof.seances');


//association d'un étudiant à une séance
Route::get('/prof/{id}/choisir_seance', [\App\Http\Controllers\ProfController::class, 'choisir_seance'])->middleware('auth')->middleware('is_enseignant')->name('prof.choisir_seance');
Route::get('/prof/{id}/choisir_seance/{id2}/associate', [\App\Http\Controllers\ProfController::class, 'association_solo'])->middleware('auth')->middleware('is_enseignant')->name('prof.association_solo');

//association multiple étudiants->séances
Route::get('/prof/{id}/choisir_seance/associate_mult', [\App\Http\Controllers\ProfController::class, 'association_multiple_form'])->middleware('auth')->middleware('is_enseignant')->name('prof.association_mult_form');
Route::post('/prof/{id}/choisir_seance/associate_mult', [\App\Http\Controllers\ProfController::class, 'association_multiple'])->middleware('auth')->middleware('is_enseignant')->name('prof.association_mult');


//lien vers la liste des étudiants associé a une seance
Route::get('/prof/presences/{id}/', [\App\Http\Controllers\ProfController::class, 'cours_etudiants'])->middleware('auth')->middleware('is_enseignant')->name('prof.cours_etudiants');

//liste des present a une seance
Route::get('/prof/presents/{id}/', [\App\Http\Controllers\ProfController::class, 'liste_present'])->middleware('auth')->middleware('is_enseignant')->name('prof.liste_present');
//liste des absents a une seance
Route::get('/prof/absents/{id}/', [\App\Http\Controllers\ProfController::class, 'liste_absent'])->middleware('auth')->middleware('is_enseignant')->name('prof.liste_absent');

//liste presence par étudiant
Route::get('/gestionnaire/presences_etu/{id}/', [\App\Http\Controllers\GestionController::class, 'presence_etudiant'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.presence_etudiant');
//liste présence par séance
Route::get('/gestionnaire/presences_seance/{id}/', [\App\Http\Controllers\GestionController::class, 'presence_seance'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.presence_seance');
//liste présence par cours
Route::get('/gestionnaire/presences_cours/{id}/', [\App\Http\Controllers\GestionController::class, 'presence_cours'])->middleware('auth')->middleware('is_gestionnaire')->name('gestionnaire.presence_cours');
