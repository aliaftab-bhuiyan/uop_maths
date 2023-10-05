<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuestionController::class, 'feed'])->name('feed');

Route::controller(UserController::class)->group(function () {
    Route::get('/auth/signup','signup')->name('signup');
    Route::post('/auth/register','register')->name('register');
    Route::get('/auth/signin', 'signin')->name('login');
    Route::post('/auth/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
Route::controller(QuestionController::class)->group(function (){
    Route::get('/show/question/{slug}', 'detail_question')->name('detail_question');
    Route::get('/ask/question','ask_question')->name('ask_question');
    Route::post('/ask/question/store','store_question')->name('store_question');
    Route::get('/show/questions','show_question')->name('show_question');
});
