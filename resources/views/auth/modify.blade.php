@extends('modele')

@section('contenu')
<p>Modification</p>
<form method="post">
    Nom: <input type="text" name="nom" value="{{$user->nom}}">
    Prenom: <input type="text" name="prenom" value="{{$user->prenom}}">
    MDP: <input type="password" name="mdp">
    Confirmation MDP: : <input type="password" name="mdp_confirmation">
    <input type="submit" value="Envoyer">
    @csrf
</form>
@endsection