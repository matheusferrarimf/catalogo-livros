<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;

Route::get('/', function () {
    return redirect('/livros');
});

Route::resource('autores', AutorController::class);
Route::resource('livros', LivroController::class);
