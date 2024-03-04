<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\OtherprofController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ViewController;
use Illuminate\Routing\Controllers\Middleware;
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
    return view('index');
});
Route::get('/login',[AuthController::class, 'index']);
Route::post('/login',[AuthController::class, 'Ceklogin']);
Route::get('/register',[AuthController::class, 'regi']);
Route::post('/register',[AuthController::class, 'register']);
Route::middleware(['user'])->group(function(){
    // Halam beranda atau index
    Route::get('/explore', function () {
        return view('pages.explore');
    });
    Route::get('/getDataExplore',[ExploreController::class, 'getdata']);    
    Route::post('/likefotos',[ExploreController::class, 'likefoto']);
    
    // halam disukai
    Route::get('/like', function () {
        return view('pages.like');
    });
    Route::get('/getDataLike',[ExploreController::class, 'getDataLike']); 
    
    // halam detail foto dan komentar
    Route::get('/explore-detail/{id}', function () {
        return view('pages.exploredetail');
    });
    Route::get('/explore-detail/{id}/getdatadetail', [ExploreController::class, 'getdatadetail']);
    Route::get('/explore-detail/getComment/{id}',[ExploreController::class, 'ambilDataKomentar']);
    Route::post('/explore-detail/kirimkomentar', [ExploreController::class, 'kirimkomentar']);
    Route::get('/getDataDetailExplore',[ExploreController::class, 'getDetaildata']);

    // halam upload album dan foto
    Route::get('/upload',[UploadController::class, 'uploadf']);
    Route::post('/upalbum',[UploadController::class, 'upalbum']);
    Route::post('/upfoto',[UploadController::class, 'save']);    

    // halam profil publik orang lain
    Route::get('/other-profile/{id}', function () {
        return view('pages.otherprofil');
    });
    Route::get('/other-profile/getDataOtherprof/{id}',[OtherprofController::class, 'getOtherprof']);
    Route::get('/getDataOtherProfileExplore',[OtherprofController::class, 'getdata']);

    // halam profil publik orng lain bagian album
    Route::get('/other-album/{id}', function () {
        return view('pages.otheralbum');
    Route::get('/other-album/getDataOtherprof/{id}',[OtherprofController::class, 'getOtherprofalbum']);
    });

    // halam profile user dan cange password
    Route::get('/profile', function () {
        return view('pages.profil');
    });
    Route::get('/profil/getDataprof',[ProfilController::class, 'getDataprofil']);
    Route::get('/getDataProfileExplore',[ProfilController::class, 'getdata']);
    // Route::post('/Deletefotos',[ProfilController::class, 'deletefoto']);
    Route::get('/ubah-profile', [ProfilController::class, 'ubprof']);
    Route::post('/upgambar',[ProfilController::class, 'upfoto']);
    Route::post('/upprofil',[ProfilController::class, 'updataprof']);
    Route::get('/ubah-password', [ProfilController::class, 'ubpass']);
    Route::post('/updapass',[ProfilController::class, 'updatapassword']);

    // halam profil album
    Route::get('/album', function () {
        return view('pages.album');
    });
    Route::get('/album/getDataAlbumprof',[ProfilController::class, 'getDatapAlbumprofil']);
    Route::get('/getDataProfileAlbumExplore',[ProfilController::class, 'getdataalbum']);

    Route::get('/logout',[AuthController::class, 'logout']);
});
