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
    liste des nouveaux utilisateurs
</h1>

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
            <a href="{{route('admin.mod_form',['id' =>$d->id])}}">Accepter</a>
            <!--lien vers la page de modification-->
        </td>
        <td>
            <a href="{{route('admin.supp_form',['id' =>$d->id])}}">Refuser</a>
            <!--lien vers la page de suppression-->
        </td>
    </tr>
    @endforeach

</table>

{{$nom->links()}}



    @else
    @endunless
    @endsection