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

    <title>Liste des enseignants</title>

    <h1>Liste des enseignants</h1>
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

<table>
    <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>login</th>
    </tr>

    @foreach($nom as $d)
    <tr>
        <td>{{$d->nom}}</td>
        <td>{{$d->prenom}}</td>
        <td>{{$d->login}}</td>
        <td>
            <a href="{{route('gestionnaire.choisir_cours_prof',['id' =>$d->id])}}">Associer à un cours</a>
        </td>

    </tr>
    @endforeach

</table>

{{$nom->links()}}


@else
@endunless
@endsection