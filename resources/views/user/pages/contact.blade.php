@extends('layout.user.layoutMain')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/contact.css')}}">
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger" style="position: absolute; top: 15%; left: 50%; transform: translate(-50%, -15%)">
            <ul style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Contactez moi</h1>
    <div class="form">
        {{-- Ca ne marche pas encore --}}
        <form action="/sendMail" method="POST">
            @csrf
            <input required type="email" name="sender" placeholder="Entrez votre mail">
            <textarea required name="text" cols="30" rows="10" placeholder="Je vous ecoute"></textarea>
            <input type="submit">
        </form>
    </div>
@endsection
