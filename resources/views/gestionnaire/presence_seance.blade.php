{{-- ressources/views/cook/details.blade.php --}}
@extends('modele')
@section('title', 'Détails de la commande')
@section('contenu')
<style>
    h1 {
        text-align: center;
        font-family: "Monaco", monospace;
    }

    p {
        text-align: left;
        font-family: "Monaco", monospace;
    }

    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 75%;
    }

    th,
    td {
        padding: 20px;
    }

    tr:hover {
        background-color: darkgrey;
    }
</style>

<h1>
    Liste des présences de la séance : {{$cours->intitule}} de {{$seance->date_debut}} à {{$seance->date_fin}}
</h1>

@unless(empty($seance))
<table>

    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Numéro étudiant</th>
    </tr>

    @foreach($etudiant as $x)

    <tr>
        <td>{{$x->nom}}</td>
        <td>{{$x->prenom}}</td>
        <td>{{$x->noet}}</td>
    </tr>
    @endforeach


</table>


@else
@endunless

@endsection