@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/home.css')}}">
@endsection

@section('aside-content')
    <div class="message">
        <h2>Welcome</h2>
        <h1>{{$user->pseudo}}-san !</h1>
    </div>
@endsection
