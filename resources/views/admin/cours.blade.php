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
            background-color: lightgrey;
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

    <p class="p1">
        <a href="{{route('admin.add_coursForm')}}">
            Ajoutez un cours
        </a>
    </p>


</ul>

@unless(empty($nom))

<form action="{{route('admin.rech_par_intitule')}}" method="post">
    @csrf
    Recherche d'un cours: <br>
    Saisir l'intitule :
    <input type="text" name="rech">
    <button type="submit">Envoyer</button>

</form>

<a href="{{route('admin.cours')}}">afficher tous les cours</a><br>

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
            <a href="{{route('admin.supp_coursform',['id' =>$d->id])}}">Supprimer</a>
            <!--lien vers la page de suppression-->
        </td>

        <td>
            <a href="{{route('admin.mod_coursform',['id' =>$d->id])}}">Modifier</a>
            <!--lien vers la page de suppression-->
        </td>

    </tr>
    @endforeach

</table>

{{$nom->links()}}


@else
@endunless
@endsection