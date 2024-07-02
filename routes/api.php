<?php

use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

Route::prefix('user')->name('user.')->group(function () {

    Route::post('/login', [UserController::class,'login'])->name('login');
    Route::get('/{id}/projets', [UserController::class,'projets']);
    Route::get('/{id_user}/projet/{id_projet}/sous_projets', [ProjetController::class,'sous_projets']);
})->middleware('auth:sanctum');
