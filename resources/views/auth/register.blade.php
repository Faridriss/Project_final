@extends('modele')

@section('contenu')
<p>Enregistrement</p>
<form method="post">
    Nom: <input type="text" name="nom" value="{{old('nom')}}">
    Prenom: <input type="text" name="prenom" value="{{old('prenom')}}">
    Login: <input type="text" name="login" value="{{old('login')}}">
    MDP: <input type="password" name="mdp">
    Confirmation MDP: : <input type="password" name="mdp_confirmation">
    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection