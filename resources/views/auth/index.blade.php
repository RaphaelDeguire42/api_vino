@extends('layouts.app')
@section('title', 'Login')
@section('content')
            <div class="form_container">
                <div class="form_titre">
                    <h1 class="">Connexion</h1>
                </div>
                <form action="{{route('authentification')}}" method="post">
                    @csrf
                    <div>
                        <div class="form_field_container">
                            <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail" value="{{old('email')}}">
                        </div>
                        <div class="form_field_container">
                            <input type="password" name="password" placeholder="Mot de passe" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form_field_container">
                            <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </form>
            </div>
@endsection