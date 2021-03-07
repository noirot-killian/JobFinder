<?php

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

Route::get('/', function () {
    return view('template');
});

Route::resource('offre', 'OffreController');
Route::get('/offre/show/{id}', 'OffreController@show')->name('offre.show');
Route::resource('message', 'MessageController');
Route::resource('profil', 'ProfilController');
Route::resource('categorie', 'CategorieController');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
