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

    <title>liste etudiant</title>

    <h1>Liste des étudiants</h1>
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

<!--<form action="{{route('gestionnaire.rech_etudiant')}}" method="post">
    @csrf
    Recherche d'un utilisateur: <br>
    Saisir le nom/prenom/numéro étudiant :
    <input type="text" name="rech">
    <button type="submit">Envoyer</button>

</form>-->

<a href="{{route('prof.etudiant')}}">afficher tous les étudiants</a><br>

@unless(empty($nom))
<table>
    <tr>

        <th>nom</th>
        <th>prenom</th>
        <th>numéro etudiant</th>
    </tr>
    @foreach($nom as $d)
    <tr>
        <td>{{$d->nom}}</td>
        <td>{{$d->prenom}}</td>
        <td>{{$d->noet}}</td>

        <td>
            <a href="{{route('prof.choisir_seance',['id' =>$d->id])}}">Pointer l'étudiant à une séance</a>
            <!--lien vers la page de suppression-->
        </td>

    </tr>
    @endforeach

</table>

{{$nom->links()}}

<li>
    <style>
        a.one:link {
            color: #ff0000;
        }

        a.one:visited {
            color: #0000ff;
        }

        a.one:hover {
            font-size: 150%;
        }
    </style>


    @else
    @endunless
    @endsection