<head>
    <link rel="stylesheet" href="/css/material-styles.css">
    <link rel="stylesheet" href="/css/signalerErreur.css">
</head>

<style>
.wrapper{
    margin: 0 8vw;
    display: grid;
    gap: 1em;
    grid-template-columns: repeat(5, 1fr);
}
.card a {
    text-decoration:none;
    padding: 0;
}
.card{
   width:fit-content;
   background-color: gray;
   display:flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   padding: 0em 0.75em;
   margin: 0.5em 0;
}

.card picture{
   width: 108px;
   display: block;
}

.card h2{
   max-width: 25ch;
   text-align:center;
   text-decoration:none;
   color:black;
}
.card__link{
   color:white;
}
.card__link:hover{
    text-decoration: underline;
}
img{
    width:100%;
}
</style>


<div class="wrapper">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @forelse ($bouteilles as $bouteille)
    <div class="card">
    <a href="{{route('bouteille.show', $bouteille->id)}}" class="card">
        <h2 class="card__title">{{$bouteille['nom']}}</h2>
        <picture><img src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}"></picture>
        <p><a class="card__link" href="{{$bouteille['url_saq']}}">Voir sur SAQ.com</a></p>
    </a>
    </div>
    @empty
    <h2>Aucunes bouteilles pour le moments</h2>
    <a href="{{route('admin.ajouteBouteille')}}">Ajouter des bouteilles</a>
    @endforelse
</div>

<div class="signalerErreur">Signaler une erreur</div>

<!--  Composant Angular Signaler une erreur -->
<error-box class="hide erreurBox"></error-box>
<script src="/js/signalerErreur.js"></script>
<script src="/components/erreur/main.js"></script>
<script src="/components/erreur/polyfills.js"></script>
<script src="/components/erreur/runtime.js"></script>




