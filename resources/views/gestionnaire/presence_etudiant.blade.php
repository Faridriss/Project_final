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
    Liste des présences de l'etudiant : {{$etudiant->nom}} {{$etudiant->prenom}}
</h1>

@unless(empty($seance))
<table>

    <tr>
        <th>Cours</th>
        <th>date-début</th>
        <th>date-fin</th>
    </tr>

    @foreach($seance as $x)

    <tr>
        <td>{{$cours[$x->id]->intitule}}</td>
        <td>{{$x->date_debut}}</td>
        <td>{{$x->date_fin}}</td>
    </tr>
    @endforeach


</table>


@else
@endunless

@endsection