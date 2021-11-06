<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Controller routes
Route::get('/home', [Controller::class, 'home']);
Route::get('/contactUs', [Controller::class, 'contactUs']);

Route::get('/userDashboard', [Controller::class, 'dashboard'])->middleware('auth');
Route::get('/profil', [Controller::class, 'userProfil'])->middleware('auth');
Route::get('/myPosts', [Controller::class, 'userPost'])->middleware("auth");
Route::get('/adminManage', [Controller::class, "adminGestUser"])->middleware("auth");
Route::get('/adminManga', [Controller::class, "adminManga"])->middleware("auth");


// UserController routes
Route::get('/signUp', [UserController::class, 'create']);
Route::post('/inscription', [UserController::class, 'store']);

Route::patch('/modify/{id}/account', [UserController::class, 'updateAccount'])->middleware('auth');
Route::patch('/modify/{id}/perso', [UserController::class, 'updateUserInfo'])->middleware('auth');
Route::patch('/modify/{id}/imgProfil', [UserController::class, 'updateProfilImg'])->middleware('auth');
Route::patch('/modify/{id}/wallpaper', [UserController::class, 'updateWallpaper'])->middleware('auth');


// LoginController route
Route::get('/login', [LoginController::class, "index"])->name('login');
Route::post('/login', [LoginController::class, "login"]);
Route::get('/signOut', [LoginController::class, "logout"])->middleware('auth');


// Article routes
Route::get('/newPost', [ArticleController::class, 'create'])->middleware('auth');
Route::get('/modify/{id}/Post', [ArticleController::class, 'edit'])->middleware('auth');
Route::patch('/updateArticle/{id}', [ArticleController::class, 'update'])->middleware('auth');
Route::post('/createArticle', [ArticleController::class, 'store'])->middleware('auth');


// Mangas routes
Route::get('/mangas', [MangaController::class, 'index']);
Route::post('/manga/category', [MangaController::class, 'mangaByCat']);
Route::get('/manga/{id}/show', [MangaController::class, 'show']);

Route::get('/newManga', [MangaController::class, 'create'])->middleware('auth');
Route::get('/modify/{id}/Manga', [MangaController::class, 'edit'])->middleware('auth');
Route::patch('/updateManga/{id}', [MangaController::class, 'update'])->middleware('auth');
Route::post('/createManga', [MangaController::class, 'store'])->middleware('auth');

// Route::post('/sendMail', [Controller::class, 'sendMail']);
// Route::get('/newCategory', [CategoryController::class, 'store'])->middleware('auth');
