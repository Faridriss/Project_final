@extends('modele')
@section('title', 'Home Page Gestionnaire')
@section('contenu')

<head>
    <style>
        h1 {
            text-align: center;
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

    <title>Page principale de l'enseignant</title>

    <h1>Liste des seances</h1>
</head>
<ul>
    <style>
        .p1 {
            font-family: "Lucida Console", monospace;
            text-align: center;
        }

        .p1:hover {
            font-size: 150%;
        }
    </style>

</ul>

@unless(empty($seance))
<table>
    <tr>
        <th>Intitule du cours</th>
        <th>date début</th>
        <th>date fin</th>
    </tr>


    @foreach($seance as $d)
    <tr>
        <td>{{$cours[$d->id]->intitule}}</td>
        <td>{{$d->date_debut}}</td>
        <td>{{$d->date_fin}}</td>

        <td>
            <a href="{{route('prof.association_mult_form',['id' =>$d->id])}}">Pointer plusieurs étudiants pour une séance</a>
        </td>

        <td>
            <a href="{{route('prof.liste_present',['id' =>$d->id])}}">Liste des présents</a>
        </td>

        <td>
            <a href="{{route('prof.liste_absent',['id' =>$d->id])}}">Liste des absents</a>
        </td>

    </tr>
    @endforeach

</table>



@else
@endunless

{{$seance->links()}}

@endsection