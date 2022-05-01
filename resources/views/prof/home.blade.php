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
    <title>Page principale de l'enseignant</title>
    <h1>Page principale de l'enseignant</h1>
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
        <a href="{{route('prof.liste_asso')}}">
            Liste des cours associé à ce prof
        </a>
    </p>

    <p class="p1">
        <a href="{{route('prof.cours')}}">
            Liste des cours
        </a>
    </p>

    <p class="p1">
        <a href="{{route('prof.seances')}}">
            Liste des séances (association multiple)
        </a>
    </p>

    <p class="p1">
        <a href="{{route('prof.etudiant')}}">
            Pointage d’un seul étudiant pour une séance (association individuelle)
        </a>
    </p>




</ul>

@endsection