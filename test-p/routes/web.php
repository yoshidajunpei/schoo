<?php

use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Webルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのWebルートを登録できます。"web"ルートは
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/tweets',[TweetController::class,'index']);
// Route::get('/tweets/create',[TweetController::class,'create']);
// Route::post('/tweets',[TweetController::class,'store']);
// Route::get('/tweets/{id}',[TweetController::class,'show']);
// Route::get('/tweets/{id}/edit',[TweetController::class,'edit']);
// Route::put('tweets/{id}',[TweetController::class,'update']);
// Route::delete('tweets/{id}',[TweetController::class,'destroy']);

Route::resource('/tweets',TweetController::class);
