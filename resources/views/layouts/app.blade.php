<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    @if (session()->has('auth'))
       <p class="retour_action"> connecté </p><a href="{{ route('deconnexion') }}">Deconnexion</a>
    @endif
    @if (session("errors"))
        <p class="retour_action_error">{{ session('errors')->first() }}</p>
    @endif
    <nav>
    @if (session()->has('auth'))
        <a href="{{route('cellier.index', Auth::user()->id)}}">Mes celliers</a>
    @endif
        <a href="{{route('bouteille.index')}}">Catalogue</a>
    </nav>
    @if (session("success"))
        <div id="snackbar">{{ session('success') }} <span class="snackBar__fermer">Fermer</span> </div>
    @endif
    @yield('content')
    <script>
        let snackbar = document.getElementById("snackbar") ?? null;
        if(snackbar){
            snackbar.className = "show";
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
            let btnFermer = document.querySelector('.snackBar__fermer');
                btnFermer.addEventListener('click', function(){
                    snackbar.classList.remove('show');
                })
        }
    </script>
</body>
</html>