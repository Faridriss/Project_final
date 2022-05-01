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
    <title>Page principale de l'administrateur</title>
    <h1>Page principale de l'administrateur</h1>
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
        <a href="{{route('admin.register')}}">
            Créer un Utilisateur
        </a>
    </p>

    <p class="p1">
        <a href="{{route('admin.liste')}}">
            Liste des utilisateurs
        </a>
    </p>

    <p class="p1">
        <a href="{{route('admin.cours')}}">
            Gestion des cours
        </a>
    </p>

    <p class="p1">
        <a href="{{route('admin.liste_newUser')}}">
            Acceptation (ou refus) d’un nouvel utilisateur
        </a>
    </p>


</ul>

@endsection