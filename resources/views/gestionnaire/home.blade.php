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
    <h1>Page principale du gestionnaire</h1>
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
            Gestion des étudiants (association individuelle)
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.gestion')}}">
            Gestion des séances
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.cours')}}">
            liste des cours (association multiple)
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.enseignant')}}">
            liste des enseignants (association enseignant)
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.presences')}}">
            Liste des présences
        </a>
    </p>


</ul>

@endsection