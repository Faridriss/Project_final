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

    <p class="p1">
        <a href="{{route('gestionnaire.addForm')}}">
            Ajoutez un étudiant
        </a>
    </p>



</ul>

<form action="{{route('gestionnaire.rech_etudiant')}}" method="post">
    @csrf
    Recherche d'un utilisateur: <br>
    Saisir le nom/prenom/numéro étudiant :
    <input type="text" name="rech">
    <button type="submit">Envoyer</button>

</form>

<a href="{{route('gestionnaire.etudiant')}}">afficher tous les étudiants</a><br>

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
            <a href="{{route('gestionnaire.supp_form',['id' =>$d->id])}}">Supprimer</a>
            <!--lien vers la page de suppression-->
        </td>

        <td>
            <a href="{{route('gestionnaire.mod_form',['id' =>$d->id])}}">Modifier</a>
            <!--lien vers la page de modification-->
        </td>

        <td>
            <a href="{{route('gestionnaire.choisir_cours',['id' =>$d->id])}}">Associer à un cours</a>
            <!--lien vers la page d'association-->
        </td>

        <td>
            <a href="{{route('gestionnaire.presence_etudiant',['id' =>$d->id])}}">Liste des présences</a>
            <!--lien vers la page d'association-->
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