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
        <a href="{{route('gestionnaire.choisir_seance')}}">
            Ajouter une séance
        </a>
    </p>

    <p class="p1">
        <a href="{{route('gestionnaire.seance')}}">
            liste des séances
        </a>
    </p>



</ul>

@endsection