@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/post.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @livewireStyles
@endsection


@section('aside-content')
    {{-- {{dd($user->articles)}} --}}
    <div class="contentContainer">
        <div class="contentContent">
            <h1>Mes Posts</h1>
            <div class="addNew">
                <button id="addNew" href="myPosts">+</button>
                <label for="addNew">Ajouter un Article</label>
                <div></div>
            </div>

            @livewire('articles')

            {{-- <div class="allPost">
                <div class="articlesLayout">
                    @foreach ($articles as $article)
                        <div class="article">
                            <img src="{{$article->cover}}" alt="">
                            <h4>{{$article->title}}</h2>
                            <div class="articleButton">
                                <div><a href="">Modifier</a></div>
                                <div><a href="">Supprimer</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="articlesLinks">
                    {{$articles->links('components.user.dashboard.pagination')}}
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/jquery.js')}}"></script>

    <script>
        $('.addNew div').click(()=>{
            window.location.replace("http://"+window.location.host+"/newPost");
        })
    </script>
    @livewireScripts
@endsection
