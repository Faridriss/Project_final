<!-- resources/views/admin/ajout_form.blade.php -->
@extends("modele")
@section('title', 'Ajouter un Etudiant')
@section('contenu')
<!– gestion des erreurs -->

    <style>
        p {
            font-family: "Lucida Console", monospace;
            font-weight: bold;
        }

        h1 {
            font-size: 80px;
        }
    </style>


    <p classe="p">Veuillez modifier les informations de l'étudiant :</p>
    <h1></h1>
    <form method="post">
        Nom: <input type="text" name="nom" value="{{$nom->nom}}">
        Prenom: <input type="text" name="prenom" value="{{$nom->prenom}}">
        Numéro étudiant: <input type="text" name="noet" value="{{$nom->noet}}">
        <input type="submit" value="Envoyer">
        @csrf
    </form>


    @endsection