<?php

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

Route::get('login', 'AuthController@loginShow')->name('login');

Route::post('/home/login/do', 'AuthController@login')->name('home.login.do');

Route::get('/home/logout', 'AuthController@logout')->name('home.logout');

Route::get('/cadastro', 'UserController@create')->name('sistemas.cadastro');

Route::post('/cadastro/do', 'UserController@store')->name('sistemas.store.do');

Route::get('/', 'AuthController@home')->name('home');

Route::get('/home', 'AuthController@home')->name('home');



Route::middleware('auth')->group(function(){
 
        Route::prefix('home')->group(function () {

            Route::post('/sistema', 'SistemasController@store')->name('sistemas.store');
            Route::post('/sistema/{id}', 'SistemasController@update')->name('sistemas.update');


            Route::get('/lista', 'SistemasController@index')->name('sistemas.index');
            Route::get('/novo', 'SistemasController@create')->name('sistemas.create');
            Route::get('/editar/{id}', 'SistemasController@edit')->name('sistemas.edit');
            Route::get('/buscar/{page?}', 'SistemasController@search')->name('sistemas.search');
            Route::get('/sistema/mensagem', function () {    return view('includes.sistema_mensagem');})->name('sistemas.mensagem');

    });
});
