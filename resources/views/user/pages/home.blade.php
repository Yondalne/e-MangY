@extends('layout.user.layoutMain')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/home.css')}}">
@endsection

@section('content')
    <div class="recent">
        <h2>Actualités</h2>
        <div class="allPost">
            <div class="Post">
                <img src="{{asset('assets/default_bg.jpg')}}" alt="">
                <div class="postContent">
                    <div class="title">
                        <h2>Ceci est un Test</h2>
                    </div>
                    <div class="resume">
                        <div class="contentResume">sadsiuadsaddsnjdnsadkndskjnasjksnkdnskankdsnksnkdnsknadknkandksnkdnksnksdandkasn</div>
                        <div class="link"><a href="#">Lire</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent">
        <h2>Discussions Hot</h2>
        <div class="allPost">
            <div class="Post">
                <img src="{{asset('assets/default_bg.jpg')}}" alt="">
                <div class="postContent">
                    <div class="title">
                        <h2>Ceci est un Test</h2>
                    </div>
                    <div class="resume">
                        <div class="contentResume">sadsiuadsaddsnjdnsadkndskjnasjksnkdnskankdsnksnkdnsknadknkandksnkdnksnksdandkasn</div>
                        <div class="link"><a href="#">Lire</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
