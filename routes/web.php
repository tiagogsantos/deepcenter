<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ListCepController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'index'])->name('index');

Route::prefix('usuarios')->group(function () {

    Route::get('lista-usuarios', [UserController::class, 'listUsers'])->name('list.users');

    Route::get('cadastrar-usuarios', [UserController::class, 'create'])->name('create.user');

    Route::post('criar-usuario', [UserController::class, 'store'])->name('store.user');

    Route::get('editar-usuario/{id}', [UserController::class, 'edit'])->name('edit.user');

    Route::post('atualizar-usuario/{id}', [UserController::class, 'update'])->name('update.user');

    Route::post('remover-usuario', [UserController::class, 'destroy'])->name('destroy.user');

    Route::post('list-cep', [ListCepController::class, 'listCep'])->name('list.cep');

});






