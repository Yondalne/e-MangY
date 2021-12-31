@extends('layout.user.layoutUserDashboard')

@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <h1>Nouveau Manga</h1>

            <form action="/createManga" method="POST" enctype="multipart/form-data" id="formElt">
                @csrf
                @method("POST")
                <div class="top">
                    <div class="title">
                        <label for="title">Titre :</label>
                        <input required id="title" name="title" type="text" placeholder="Entrer le titre du manga">
                    </div>
                    <div class="cover">
                        <label for="coverImg" id="labelcover">Uploder une image</label>
                        <input type="file" name="img" id="coverImg" required>
                        <img id="coverPreview" src="{{asset('assets/icon/gallery.png')}}" alt="">
                    </div>
                </div>

                <div class="categoriesOptions">
                    <h4>Attribuer une / des categories:</h4>
                    <div class="categoryOption">
                        @foreach ($categories as $category)
                            <div class="categoryOpt">
                                <input id="{{$category->label}}" type="checkbox" name="category[]" value="{{$category->id}}">
                                <label for="{{$category->label}}">{{$category->label}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="articleContent">
                    <label for="content">Synopsis</label>
                    <textarea required name="synopsis" id="content" placeholder="Ecrivez le Synopsis ici"></textarea>
                </div>

                <div class="title" style="width: 90%; justify-content: flex-start; margin-top:20px;">
                    <label style="font-size: 16px" for="link">Lien de lecture :</label>
                    <input style="height: 40px; font-size: 16px; width: 500px; margin-left: 20px" required id="link" name="link" type="text" placeholder="Entrer le lien vers un site où on peut lire le manga">
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
            const [file] = coverImg.files;
            if (file) {
                coverPreview.src = URL.createObjectURL(file);
                $('#labelcover').text("Changer d'image");
            }
        }
    </script>
@endsection
