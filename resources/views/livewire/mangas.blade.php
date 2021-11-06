<div class="allPost">
    <div class="articlesLayout">
        @foreach ($mangas as $manga)
            <div class="article">
                <img src="{{$manga->img}}" alt="">
                <h4>{{$manga->title}}</h2>
                <div class="articleButton">
                    <div><a href="/modify/{{$manga->id}}/Manga">Voire</a></div>
                    <div wire:click="deleteManga({{$manga->id}})" wire:click="$refresh"><a href="">Supprimer</a></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="articlesLinks">
        {{$mangas->links('components.user.dashboard.pagination')}}
    </div>
</div>
