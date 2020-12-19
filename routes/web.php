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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'employee',
    'as' => 'employee::',
], function () {
    Route::any('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\HomeController@empIndex']);
    Route::any('/add', ['as' => 'add', 'uses' => 'App\Http\Controllers\HomeController@empAdd']);
    Route::any('/edit/{id}', ['as' => 'edit', 'uses' => 'App\Http\Controllers\HomeController@empEdit']);
    Route::any('/delete/{id}', ['as' => 'delete', 'uses' => 'App\Http\Controllers\HomeController@empDelete']);
});


Route::group([
    'prefix' => 'department',
    'as' => 'department::',
], function () {
    Route::any('/add', ['as' => 'add', 'uses' => 'App\Http\Controllers\DeptController@empAdd']);
    Route::any('/edit/{id}', ['as' => 'edit', 'uses' => 'App\Http\Controllers\DeptController@empEdit']);
    Route::any('/delete/{id}', ['as' => 'delete', 'uses' => 'App\Http\Controllers\DeptController@empDelete']);
});
