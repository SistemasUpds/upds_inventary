<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/area/create', ['uses' => 'AreaController@create']);
    Route::post('/area',['uses' => 'AreaController@store']);
    Route::get('/area/{id}/edit', ['uses' => 'AreaController@edit']);
    Route::post('/area/{id}/edit', ['uses' => 'AreaController@update']);
    Route::delete('/area/{id}', ['uses' => 'AreaController@destroy']);
    Route::get('/area/{id}/show', ['uses' => 'AreaController@show']);
    //Route::get('/item', 'ItemController@index');
    Route::get('/item/create/{id}', ['uses' => 'ItemController@create']);
    Route::post('/item', ['uses' => 'ItemController@store']);
    Route::get('/item/{id}/edit', ['uses' => 'ItemController@edit']);
    Route::post('/item/{id}/edit', ['uses' => 'ItemController@update']);
    Route::post('/item/{id}/delete', ['uses' => 'ItemController@destroy']);
    Route::get('/item/{id}/show', ['uses' => 'ItemController@show']);
    Route::get('/item/{id}/history', ['uses' => 'ItemController@history']);
    Route::post('area/{id}/qr', ['uses' => 'QrController@show']);
    Route::post('area/{id}/qr/create', ['uses' => 'QrController@create']);
    Route::get('/qrcode/{id}', ['uses' => 'QrController@show'])->name('qrcode.show');
    Route::post('/printQR', ['uses' => 'ItemController@printQR']);
    Route::get('/printPdf/{id}', ['uses' => 'ItemController@printPDf']);
    Route::get('/generar-pdf', ['uses' => 'AreaController@generarPDF']);
    ///Usuarios
    Route::get('/users', ['uses' => 'UsersController@index']);
    Route::get('/users/create', ['uses' => 'UsersController@create']);
    Route::post('/users', ['uses' => 'UsersController@store']);
    Route::get('/users/{id}/edit', ['uses' => 'UsersController@edit']);
    Route::post('/users/{id}/edit', ['uses' => 'UsersController@update']);
    Route::delete('/users/{id}/delete', ['uses' => 'UsersController@destroy']);
    Route::get('/users/{id}/show', ['uses' => 'UsersController@show']);
    ///Sin permiso
    Route::get('/error', ['uses' => 'HomeController@sinPermiso']);
    // Contraseña
    Route::get('/password/{id}/reset', ['uses' => 'UsersController@viewResetPassword']);
    Route::post('/password/{id}/reset', ['uses' => 'UsersController@resetPassword']);
    
    Route::get('/obtener-activos-por-tipo/{tipoId}', 'ItemController@obtenerActivosPorTipo');

});

Route::get('/vistaQR/{id}', ['uses' => 'ItemController@vistaQR']);
