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

    <title>Liste des cours associé au prof : {{$user->nom}}</title>

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

@unless(empty($cours))


<table>
    <tr>
        <th>id</th>
        <th>Intitulé</th>
    </tr>

    @foreach($cours as $d)
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->intitule}}</td>

        <td>
            <a href="{{route('prof.cours_etudiants',['id' =>$d->id])}}">Liste des inscrits à ce cours</a>
        </td>

    </tr>
    @endforeach

</table>



@else
@endunless
@endsection