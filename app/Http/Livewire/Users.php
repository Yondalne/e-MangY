<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public function banHammer($id)
    {
        $user = User::find($id);
        if($user->isBan == 1) {
            $user->isBan = 0;
        }else {
            $user->isBan = 1;
        }
        $user->save();
    }

    public function render()
    {
        $allUser = User::paginate(10);
        return view('livewire.users', [
            'allUser' => $allUser
        ]);
    }
}
