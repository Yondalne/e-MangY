<div class="navBar">
    <div class="user">
        <div>
            @if (empty($user->profil_img))
                <img src="{{asset('assets/icon/user.png')}}" alt="">
            @else
                <img src="{{asset("$user->profil_img")}}" alt="">
            @endif
        </div>
        <h2>{{$user->pseudo}}</h2>
    </div>

    <nav>

        <div><a href="/myPosts">Articles</a></div>
        @if ($user->admin == 1)
            <div><a href="/adminManga">Mangas</a></div>
            <div><a href="/adminManage">Utilisateurs</a></div>
        @endif
        <div><a href="/profil">Modifier Profil</a></div>
        <div><a href="/home">Revenir sur le site</a></div>
        <div><a href="/signOut">Deconnexion</a></div>
    </nav>

    <div class="logo">
        <a href="/home"><img src="{{asset('assets/LogoAdmin.png')}}" alt=""></a>
    </div>
</div>
