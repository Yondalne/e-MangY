<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Articles extends Component
{

    use WithPagination;

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $img = $article->cover;
        $article->delete();
        unlink(public_path($img));
    }

    public function render()
    {
        if (auth()->user()->admin == 1) {
            $articles = Article::paginate(6);
        }else {
            $articles = Article::where('user_id', "=", auth()->user()->id)->paginate(6);
        }
        return view('livewire.articles', [
            'articles' => $articles
        ]);
    }
}
