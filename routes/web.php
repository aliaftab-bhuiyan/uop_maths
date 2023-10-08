<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuestionController::class, 'feed'])->name('feed');

Route::controller(UserController::class)->group(function () {
    Route::get('/auth/signup','signup')->name('signup');
    Route::post('/auth/register','register')->name('register');
    Route::get('/auth/login', 'signin')->name('login');
    Route::post('/auth/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
Route::controller(QuestionController::class)->group(function (){
    Route::get('/question/{slug}', 'detail_question')->name('detail_question');
    Route::put('/question/edit/{slug}', 'edit_question')->name('edit_question');
    Route::get('/question/{slug}/update', 'update_question')->name('update_question');
    Route::get('/ask/question','ask_question')->name('ask_question');
    Route::post('/ask/question/store','store_question')->name('store_question');
    Route::get('/my/questions','show_question')->name('show_question');
    Route::get('/my/questions/draft', 'draft_question')->name('draft_question');
    ROute::get('/question/keyword/{name}', 'find_by_keyword_feed')->name('find_by_keyword_feed');
    Route::get('/question/delete/{id}', 'destroy_question')->name('destroy_question');
});
Route::controller(SolutionController::class)->group(function (){
    Route::post('/question/{id}/solution', 'store_solution')->name('store_solution');
});
Route::controller(LikeController::class)->group(function (){
    Route::post('/question/{id}/like', 'like')->name('question_like');
    Route::delete('/question/{id}/unlike', 'unlike')->name('question_unlike');
});

