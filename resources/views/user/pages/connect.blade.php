@extends('layout.user.layoutSIgn')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/connect.css')}}">
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

    <form method="POST" action="/login" class="formField">
        @csrf
        <div class="fields">
            <input name="pseudo" type="text" placeholder="Pseudo">
            <input name="password" type="password" placeholder="Mot de passe">
        </div>
        <input type="submit" value="Se connecter">
    </form>
    <span class="signIn">Vous n'avez pas encore de compte ? <a href="/signUp">Inscrivez vous</a></span>

@endsection
