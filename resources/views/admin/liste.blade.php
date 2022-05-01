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

<div class = "input-group">
    <form action="{{route('admin.login_rech')}}" method="post">
    @csrf
    Recherche d'un utilisateur: <br>
    Saisir le nom/prenom/login :
    <input type="text" name="rech">
    <button type="submit">Envoyer</button>

    </form>

    
</div>


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
    @endforeach

</table>

{{$nom->links()}}




    @else
    @endunless
    @endsection