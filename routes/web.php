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

Route::get('/offre/my-favorites', 'OffreController@myFavorites')->name('offre.indexFavorites');

Route::get('/offre/my-postulations', 'OffreController@myPostulations')->name('offre.indexPostulations');

Route::get('/offre/my-offers', 'OffreController@myOffers')->name('offre.indexOffers');

Route::get('/offre/list', 'OffreController@listAdmin')->name('offre.listAdmin');

Route::get('/offre/listValidation', 'OffreController@listValidationAdmin')->name('offre.listValidation');

Route::get('/offre/validate/{id}', 'OffreController@validation')->name('offre.validate');

Route::get('/offre/archive/{id}', 'OffreController@archiving')->name('offre.archive');

Route::get('/offre/createAdmin', 'OffreController@createAdmin')->name('offre.createAdmin');

Route::post('/offre/storeAdmin', 'OffreController@storeAdmin')->name('offre.storeAdmin');

Route::get('/offre/showAdmin/{id}', 'OffreController@showAdmin')->name('offre.showAdmin');

Route::get('/offre/download/{filename}', 'OffreController@getPDF')->name('profil.getPDF');

Route::resource('offre', 'OffreController');
Route::get('/offre/show/{id}', 'OffreController@show')->name('offre.show');
Route::get('/offre/edit/{id}', 'OffreController@edit')->name('offre.edit');
Route::put('/offre/update/{id}', 'OffreController@update')->name('offre.update');
Route::delete('/offre/delete/{id}', 'OffreController@destroy')->name('offre.destroy');

Route::post('/offre/addFavorite/{idOffre}/{idProfil}', 'OffreController@addFavorite')->name('offre.addFavorite');

Route::post('/offre/removeFavorite/{idOffre}/{idProfil}', 'OffreController@removeFavorite')->name('offre.removeFavorite');

Route::post('/offre/addPostulation/{idOffre}/{idProfil}', 'OffreController@addPostulation')->name('offre.addPostulation');

Route::post('/offre/removePostulation/{idOffre}/{idProfil}', 'OffreController@removePostulation')->name('offre.removePostulation');

Route::resource('message', 'MessageController');

Route::get('/profil/my-profile', 'ProfilController@myProfile')->name('profil.myProfile');
Route::get('/profil/download/{filename}', 'ProfilController@getCV')->name('profil.getCV');
Route::get('/profil/nominate/{id}', 'ProfilController@nominateAdmin')->name('profil.nominate');
Route::get('/profil/remove/{id}', 'ProfilController@removeAdmin')->name('profil.remove');

Route::resource('profil', 'ProfilController');
Route::get('/profil/show/{id}', 'ProfilController@show')->name('profil.show');
Route::get('/profil/edit/{id}', 'ProfilController@edit')->name('profil.edit');
Route::put('/profil/update/{id}', 'ProfilController@update')->name('profil.update');
Route::delete('/profil/delete/{id}', 'ProfilController@destroy')->name('profil.destroy');

Route::resource('categorie', 'CategorieController');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::post('ajaxRequest', 'AjaxController@test')->name('ajaxRequest.test');
Route::get('site-register', 'SiteAuthController@siteRegister');
Route::post('site-register', 'SiteAuthController@siteRegisterPost');

Route::get('change-password', 'ChangePasswordController@index')->name('change.index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
