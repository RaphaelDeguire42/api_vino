@extends('layouts.app')
@section('content')
<main class="page-principale">
        <section class="liste-cellier">
            <h2 class="fs-secondary-heading">Liste des celliers</h2>
            <ul role="list">
                <li role="list-item">
                    <a href="#">Cellier 1</a> 
                </li>
                <li role="list-item">
                    <a href="#">Cellier 2</a> 
                </li>
                <li role="list-item">
                    <a href="#">Cellier 3</a> 
                </li>
            </ul>
        </section>
        <section>
            <h2 class="fs-secondary-heading">Top 5</h2>
            <div class="produit-grid">
                <article class="unProduit card">
                    <img class="card__img" src="{{ asset('img/19crimes.webp') }}" alt="19crimes"/>
                    <div class="card__content">
                        <h2 class="card__title">19 Crimes Shiraz/Grenache/Mataro</h2>
                        <p class="card__type">Vin Rouge</p>
                        <p class="card__pays">Australie</p>
                        <p class="card__vote">Note: 4.2 / 5</p>
                    </div>
                </article>
                <article class="unProduit card">
                    <img class="card__img" src="{{ asset('img/19crimes.webp') }}" alt="19crimes"/>
                    <div class="card__content">
                        <h2 class="card__title">19 Crimes Shiraz/Grenache/Mataro</h2>
                        <p class="card__type">Vin Rouge</p>
                        <p class="card__pays">Australie</p>
                        <p class="card__vote">Note: 4.2 / 5</p>
                    </div>
                </article>
                <article class="unProduit card">
                    <img class="card__img" src="{{ asset('img/19crimes.webp') }}" alt="19crimes"/>
                    <div class="card__content">
                        <h2 class="card__title">19 Crimes Shiraz/Grenache/Mataro</h2>
                        <p class="card__type">Vin Rouge</p>
                        <p class="card__pays">Australie</p>
                        <p class="card__vote">Note: 4.2 / 5</p>
                    </div>
                </article>
                <article class="unProduit card">
                    <img class="card__img" src="{{ asset('img/19crimes.webp') }}" alt="19crimes"/>
                    <div class="card__content">
                        <h2 class="card__title">19 Crimes Shiraz/Grenache/Mataro</h2>
                        <p class="card__type">Vin Rouge</p>
                        <p class="card__pays">Australie</p>
                        <p class="card__vote">Note: 4.2 / 5</p>
                    </div>
                </article>
                <article class="unProduit card">
                    <img class="card__img" src="{{ asset('img/19crimes.webp') }}" alt="19crimes"/>
                    <div class="card__content">
                        <h2 class="card__title">19 Crimes Shiraz/Grenache/Mataro</h2>
                        <p class="card__type">Vin Rouge</p>
                        <p class="card__pays">Australie</p>
                        <p class="card__vote">Note: 4.2 / 5</p>
                    </div>
                </article>
            </div>   
        </section>

        <nav class="bottom-nav">
            <a href="#" class="active"><i class="fa-regular fa-house"></i><span> Accueil</span></a>
            <a href="#"><i class="fa-regular fa-bookmark"></i><span> À surveiller</span></a>
            <a href="#"><i class="fa-regular fa-user"></i><span> Profil</span></a>
        </nav>    
@endsection