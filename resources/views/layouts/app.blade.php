<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    @if (session()->has('auth'))
       <p class="retour_action"> connecté </p><a href="{{ route('deconnexion') }}">Deconnexion</a>
    @endif
    @if (session("errors"))
        <p class="retour_action">{{ session('errors')->first() }}</p>
    @endif
    @yield('content')
</body>
</html>