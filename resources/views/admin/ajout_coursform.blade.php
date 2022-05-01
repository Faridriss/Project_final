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


    <p classe="p">Veuillez rentrer les informations du cours' :</p>
    <h1></h1>
    <form action="" method="post">
        Intitulé: <input type="text" name="intitule" value="{{old('intitule')}}">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection