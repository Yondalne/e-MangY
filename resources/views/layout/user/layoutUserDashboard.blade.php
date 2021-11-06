<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/user_dashboard/nav.css')}}">
    @yield('link')
    <title>e-MangY | {{$pageTitle}}</title>
</head>
<body>

    <div class="superContainer">
        @include('components.user.dashboard.navbar')

        <div class="aside">
            <div class="bgImg">
                @if (empty($user->profil_background))
                    <img src="{{asset('assets/default_bg.jpg')}}" alt="">
                @else
                    <img src="/{{$user->profil_background}}" alt="">
                @endif
            </div>
            <div class="content">
                @yield('aside-content')
            </div>
        </div>
    </div>

    @yield('js')
</body>
</html>
