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

    <title>Page principale du Gestionnaire</title>

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
            <a href="{{route('gestionnaire.supp_seanceform',['id' =>$d->id])}}">Supprimer</a>
            <!--lien vers la page de suppression-->
        </td>

        <td>
            <a href="{{route('gestionnaire.mod_seanceform',['id' =>$d->id])}}">Modifier</a>
            <!--lien vers la page de modif-->
        </td>

        <td>
            <a href="{{route('gestionnaire.presence_seance',['id' =>$d->id])}}">Liste des présences</a>
            <!--lien vers la page des presences-->
        </td>
    </tr>

    @endforeach

</table>



@else
@endunless

{{$seance->links()}}

@endsection