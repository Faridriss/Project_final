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


    <p classe="p">Veuillez modifier les informations de la séance :</p>
    <h1></h1>
    <form  method="post">
        <div class="input-group">

            Date début: <input type="datetime-local" name="date_debut" value="{{$cours->date_debut}}">
            Date fin: <input type="datetime-local" name="date_fin" value="{{$cours->date_fin}}">


            <select class="$form-select-padding-y-lg" name="id" aria-label="Default select example">
                <option selected>Choisir les cours</option>
                @foreach($c as $d)
                <option value="{{$d->id}}">{{$d->intitule}}</option>
                @endforeach
            </select>
            <input type="submit" value="Envoyer">

            @csrf
        </div>
    </form>


    @endsection