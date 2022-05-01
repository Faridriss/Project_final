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


    <p classe="p">Associer les étudiants à la séance de: {{$cours -> intitule}} :</p>
    <h1></h1>
    <form action="" method="post">
        
            <select class="$form-select form-select-lg " name="id[]" multiple aria-label="multiple select example">
                <option selected>Choisir les étudiants</option>
                @foreach($etudiant as $d)
                <option value="{{$d->id}}">{{$d->nom}}, {{$d->prenom}}, {{$d->noet}}</option>
                @endforeach
            </select>
            <input type="submit" value="Envoyer">
            @csrf
        
    </form>
    @endsection