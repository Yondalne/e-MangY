@extends('layout.user.layoutUserDashboard')

@section('link')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/user_dashboard/userPost.css')}}">
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
            <h1>Modifier Article</h1>

            <form action="/updateArticle/{{$article->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PATCH")

                <div class="cover">
                    <label for="coverImg" id="labelcover">Uploder une photo de couverture</label>
                    <input type="file" name="cover" id="coverImg">
                    <img id="coverPreview" src="/{{$article->cover}}" alt="">
                </div>

                <div class="title">
                    <div>
                        <label for="">Titre :</label>
                        <input id="title" name="title" type="text" placeholder="Entrer le titre de l'article" value="{{$article->title}}">
                    </div>
                    <div>
                        <a id="popUp">Cliquer pour editer le Contenu</a>
                    </div>
                </div>

                <div style="display: none;">
                    <label style="display: none;" for="content">Synopsis</label>
                    <textarea style="display: none" required name="content" id="content" placeholder="Ecrivez le Contenu ici">{{$article->content}}</textarea>
                </div>

                <div class="popUp">
                    <div id="editor"></div>
                    <a id="getquill">Confirmer</a>
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

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>

        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        var synopsis;
        if ($("#content").text() != ""){
            synopsis = JSON.parse($("#content").text())
            quill.setContents(synopsis);
        }

        $(".popUp").hide();
        $("#popUp").click(()=>{
            $(".popUp").show()
        })

        $("#getquill").click(()=>{
            synopsis = quill.getContents();
            $(".popUp").hide();
            var synBD = JSON.stringify(synopsis);
            $("#content").text(synBD);
        })

        // formElt.onsubmit = ()=>{}
        // alert(window.location.host+"/createManga");

        // formElt.onsubmit = ()=>{
        //     var data = (new FormData(formElt));
        //     var myHeader = new Headers();
        //     const token = $('meta[name="csrf-token"]').attr('content');
        //     // alert(token);
        //     myHeader.append( "X-CSRF-TOKEN", token);
        //     data.append("synopsis", synopsis);
        //     console.log(data);
        //     alert(data);
        //     // alert(data);
        //     // fetch("http://"+window.location.host+"/createManga", {
        //     //     headers: myHeader,
        //     //     method: "POST",
        //     //     body: data,
        //     // }).then((response)=>{
        //     //     console.log(response);
        //     // }).catch(error => {
        //     //     this.errorMessage = error;
        //     //     console.error("There was an error!", error);
        //     //     alert("Test");
        //     // });
        // }

        // console.log(formElt)
        // var form = document.getElementById('formElt')
        // var data = new FormData(form);

        // data.append('title', 'test');
        // console.log(new URLSearchParams(data));
    </script>
@endsection
