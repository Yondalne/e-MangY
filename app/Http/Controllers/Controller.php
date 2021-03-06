<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        // dd(auth()->user());
        $admin = User::where("admin", "=", 1)->first();
        // dd($admin->articles);
        return view('user.pages.home')->with([
            'pageTitle' => 'Home',
            'user'=> auth()->user(),
            'news'=> $admin->articles,
            'hot' => Article::all()
        ]);
    }

    public function contactUs()
    {
        return view('user.pages.contact')->with(['pageTitle' => 'Contact', 'user'=> auth()->user()]);
    }

    public function dashboard()
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }
        // dd(auth()->user()->articles());
        return view('user.dashboard.home')->with(['pageTitle' => 'Dashboard - Home', 'user'=> auth()->user()]);
    }

    public function userProfil()
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }
        return view('user.dashboard.profil')->with(['pageTitle' => 'Dashboard - Profil', 'user'=> auth()->user()]);
    }

    public function userPost()
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }
        // if(auth()->user()->admin == 1){
        //     $articles = Article::paginate(6);
        // }else {
        //     $articles = Article::where('user_id', "=", auth()->user()->id)->paginate(6);
        // }
        return view('user.dashboard.post')->with([
            'pageTitle' => 'Dashboard - My Posts',
            'user' => auth()->user(),
            // 'articles' => $articles
        ]);
    }

    public function adminGestUser()
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }

        return view('admin.userGest')->with([
            'pageTitle' => 'Dashboard - Manage User',
            'user' => auth()->user(),
            'allUsers' => User::paginate(10),
        ]);
    }

    public function adminManga()
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        if(auth()->user()->admin != 1){
            return back();
        }

        return view('admin.mangas')->with([
            'pageTitle' => 'Dashboard - Mangas',
            'user' => auth()->user(),
        ]);
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'sender' => 'required|email',
            'text' => 'required',
        ]);

        // dd(auth()->user());

        $data = [
            'subject' => "contact admin",
            'name' => "Members",
            'email' => $request->sender,
            'content' => $request->text
        ];

        Mail::to("yondaineman@gmail.com")->send(new Contact($data));
        return back()->withErrors(["message" => "Your Mail has been sent ! Thanks you"]);
    }
}
