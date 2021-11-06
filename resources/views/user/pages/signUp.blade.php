@extends('layout.user.layoutSIgn')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/signUp.css')}}">
@endsection

@section('form')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="inscription" method="POST" class="formField">
        @csrf
        <div class="fields">
            <div class="info">
                <div class="line">
                    <div class="inputContainer">
                        <label for="name">Nom</label>
                        <input required name="name" type="text" id="name">
                    </div>
                    <div class="inputContainer">
                        <label for="secondN">Prénom</label>
                        <input required name="secondN" type="text" id="secondN">
                    </div>
                </div>

                <div class="line">
                    <div class="inputContainer">
                        <label for="email">Email</label>
                        <input required name="email" type="email" id="email">
                    </div>
                    <div class="inputContainer">
                        <label for="nais">Date de naissance</label>
                        <input required name="dateN" type="date" id="nais">
                    </div>
                </div>
            </div>

            <div class="info">
                <div class="line">
                    <div class="inputContainer">
                        <label for="pseudo">Pseudo</label>
                        <input required name="pseudo" type="text" id="pseudo">
                    </div>
                </div>

                <div class="line">
                    <div class="inputContainer">
                        <label for="password">Mot de passe</label>
                        <input required name="password" type="password" id="password">
                    </div>

                    <div class="inputContainer">
                        <label for="passwordC">Confirmer le mot de passe</label>
                        <input required name="password_confirmation" type="password" id="passwordC">
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="S'inscrire">
    </form>
    <span class="signIn">Vous déjà un compte ? <a href="/login">Connectez vous</a></span>
@endsection
