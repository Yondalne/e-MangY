@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/newPost.css')}}">
@endsection


@section('aside-content')
    <div class="contentContainer">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $key => $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="contentContent">
            <h1>Modifier Manga</h1>

            <form action="/updateManga/{{$manga->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="top">
                    <div class="title">
                        <label for="">Titre :</label>
                        <input id="title" name="title" type="text" placeholder="Entrer le titre du manga" value="{{$manga->title}}">
                    </div>
                    <div class="cover">
                        <label for="coverImg" id="labelcover">Uploder une nouvelle image</label>
                        <input type="file" name="img" id="coverImg">
                        <img id="coverPreview" src="/{{$manga->img}}" alt="">
                    </div>
                </div>
                <div class="categoriesOptions">
                    <h4>Modifier les categories:</h4>
                    @foreach ($categories as $category)
                        <div class="categoryOption">
                            {{$verify = false}}
                            {{-- Il y un bug qui fait apparaitre un chiffre a cote des input checked --}}
                            @foreach ($category->mangas as $mangaCategory)
                                @if ($mangaCategory->id === $manga->id)
                                    {{$verify = true}}
                                @endif
                            @endforeach

                            @if ($verify)
                                <input id="{{$category->label}}" type="checkbox" name="category[]" value="{{$category->id}}" checked>
                            @else
                                <input id="{{$category->label}}" type="checkbox" name="category[]" value="{{$category->id}}">
                            @endif
                            <label for="{{$category->label}}">{{$category->label}}</label>
                        </div>
                    @endforeach
                </div>

                <div class="articleContent">
                    <label for="content">Synopsis</label>
                    <textarea name="synopsis" id="content" cols="30" rows="10">{{$manga->synopsis}}</textarea>
                </div>
                <div class="title" style="width: 90%; justify-content: flex-start; margin-top:20px;">
                    <label style="font-size: 16px" for="link">Lien de lecture :</label>
                    <input style="height: 40px; font-size: 16px; width: 500px; margin-left: 20px" required id="link" name="link" type="text" placeholder="Entrer le titre du manga" value="{{$manga->link}}">
                </div>

                <input type="submit" value="Publier">
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script>
        coverImg.onchange = evt => {
            const [file] = coverImg.files
            if (file) {
                coverPreview.src = URL.createObjectURL(file)
                $('#labelcover').text("Changer d'image")
            }
        }
    </script>
@endsection
