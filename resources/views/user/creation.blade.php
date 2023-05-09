@extends('layouts.app')
@section('title', 'Creation')
@section('content')
    <div class="form_container">
        <div class="form_titre">
            <h1 class="">Joignez-nous!</h1>
        </div>
        <form action="{{ route('compte.creation') }}" method="post">
            @csrf
            <div>
                <div class="form_field_container">
                    <input type="name" name="name" id="name" class="form-control" placeholder="Nom"
                        value="">
                </div>
                <div class="form_field_container">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Courriel"
                        value="">
                </div>
                <div class="form_field_container">
                    <input type="password" name="password" placeholder="Mot de passe" id="password"
                        class="form-control">
                </div>
                <div class="form_field_container">
                    <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" id="password_confirmation"
                        class="form-control">
                </div>
            </div>
            <div class="form_field_container">
                <input type="submit" value="Joindre" class="">
            </div>
        </form>
    </div>
@endsection
