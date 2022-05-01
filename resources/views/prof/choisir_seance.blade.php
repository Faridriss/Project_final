@extends('modele')
@section('title', 'Home Page Gestionnaire')
@section('contenu')

<head>
    <style>
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
        <th>cours_id</th>
        <th>date_debut</th>
        <th>date_fin</th>
    </tr>
    @foreach($nom as $d)
    <tr>
        <td>{{$d->cours_id}}</td>
        <td>{{$d->date_debut}}</td>
        <td>{{$d->date_fin}}</td>

        <td>
            <a href="{{route('prof.association_solo',['id' => $id, 'id2' => $d->id])}}">associer l'étudiant à cette séance</a>
        </td>
    </tr>
    @endforeach

</table>

{{$nom->links()}}


@else
@endunless
@endsection