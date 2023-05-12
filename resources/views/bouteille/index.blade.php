@extends('layouts.app')
@section('title', 'Catalogue')
@section('content')

<div class="wrapper grid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @forelse ($bouteilles as $bouteille)
    <div class="card">
        <div class="card-image">
            <img src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}">
        </div>
        <div class="card-content">
            <span class="card-title">{{$bouteille['nom']}}</span>
            <p><a class="btn" href="{{$bouteille['url_saq']}}">Voir sur SAQ.com</a></p>
        </div>
        <div class="card-action">
            {{--
                TODO ajouter au cellier (menu select avec le nom du cellier et envoie de id_bouteille et id_cellier et ensuite -> store)
            --}}
            {{-- TODO delete sur admin
            <form action="{{ route('bouteille.destroy', $bouteille->id) }}" method="POST"> @csrf @method('DELETE')
                <button class="btn red" type="submit">Supprimer</button>
            </form>
            --}}
        </div>
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

<script src="/components/ajouterBouteille/main.js"></script>
<script src="/components/ajouterBouteille/polyfills.js"></script>
<script src="/components/ajouterBouteille/runtime.js"></script>
@endsection
