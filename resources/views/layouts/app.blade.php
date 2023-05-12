<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/nav.js" defer></script>
    <title>@yield('title')</title>
</head>
<body>
 <header class="primary-header bg-primary-400">
        <div class="container flex">
            <div>
                <a href="#">
                    <img class="logo" src="./img/logo-no-background.svg" alt="">
                </a>
            </div>

            <button class="mobile-nav-toggle" 
                    aria-controls="primary-navigation" 
                    aria-expended="false"
                    data-js-burger>
                <span class="sr-only">Menu</span>
            </button>

            <nav>
                <ul id="primary-navigation" class="primary-navigation flex uppercase text-neutral-100" data-js-primary-navigation="false">
                    <li class="active">
                        <a href="#">Accueil</a>
                    </li>
                    <li>
                        <a href="#">Librairie</a>
                    </li>
                    <li>
                        <a href="#">Produits surveillés</a>
                    </li>
                    <li>
                        <a href="#">Produits consommés</a>
                    </li>
                    <li>
                        <a href="#">Favoris</a>
                    </li>
                </ul>
            </nav>
        </div>

        <h1 class="fs-primary-heading title">Bienvenue</h1>
    </header>

  
    @yield('content')
  
</body>
</html>