@section('title', 'Login')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title></title>
</head>
<body class="back_get_started">
    <div class="flex logo_center">
        <img class="logo logo_center" src="{{ asset('img/logo-no-background.svg') }}" alt="logo">
    </div>
    <div class="accroche_depart">
    <p>Profitez du plaisir de créer vos propres celliers et de partager vos opinions avec les autres!</p>

    <p class="accroche_small">Une application dynamique qui vous permet de créer vos céliers et les partager avec le monde!</p>
    
    <a class="button_commencer" href="{{ route("index") }}"> Commencer ici</a>
    </div>
</body>
</html>