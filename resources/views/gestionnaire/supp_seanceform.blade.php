{{-- ressources/views/supp_form.blade.php --}}
@extends('modele')
@section('title', 'Supprimer')
@section('contenu')

<style>
    p {
        font-family: "Lucida Console", monospace;
        font-weight: bold;
    }

    h1 {
        font-size: 80px;
    }
</style>

<p>Voulez-vous supprimer la séance : <!--{{$nom->intitule}} ?--> </p>
<h1></h1>
<form action="{{route('gestionnaire.supp_seance', ['id'=>$nom->id])}}" method="post">
    <input type="hidden" name='z' value='z'>
    <input type="submit" name="Oui" value="Oui">
    <input type="submit" name="Non" value="Non">
    @csrf
</form>
@endsection