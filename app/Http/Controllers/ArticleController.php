<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create()
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/home')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        return view('user.dashboard.newPost')->with(['pageTitle' => 'Dashboard - New Post','user' => auth()->user()]);
    }

    public function store(Request $request)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/home')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = auth()->user();
        $this->validate($request, [
            "title" => "required",
            "content" => "required",
            "coverImg" => "required|mimes:png,jpg,jpeg",
        ]);

        if($request->file()){
            $extension = $request->file('coverImg')->getClientOriginalExtension();
            $name = "article".uniqid().".".$extension;
            $pathCover = "storage/".$request->file('coverImg')->storeAs('images/'.$user->id."/article", $name, "public");
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'cover' => $pathCover,
            'user_id' => $user->id
        ]);

        return redirect('/myPosts');
    }

    public function edit($id)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/home')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        return view('user.dashboard.modifyPost')->with([
            'pageTitle' => 'Dashboard - Modify Article',
            'user' => auth()->user(),
            'article' => Article::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/home')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = auth()->user();
        $article = Article::find($id);
        $this->validate($request, [
            'coverImg' => 'mimes:png,jpg,jpeg',
        ]);

        if($request->file()){
            unlink($article->cover);
            $extension = $request->file('coverImg')->getClientOriginalExtension();
            $name = "article".uniqid().".".$extension;
            $pathCover = "storage/".$request->file('coverImg')->storeAs('images/'.$user->id."/article", $name, "public");
        }

        $article->cover = $pathCover;

        if(!empty($request->title)){
            $article->title = $request->title;
        }

        if(!empty($request->content)){
            $article->content = $request->content;
        }

        $article->save();
        return redirect('/myPosts');
    }
}
