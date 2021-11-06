<div class="allPost">
    <div class="articlesLayout">
        @foreach ($articles as $article)
            <div class="article">
                <img src="{{$article->cover}}" alt="">
                <h4>{{$article->title}}</h2>
                <div class="articleButton">
                    <div><a href="/modify/{{$article->id}}/Post">Voire</a></div>
                    <div wire:click="deleteArticle({{$article->id}})" wire:click="$refresh"><a href="">Supprimer</a></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="articlesLinks">
        {{$articles->links('components.user.dashboard.pagination')}}
    </div>
</div>
