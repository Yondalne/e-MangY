@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/post.css')}}">
    @livewireStyles
@endsection


@section('aside-content')
    <div class="contentContainer">
        <div class="contentContent">
            <h1>Gestion des Utilisateurs</h1>

            @livewire('users')
        </div>
    </div>
@endsection

@section('js')
    @livewireScripts
    <script src="{{asset('js/jquery.js')}}"></script>
@endsection
