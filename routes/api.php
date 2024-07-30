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

    Route::post('/save_user', [UserController::class,'save_user'])->name('store');
    Route::post('/login', [UserController::class,'login'])->name('login');

});

Route::middleware("auth:sanctum")->group(function(){
    Route::prefix('user')->name('user.')->group(function (){

        Route::get('/{id}/projets_admin', [UserController::class,'projets_admin']);
        Route::get('/{id}/projets_create', [UserController::class,'projets_create']);
        Route::post('/search', [UserController::class,'search']);
    });

    Route::prefix('projet')->name('projet.')->group(function () {
        Route::post('/create_projet', [ProjetController::class,'create_projet']);
        Route::get('/{id_projet}/sous_projets', [ProjetController::class,'sous_projets']);
        Route::post('{id}/ajoutfond', [TransactionController::class,'ajoutfond']);
        Route::post('/{id}/change_admin', [ProjetController::class,'change_admin']);
        Route::get('/{projet}/show', [ProjetController::class,'show'])->name('show');
        Route::post('/delete', [ProjetController::class,'delete']);
        Route::post('{id}/save_transaction', [TransactionController::class,'save_transaction']);
        Route::get('{id}/transactions_effectuees', [TransactionController::class,'transactions_effectuees']);
        Route::get('{id}/transactions_recues', [TransactionController::class,'transactions_recues']);
    
        Route::prefix('/{projet}/depense')->name('depense.')->group(function () {
            Route::get('/index', [DepenseController::class,'index']);
            Route::post('/store', [DepenseController::class,'store']);
        });
    });
});

