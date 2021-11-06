@extends('layout.user.layoutUserDashboard')


@section('link')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{asset('css/user_dashboard/profil.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/cropper.min.css')}}"> --}}
@endsection


@section('aside-content')
    <div class="layout">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="layoutInfo">
            <form action="/modify/{{$user->id}}/account" method="POST" class="forms">
                @csrf
                @method('PATCH')

                <div class="header">
                    <h2>Informations du Compte</h2>
                </div>

                <div class="perso">
                    <div class="info">
                        <div class="line">
                            <div class="inputContainer">
                                <label for="pseudo">Pseudo</label>
                                <input name="pseudo" type="text" id="pseudo" value="">
                            </div>
                        </div>

                        <div class="line">
                            <div class="inputContainer">
                                <label for="password">Ancien mot de passe</label>
                                <input name="password" type="password" id="password">
                            </div>

                            <div class="inputContainer scd">
                                <label for="passwordN">Nouveau mot de passe</label>
                                <input name="new_password" type="password" id="passwordN">
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Sauvegarder">
            </form>

            <form action="/modify/{{$user->id}}/perso" method="POST" class="forms">
                @csrf
                @method('PATCH')

                <div class="header">
                    <h2>Informations Personelles</h2>
                </div>

                <div class="perso">
                    <div class="info">
                        <div class="line">
                            <div class="inputContainer">
                                <label for="name">Nom</label>
                                <input name="name" type="text" id="name" value="">
                            </div>
                            <div class="inputContainer scd">
                                <label for="secondN">Prénom</label>
                                <input name="secondN" type="text" id="secondN" value="">
                            </div>
                        </div>

                        <div class="line">
                            <div class="inputContainer">
                                <label for="email">Email</label>
                                <input name="email" type="email" id="email" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Sauvegarder">
            </form>
        </div>

        <div class="layoutPhoto">
            <form id="imgProfil" action="/modify/{{$user->id}}/imgProfil" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="photoContent">
                    <div class="img">
                        @if (empty($user->profil_img))
                            <img id="profil" src="{{asset('assets/default_bg.jpg')}}" alt="">
                        @else
                            <img id="profil" src="{{$user->profil_img}}" alt="">
                        @endif
                        <div class="inputContainer">
                            <label for="profilImg">Changer Photo de profil</label>
                            <input name="profilImg" type="file" id="profilImg">
                        </div>
                    </div>

                </div>
                <input type="submit" value="Sauvegarder">
            </form>

            <form action="/modify/{{$user->id}}/wallpaper" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="photoContent">
                    <div class="img">
                        @if (empty($user->profil_background))
                            <img id="bg" src="{{asset('assets/default_bg.jpg')}}" alt="">
                        @else
                            <img id="bg" src="{{$user->profil_background}}" alt="">
                        @endif
                        <div class="inputContainer">
                            <label for="bgImg">Changer Fond d'écran</label>
                            <input name="bgImg" type="file" id="bgImg">
                        </div>
                    </div>
                </div>
                <input type="submit" value="Sauvegarder">
            </form>
        </div>
        {{-- <div class="popUp">
            <div class="popUpContainer">
                <h2>Redimensionner l'image</h2>
                <div class="popUpContent">
                    <div class="uploadImg">
                        <img id="uploadImg">
                    </div>
                    <div class="preview">

                    </div>
                </div>
                <button id="crop">Redimensionner</button>
            </div>
        </div> --}}
    </div>
@endsection


@section('js')
    <script src="{{asset('js/jquery.js')}}"></script>
    {{-- <script src="{{asset('js/cropper.min.js')}}"></script> --}}
    <script src="{{asset('js/img_upload_preview.js')}}"></script>
@endsection
