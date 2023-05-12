@extends('layouts.app')
@section('title', 'Mes celliers')
@section('content')
    <nouveau-cellier class="nouveau-cellier"></nouveau-cellier>
    <script src="/components/nouveauCellier/main.js"></script>
    <script src="/components/nouveauCellier/polyfills.js"></script>
    <script src="/components/nouveauCellier/runtime.js"></script>

    @foreach ($celliers as $cellier)
        <div class="cellier">
            <div class="cellier__top">
            <span class="cellier__pastille" style="background-color:{{$cellier->cellierHasCouleur->hex_value}}"></span>
                <p>{{$cellier->nom}}</p>
            </div>
            <div class="cellier__content">
            {{--
                @php
                    $bouteilles=$cellier->cellierHasBouteille;
                @endphp

                @forelse ($bouteilles as $bouteille)
                    <p>{{$bouteille->nom}}</p>
                @empty
                    <p>Aucune bouteille pour le moment...</p>
                @endforelse
                --}}
            </div>
            <div class="cellier__bottom">



                @if ($celliers->count() > 1)
                    <form action="{{ route('cellier.destroy', $cellier->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn red" type="submit">Supprimer</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

@endsection