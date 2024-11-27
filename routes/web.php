<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('home');



Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/upload', [ArticleController::class, 'upload'])->name('articles.upload');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::get('/photo', [PhotoController::class, 'create']);
Route::post('/photo', [PhotoController::class, 'store']);


Route::get('/pdf/viewer',[PdfController::class, 'show'])->name('pdf.view');