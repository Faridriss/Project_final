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


    <p classe="p">Veuillez rentrer les informations de l'étudiant' :</p>
    <h1></h1>
    <form action="" method="post">
        Nom: <input type="text" name="nom" value="{{old('nom')}}">
        Prenom: <input type="text" name="prenom" value="{{old('prenom')}}">
        Numéro étudiant: <input type="text" name="noet" value="{{old('noet')}}">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection