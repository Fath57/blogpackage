<?php

use Arafath57\BlogPackage\Http\Controllers\FathPostCategoryController;
use Arafath57\BlogPackage\Http\Controllers\FathPostCommentController;
use Illuminate\Support\Facades\Route;
use Arafath57\BlogPackage\Http\Controllers\FathPostController;

Route::get('/posts', [FathPostController::class, 'index'])->name('fath.posts.index');
Route::get('/posts/{post_id}', [FathPostController::class, 'show'])->name('fath.posts.show');
Route::get('/posts/delete/{post_id}', [FathPostController::class, 'destroy'])->name('fath.posts.delete');
Route::get('/posts/edit/{post_id}', [FathPostController::class, 'edit'])->name('fath.posts.edit');
Route::get('/posts/create', [FathPostController::class, 'create'])->name('fath.posts.create');
Route::get('/posts/{slug}', [FathPostController::class, 'details'])->name('fath.posts.details');
Route::post('/posts', [FathPostController::class, 'store'])->name('fath.posts.store');
Route::post('/posts/update', [FathPostController::class, 'update'])->name('fath.posts.update');
//categories
Route::get('/categories', [FathPostCategoryController::class, 'index'])->name('fath.categories.index');
Route::get('/categories/{category_id}', [FathPostCategoryController::class, 'show'])->name('fath.categories.show');
Route::get('/categories/delete/{category_id}', [FathPostCategoryController::class, 'destroy'])->name('fath.categories.delete');
Route::post('/categories', [FathPostController::class, 'store'])->name('fath.categories.store');
Route::post('/categories/update', [FathPostController::class, 'update'])->name('fath.categories.update');
//comments
Route::get('/comments', [FathPostCommentController::class, 'index'])->name('fath.comments.index');
Route::get('/comments/{comment_id}', [FathPostCommentController::class, 'show'])->name('fath.comments.show');
Route::post('/comments', [FathPostCommentController::class, 'store'])->name('fath.comments.store');