@extends('layouts.app')
@section('title', 'Creation')
@section('content')
    <div class="form_container">
        <div class="form_titre">
            <h1 class="">Modification Compte</h1>
        </div>
        <form action="{{ route('compte.modification') }}" method="post">
            @csrf
            <div>
                <div class="form_field_container">
                    <p><label for="name">Nom</label></p>
                    <input type="name" name="name" id="name" class="form-control" 
                        value="{{ Auth::user()->name }}">
                </div>
                <div class="form_field_container">
                    <p><label for="email">Courriel</label></p>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ Auth::user()->email }}">
                </div>
                <div class="form_field_container">
                    <p><label for="password">Ancien Mot de passe</label></p>
                    <input type="password" name="password" placeholder="" id="password"
                        class="form-control">
                </div>
                <div class="form_field_container">
                    <p><label for="password_confirmation">Nouveau Mot de passe</label></p>
                    <input type="password_confirmation" name="password_confirmation" placeholder="" id="password_confirmation"
                        class="form-control">
                </div>
            </div>
            <div class="form_field_container">
                <input type="submit" value="Modifier" class="">
            </div>
        </form>
    </div>
@endsection
