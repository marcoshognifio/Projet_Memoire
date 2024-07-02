<?php

use App\Http\Controllers\Api\ProjetController as ApiProjetController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('accueil');
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/connection', [UserController::class,'connection'])->name('connection');
    Route::get('/login', [UserController::class,'login'])->name('login');
    Route::post('/login', [UserController::class,'do_login'])->name('do_login');
    Route::get('/create', [UserController::class,'create'])->name('create');
    Route::post('/store', [UserController::class,'store'])->name('store');
    Route::get('/index', [UserController::class,'index'])->name('index');

    Route::prefix('projet')->name('projet.')->group(function () {
        Route::get('/create', [ProjetController::class,'create'])->name('create');
        Route::post('/store', [ProjetController::class,'store'])->name('store');
        Route::get('/{projet}/show', [ProjetController::class,'show'])->name('show');
        

        Route::prefix('/{projet}/ajoutfond')->name('ajoutfond.')->group(function () {
            Route::get('/create', [ProjetController::class,'create_ajoutfond'])->name('create');
            Route::post('/store', [ProjetController::class,'store_ajoutfond'])->name('store');
        });

        Route::prefix('/{projet}/depense')->name('depense.')->group(function () {
            Route::get('/index', [DepenseController::class,'index'])->name('index');
            Route::get('/article', [DepenseController::class,'create_article'])->name('article');
            Route::post('/article', [DepenseController::class,'store_article'])->name('store_article');
            Route::post('/store', [DepenseController::class,'store'])->name('store');
        });

        Route::prefix('/{projet}/transaction')->name('transaction.')->group(function () {
            Route::get('/article', [TransactionController::class,'create'])->name('create');
            Route::post('/store', [TransactionController::class,'store'])->name('store');
        });
        
    });
});


