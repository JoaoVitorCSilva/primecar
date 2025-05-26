<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('clientes', App\Http\Controllers\ClienteController::class);
    Route::resource('veiculo', App\Http\Controllers\VeiculoController::class);
    Route::resource('catalogo', App\Http\Controllers\CatalogoController::class);
    Route::resource('locacao', App\Http\Controllers\LocacaoController::class);
});