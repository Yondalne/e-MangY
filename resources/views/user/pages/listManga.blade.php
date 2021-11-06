@extends('layout.user.layoutMain')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/listManga.css')}}">
@endsection

@section('content')
    <div class="recent">
        <h2>Mangas</h2>
        <form action="/manga/category" method="POST">
            @csrf
            <h4>Selectionner une categorie : </h4>
            <select name="select" id="select">
                <option value="0">Tous les mangas</option>
                @if (isset($option))
                    @foreach ($categories as $category)
                        @if ($option == $category->id)
                            <option value="{{$category->id}}" selected>{{$category->label}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->label}}</option>
                        @endif
                    @endforeach
                @else
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->label}}</option>
                    @endforeach
                @endif
            </select>
            <input type="submit" value="Trier">
        </form>
        <div class="allPost">
            @foreach ($allMangas as $manga)
                <div class="Post">
                    <img src="/{{$manga->img}}" alt="">
                    <div class="postContent">
                        <div class="title">
                            <a href="/manga/{{$manga->id}}/show">{{$manga->title}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
