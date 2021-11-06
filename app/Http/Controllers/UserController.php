<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.pages.signUp')->with('pageTitle', 'Inscription');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'secondN' => 'required',
            'email'=> 'required|email',
            'dateN' => 'required|date',
            'pseudo' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'second_name' => $request->secondN,
            'mail' => $request->email,
            'date_nais' => $request->dateN,
            'pseudo' => $request->pseudo,
            'password' => Hash::make($request->password),
            'admin' => 0
        ]);

        Auth::attempt(['mail' =>  $request->email, 'password' => $request->password]);

        return redirect('userDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // update account informations
    public function updateAccount(Request $request, $id)
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = User::find($id);

        // Verify if user modify pseudo
        if (!empty($request->pseudo)){
            $user->pseudo = $request->pseudo;
        }

        // Verify if user modify password
        if(!empty($request->new_password) && (Hash::make($request->password) == auth()->user()->password)){
            $this->validate($request,[
                'new_password' => 'min:6',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with("status", 1);

    }

    // update user informations
    public function updateUserInfo(Request $request, $id)
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = User::find($id);

        // Verify if user modify email
        if (!empty($request->email)){
            $this->validate($request,[
                'email' => 'email',
            ]);
            $user->mail = $request->email;
        }

        // Verify if user modify name
        if (!empty($request->name)){
            $user->name = $request->name;
        }

        // Verify if user modify second name
        if (!empty($request->secondN)){
            $user->second_name = $request->secondN;
        }

        $user->save();

        return back()->with("status", 1);

    }

    // update profil img
    public function updateProfilImg(Request $request, $id)
    {

        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = User::find($id);

        // Upload profil image
        if ($request->file()){
            $this->validate($request,[
                'profilImg' => 'mimes:png,jpg,jpeg,gif',
            ]);

            if (!empty($user->profil_img)){
                unlink(public_path($user->profil_img)); // suprrime l'ancienne photo si elle existe
            }

            $name = "mangy_profil_".$request->profilImg->getClientOriginalName(); // recupere le nom de l'image

            $img_path = $request->file('profilImg')->storeAs('images/'.$user->id, $name,'public');
            $user->profil_img = 'storage/'.$img_path;

        }


        // $image = $request->image;

        // // Recuperation de l'extension de l'image

        // // De base la valeur contenue dans la variable a pour type "data:{type de fichier}/{extension};base64,valeur_encode"
        // $image = str_replace("data:image/", "", $image);    // Donc pour recuperer l'extension il faut supprimer "data:{type de fichier}/" puis eclater la chaine a partir a partir de " ; "
        // $image2 = explode(";", $image);
        // $imageExtension = ".".$image2[0];   // La premiere valeur du tableau obtenue est l'extension

        // $image = str_replace(' ', '+', $image);
        // $name = "mangy_profil_test".$imageExtension;
        // // $image = base64_decode($image);
        // $img_path = Storage::put('images/'.$user->id."/".$name, base64_decode($image), "public");

        // // $image = base64_decode($request->image);

        // // if(!empty($request->image)){
        // //     if (!empty($user->profil_img)){
        // //         unlink(public_path($user->profil_img));
        // //     }

        // //     $name = "mangy_profil_test.jpg";

        // //     $img_path = Storage::putFileAs('images/'.$user->id, $image, $name, "public");

        // //     $user->profil_img = 'storage/'.$img_path;
        // // }

        $user->save();
        return back()->with("status", 1);
        // return response()->json([
        //     "message" => "upload success",
        //     "image" => $request->image,
        //     "test" => $imageExtension
        // ]);

    }

    // update wallpaper
    public function updateWallpaper(Request $request, $id)
    {
        if(auth()->user()->isBan == 1) {
            return redirect('/')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        $user = User::find($id);

        // Upload dashboard wallpaper
        if (!empty($request->bgImg)){
            $this->validate($request,[
                'bgImg' => 'mimes:png,jpg,jpeg,gif|max:10240'
            ]);

            if (!empty($user->profil_background)){
                unlink(public_path($user->profil_background));
            }

            $fileName = "mangy_wallpaper_".$request->bgImg->getClientOriginalName();
            $profil_img_path = $request->bgImg->storeAs('images/'.$user->id, $fileName, 'public');
            $user->profil_background = 'storage/'.$profil_img_path;

        }

        $user->save();
        return back()->with("status", 1);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
