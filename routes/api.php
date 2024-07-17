<?php

use App\Http\Controllers\Api\DepenseController;
use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

Route::prefix('user')->name('user.')->group(function () {

    Route::post('/login', [UserController::class,'login'])->name('login');
    Route::post('/save_user', [UserController::class,'save_user'])->name('store');
    Route::get('/{id}/projets', [UserController::class,'projets']);

})->middleware('auth:sanctum');

Route::prefix('projet')->name('projet.')->group(function () {
    Route::post('/create_projet', [ProjetController::class,'create_projet']);
    Route::get('/{id_projet}/sous_projets', [ProjetController::class,'sous_projets']);
    Route::post('{id}/ajoutfond', [ProjetController::class,'ajoutfond']);
    Route::get('/{projet}/show', [ProjetController::class,'show'])->name('show');
    Route::post('{id}/save_transaction', [TransactionController::class,'save_transaction']);
    Route::get('{id}/transactions', [TransactionController::class,'transactions']);

    Route::prefix('/{projet}/depense')->name('depense.')->group(function () {
        Route::get('/index', [DepenseController::class,'index']);
        Route::post('/store', [DepenseController::class,'store']);
    });
})->middleware('auth:sanctum');
