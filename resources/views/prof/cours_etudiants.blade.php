{{-- ressources/views/cook/details.blade.php --}}
@extends('modele')
@section('title', 'cours_etudiant')
@section('contenu')
<style>
    h1 {
        text-align: center;
        font-family: "Monaco", monospace;
    }

    p {
        text-align: left;
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
    Liste des etudiants associer au cours : {{$cours->intitule}}
</h1>
<p>nombre de présents : {{$qte}} </p>

@unless(empty($etu))
<table>

    <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>num etudiant</th>
    </tr>
    @foreach($etu as $x)
    <tr>
        <td>{{$x->nom}}</td>
        <td>{{$x->prenom}}</td>
        <td>{{$x->noet}}</td>
    </tr>
    @endforeach

</table>


@else
@endunless

@endsection