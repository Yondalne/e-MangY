<div class="navBar">

    <div class="logo">
        <a href="/"><img src="{{asset('assets/LogoAdmin.png')}}" alt=""></a>
    </div>

    <nav>
        <div><a href="/">Acceuil</a></div>
        <div><a href="/mangas">Mangas</a></div>
        <div><a href="/contactUs">Nous Contacter</a></div>
        @if (!empty($user))
            <div class="user">
                <div>
                    @if (empty($user->profil_img))
                        <img src="{{asset('assets/icon/user.png')}}" alt="">
                    @else
                        <img src="{{asset("$user->profil_img")}}" alt="">
                    @endif
                </div>
                <h2><a href="/userDashboard">{{$user->pseudo}}</a></h2>
            </div>
        @else
            <div class="log">
                <div><a href="/login">Se Connecter</a></div>
                <div><a href="/signUp">S'inscrire</a></div>
            </div>
        @endif
    </nav>

</div>
