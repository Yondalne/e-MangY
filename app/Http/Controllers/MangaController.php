<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        return view('user.pages.listManga')->with([
            'pageTitle' => 'Mangas',
            'allMangas' => Manga::paginate(15),
            'categories' => Category::all(),
            'user' => auth()->user()
        ]);
    }

    public function mangaByCat(Request $request)
    {
        if($request->select == 0){
            return redirect('/mangas');
        }

        $category = Category::find($request->select);

        return view('user.pages.listManga')->with([
            'pageTitle' => 'Mangas',
            'allMangas' => $category->mangas,
            'categories' => Category::all(),
            'option' => $category->id,
            'user' => auth()->user()
        ]);
    }

    public function show($id)
    {
        $manga = Manga::find($id);
        if (empty($manga)){
            return back();
        }

        return view('user.pages.manga')->with([
            'pageTitle' => 'Manga - '.$manga->title,
            'manga' => $manga,
            'allMangas' => Manga::all(),
            'categories' => $manga->categories,
            'user' => auth()->user()
        ]);
    }

    public function create()
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }

        return view('admin.newMangas')->with([
            'pageTitle' => 'Dashboard - New Manga',
            'categories' => Category::all(),
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }
        // dd($request->category);
        $this->validate($request, [
            "title" => "required",
            // "synopsis" => "required",
            "category" => "required",
            "link" => "required",
            "img" => "required|mimes:png,jpg,jpeg",
        ]);

        foreach($request->category as $key => $categoryId){
            if (!Category::find($categoryId)){
                return back()->withErrors(['invalid' => "Une categorie selectionnee n'existe pas, Mais monsieur/madame veuillez cesser de jouer avec l'outil de developpeur meme si c'est fun è_é"]);
            }
        }

        if($request->file()){
            $extension = $request->file('img')->getClientOriginalExtension();
            $name = "manga".uniqid().".".$extension;
            $pathCover = "storage/".$request->file('img')->storeAs('images/manga', $name, "public");
        }

        $manga = Manga::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'img' => $pathCover,
            'link' => $request->link,
        ]);

        foreach($request->category as $key => $categoryId){
            $manga->categories()->attach($categoryId);
        }

        return redirect("/adminManga");
    }

    public function edit($id)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }

        return view('admin.modifyManga')->with([
            'pageTitle' => 'Dashboard - Modify Manga',
            'user' => auth()->user(),
            'categories' => Category::all(),
            'manga' => Manga::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }

        $manga = Manga::find($id);
        $this->validate($request, [
            'img' => 'mimes:png,jpg,jpeg',
        ]);

        if($request->file()){
            unlink($manga->img);
            $extension = $request->file('img')->getClientOriginalExtension();
            $name = "article".uniqid().".".$extension;
            $pathCover = "storage/".$request->file('img')->storeAs('images/manga', $name, "public");

            $manga->img = $pathCover;
        }

        if(!empty($request->title)){
            $manga->title = $request->title;
        }

        if(!empty($request->synopsis)){
            $manga->synopsis = $request->synopsis;
        }

        if(!empty($request->link)){
            $manga->link = $request->link;
        }

        if(!empty($request->category)){
            // Verifie si les id envoye par le formulaire existent dans la bd
            foreach($request->category as $key => $categoryId){
                if (!Category::find($categoryId)){
                    return back()->withErrors(['invalid' => "Une categorie selectionnee n'existe pas, Mais monsieur/madame veuillez cesser de jouer avec l'outil de developpeur meme si c'est fun è_é"]);
                }
            }

            // Dans le but d'eviter la redondance On retire toutes les categories du manga pour ensuite attribuer celle dans la requetes
            $manga->categories()->detach();
            // $manga->save();

            // Attribution des categories selectionnees au manga
            foreach($request->category as $key => $categoryId){
                $manga->categories()->attach($categoryId);
            }
        }

        $manga->save();
        return redirect('/adminManga');
    }
}
