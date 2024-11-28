<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

// Redirige vers la page de connexion par défaut
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes d'authentification
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/upload', [ArticleController::class, 'upload'])->name('articles.upload');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/photo', [PhotoController::class, 'create']);
    Route::post('/photo', [PhotoController::class, 'store']);
    
    Route::get('/pdf/viewer', [PdfController::class, 'show'])->name('pdf.view');
});

// Middleware pour rediriger les utilisateurs non authentifiés
Route::fallback(function () {
    return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
});