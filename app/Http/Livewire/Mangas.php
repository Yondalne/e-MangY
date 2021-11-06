<?php

namespace App\Http\Livewire;

use App\Models\Manga;
use Livewire\Component;
use Livewire\WithPagination;

class Mangas extends Component
{
    use WithPagination;

    public function deleteManga($id)
    {
        $manga = Manga::find($id);
        $img = $manga->img;
        $manga->delete();
        unlink(public_path($img));
    }

    public function render()
    {
        return view('livewire.mangas', [
            'mangas' => Manga::paginate(6)
        ]);
    }
}
