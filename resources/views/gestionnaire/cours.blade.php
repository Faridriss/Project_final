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

    <title>Liste des cours</title>

    <h1>Liste des cours</h1>
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

@unless(empty($nom))

<form action="{{route('gestionnaire.rech_par_intitule')}}" method="post">
    @csrf
    Recherche d'un cours: <br>
    Saisir l'intitule :
    <input type="text" name="rech">
    <button type="submit">Envoyer</button>

</form>

<a href="{{route('gestionnaire.cours')}}">afficher tous les cours</a><br>

<table>
    <tr>
        <th>id</th>
        <th>Intitulé</th>
    </tr>

    @foreach($nom as $d)
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->intitule}}</td>

        <td>
            <a href="{{route('gestionnaire.cours_etudiants',['id' =>$d->id])}}">Liste des étudiants associé à ce cours</a>

        </td>

        <td>
            <a href="{{route('gestionnaire.cours_prof',['id' =>$d->id])}}">Liste des enseignants associé à ce cours</a>

        </td>

        <td>
            <a href="{{route('gestionnaire.seance_cours',['id' =>$d->id])}}">Liste des séances pour ce cours</a>

        </td>

        <td>
            <a href="{{route('gestionnaire.association_multiple_form',['id' =>$d->id])}}">Associer plusieurs étudiants à ce cours</a>

        </td>

        <td>
            <a href="{{route('gestionnaire.presence_cours',['id' =>$d->id])}}">Liste des presences (par cours)</a>

        </td>

    </tr>
    @endforeach

</table>

{{$nom->links()}}


@else
@endunless
@endsection