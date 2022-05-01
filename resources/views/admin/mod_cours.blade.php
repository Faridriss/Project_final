<!-- resources/views/mod_form.blade.php -->
@extends("modele")
@section('title', 'Modifier une pizza')
@section('contenu')

<style>
    p {
        font-family: "Lucida Console", monospace;
        font-weight: bold;
    }

    h1 {
        font-size: 80px;
    }

    h2 {
        font-size: 40px;
    }

    li:hover {
        font-size: 150%;
    }
</style>

<p>Veuillez modifier les données du cours</p>
<h1></h1>
<form method="post">
    Intitule: <input type="text" name="intitule" value="{{$cours->intitule}}">
    <input type="submit" name="Envoyer">

    @csrf
</form>
<li><a href="{{route('admin.cours')}}">Liste des cours</a></li>
@endsection