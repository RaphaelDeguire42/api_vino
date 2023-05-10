@extends('layouts.app')
@section('title', 'Mes celliers')
@section('content')

    @foreach ($celliers as $cellier)
        <div class="cellier">
            <div class="cellier__top">
            <span class="cellier__pastille" style="background-color:{{$cellier->cellierHasCouleur->hex_value}}"></span>
                <p>{{$cellier->nom}}</p>
            </div>
            <div class="cellier__bottom">
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
        </div>
    @endforeach

@endsection