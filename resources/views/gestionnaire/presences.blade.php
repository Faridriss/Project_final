@extends('modele')
@section('title', 'Home Page Admin')
@section('contenu')

<head>
    <style>
        h1 {
            text-align: center;
            font-family: "Monaco", monospace;
        }
    </style>
    <title>Page principale du gestionnaire </title>
    <h1>Gestion de la liste de présence</h1>
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
        <a href="{{route('gestionnaire.etudiant')}}">
            Liste des présences détaillé par étudiant
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.seance')}}">
            liste des présences par séance
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.cours')}}">
            liste des présences par cours
        </a>
    </p>

</ul>

@endsection