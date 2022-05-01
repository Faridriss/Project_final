{{-- ressources/views/modeles/modele.blade.php --}}
<!DOCTYPE html>
<html>

<style>
    .droite {
        margin-right: 10;
    }

    #exemple {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        overflow: auto;
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>
    <div class="p-3 mb-2 bg-dark text-white" id="exemple">
        @section('menu')
        @if( session()->has('etat'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{session()->get('etat')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <ul class="nav nav-tabs">

            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                    </svg>
                </a>
            </li>


            @guest()

            <li class="nav-item"> <a class="nav-link" aria-current="page" href="{{route('login')}}">Se connecter</a> </li>
            <li class="nav-item"> <a class="nav-link" aria-current="page" href="{{route('register')}}">Créer un compte</a> </li>
        </ul>
        @endguest

        @auth
        <li class="nav-item"> <a class="nav-link" href="{{route('logout')}}">Deconnexion</a>
        <li class="nav-item"> <a class="nav-link" href="{{route('auth.modForm')}}">Modifier le compte</a>
            </ul>
            @endauth
            @auth
            <ul>
                <a href="{{route('admin.home')}}">Accueil Administrateur</a>
                <a href="{{route('prof.home')}}">Accueil Enseignants</a>
                <a href="{{route('gestionnaire.home')}}">Acceuil Gestionnaire</a>
            </ul>
            @endauth

            @show

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


            @yield('contenu')
    </div>
</body>

</html>