@extends('layout.user.layoutMain')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/manga.css')}}">
@endsection

@section('content')
    <div class="manga">
        <div class="currentManga">
            <div class="photo">
                <img src="/{{$manga->img}}" alt="">
            </div>
            <div class="synopsis">
                <h2>{{$manga->title}}</h2>
                <div class="textSyn">
                    <h4>Synopsis :</h4>
                    <p>{{$manga->synopsis}}</p>
                </div>

                <div class="categoriesOptions">
                    <h4>Categories: </h4>
                    @foreach ($categories as $category)
                        <div class="categoryOption">
                            <span>{{$category->label}}</span>
                        </div>
                    @endforeach
                </div>

                <div class="link">
                    <a href="{{$manga->link}}" target="_blank">Lire ici via ce super lien uwu</a>
                </div>
            </div>
        </div>

        <ul class="listManga">
            <h4 style="">Tous les mangas</h4>
            @foreach ($allMangas as $elt)
                <li><a href="/manga/{{$elt->id}}/show">{{$elt->title}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
