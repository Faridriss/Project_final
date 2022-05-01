<!-- resources/views/mod_form.blade.php -->
@extends("modele")
@section('title', 'Modifier une pizza')
@section('contenu')

<style>
    p {
        font-family: "Lucida Console", monospace;
        font-weight: bold;
    }

    h1 {
        font-size: 80px;
    }

    h2 {
        font-size: 40px;
    }

    li:hover {
        font-size: 150%;
    }
</style>

<p>Veuillez modifier les données de l'utilisateur</p>
<h1></h1>
<form method="post">
    Nom: <input type="text" name="nom" value="{{$user->nom}}">
    Prenom: <input type="text" name="prenom" value="{{$user->prenom}}">
    Numéro étudiant: <input type="text" name="noet" value="{{$user->noet}}">
    @csrf
</form>
<li><a href="{{route('gestionnaire.etudiant')}}">Liste des étudiant</a></li>
@endsection