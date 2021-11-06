<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/user_pages/sign.css')}}">
    @yield('link')
    <title>e-MangY | {{$pageTitle}}</title>
</head>
<body>
    <div class="superContainer">
        <div class="circle"></div>
        <div class="formContainer">

            <div class="formContent">
                <a href="/"><img src="{{asset('assets/icon/maison.png')}}" alt=""></a>

                <div class="title">
                    <h2>{{$pageTitle}}</h2>
                </div>
                @yield('form')
            </div>
        </div>
    </div>
</body>
</html>
