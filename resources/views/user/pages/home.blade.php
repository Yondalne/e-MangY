@extends('layout.user.layoutMain')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_pages/home.css')}}">
@endsection

@section('content')
    <div class="recent">
        <h2>Actualités</h2>
        <div class="allPost">
            <?php
                $count = 0
            ?>
            @foreach ($news as $adminPost)
                @if ($count >= 3)
                    @break
                @endif
                <div class="Post">
                    <img src="{{$adminPost->cover}}" alt="">
                    <div class="postContent">
                        <div class="title">
                            <h2>{{$adminPost->title}}</h2>
                        </div>
                        <div class="resume">
                            <div class="contentResume">{{$adminPost->content}}</div>
                            <div class="link"><a href="#">Lire</a></div>
                        </div>
                    </div>
                </div>
                <?php
                    $count++
                ?>
            @endforeach
        </div>
    </div>

    <div class="recent">
        <h2>Discussions Hot</h2>
        <div class="allPost">
            <?php
                $count = 0
            ?>
            @foreach ($hot as $hotPost)
                @if ($hotPost->user->admin == 1)
                    @continue
                @endif

                @if ($count >= 3)
                    @break
                @endif
                <div class="Post">
                    <img src="{{$hotPost->cover}}" alt="">
                    <div class="postContent">
                        <div class="title">
                            <h2>{{$hotPost->title}}</h2>
                        </div>
                        <div class="resume">
                            <div class="contentResume">{{$hotPost->content}}</div>
                            <div class="link"><a href="#">Lire</a></div>
                        </div>
                    </div>
                </div>
                <?php
                    $count++
                ?>
            @endforeach
        </div>
    </div>
@endsection
