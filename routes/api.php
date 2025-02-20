<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\MusicasController;
use App\Http\Controllers\SugestaoController;

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
    Route::get('/musicas', [MusicasController::class, 'index'])
        ->name('musica.index');
});

Route::middleware(['admin'])->group(function () {
    Route::prefix('/musicas')->group(function () {
        Route::post('/salvar', [MusicasController::class, 'store']);
        Route::put('{id}/update', [MusicasController::class, 'update']);
        Route::delete('{id}/delete', [MusicasController::class, 'destroy']);
    });


    Route::prefix('/sugestoes')->group(function () {
        Route::get('/', [SugestaoController::class, 'listarPendentes']);
        Route::patch('/{id}/aprovar', [SugestaoController::class, 'aprovar']);
        Route::patch('/{id}/rejeitar', [SugestaoController::class, 'rejeitar']);
    });
 

});




Route::middleware(['auth'])->group(function () {
    Route::post('/sugestoes', [SugestaoController::class, 'sugerir']);
});


