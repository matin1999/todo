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
    return view('welcome');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('register', 'AuthController@showRegister');
    Route::post('register', 'AuthController@register')->name('register');

    Route::get('login', 'AuthController@showLogin')->name('login');
    Route::post('login', 'AuthController@login')->name('loginpost');

    Route::get('logout', 'AuthController@logout')->name('logout');

});

Route::group([
    'middleware' => 'auth'
], function () {
    Route::resource('tasks', 'TaskController');
    Route::get('tasks/{task}/delete', 'TaskController@delete')->name('tasks.delete');
});

Route::resource('tasks.notes', 'NoteController')->only(['store', 'destroy']);

Route::post('task/{task}/notes/{note}/restore', 'NoteActionController@restore')
    ->name('tasks.notes.restore');
Route::delete('task/{task}/notes/{note}/terminate', 'NoteActionController@terminate')
    ->name('tasks.notes.terminate');

Route::post('tasks/{task}/done', 'DoneTskController')->name('tasks.done');

