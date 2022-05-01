@extends('modele')
@section('title', 'liste des utilisateurs Admin')
@section('contenu')
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

<h1>
    liste des utilisateurs
</h1>

<form action="{{route('admin.login_rech')}}" method="POST">
    @csrf
    Recherche d'un utilisateur: <br>
    Saisir le nom/prenom/login :
    <input type="text" name="lelogin">
    <button type="submit">Envoyer</button>
</form>

<a href="{{route('admin.filtre_enseignant')}}">Filtrer les Enseignants</a><br>
<a href="{{route('admin.filtre_gestionnaire')}}">Filtrer les Gestionnaires</a><br>
<a href="{{route('admin.liste')}}">afficher tous les utilisateurs</a><br>

@unless(empty($nom))
<table>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>prenom</th>
        <th>login</th>
        <th>type</th>
    </tr>
    @foreach($nom as $d)
    @if($d->type == 'gestionnaire')
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->nom}}</td>
        <td>{{$d->prenom}}</td>
        <td>{{$d->login}}</td>
        <td>{{$d->type}}</td>
        <td>
            <a href="{{route('admin.mod_form',['id' =>$d->id])}}">Modifier</a>
            <!--lien vers la page de modification-->
        </td>
        <td>
            <a href="{{route('admin.supp_form',['id' =>$d->id])}}">Supprimer</a>
            <!--lien vers la page de suppression-->
        </td>
    </tr>
    @endif
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