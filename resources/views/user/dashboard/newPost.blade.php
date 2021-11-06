@extends('layout.user.layoutUserDashboard')

@section('link')
    <link rel="stylesheet" href="{{asset('css/user_dashboard/newPost.css')}}">
@endsection


@section('aside-content')
    <div class="contentContainer">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="contentContent">
            <h1>Nouvel Article</h1>

            <form action="/createArticle" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="top">
                    <div class="title">
                        <label for="">Titre :</label>
                        <input id="title" name="title" type="text" placeholder="Entrer le titre de l'article">
                    </div>
                    <div class="cover">
                        <label for="coverImg" id="labelcover">Uploder une photo de couverture</label>
                        <input type="file" name="coverImg" id="coverImg">
                        <img id="coverPreview" src="{{asset('assets/icon/gallery.png')}}" alt="">
                    </div>
                </div>
                <div class="articleContent">
                    <label for="content">Contenu</label>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
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
