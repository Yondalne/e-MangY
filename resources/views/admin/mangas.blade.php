@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/post.css')}}">
    @livewireStyles
@endsection


@section('aside-content')
    <div class="contentContainer">
        <div class="contentContent">
            <h1>Mangas</h1>
            <div class="addNew">
                <button id="addNew" href="myPosts">+</button>
                <label for="addNew">Ajouter un Manga</label>
                <div></div>
            </div>
            @livewire('mangas')
        </div>
    </div>
@endsection

@section('js')
    @livewireScripts
    <script src="{{asset('js/jquery.js')}}"></script>

    <script>
        $('.addNew div').click(()=>{
            window.location.replace("http://"+window.location.host+"/newManga");
        })
    </script>
@endsection
