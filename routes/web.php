<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::post('/contact', [LandingController::class, 'submitContact'])->name('contact.submit');
Route::get('/blog', [LandingController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [LandingController::class, 'blogPost'])->name('blog.post');
Route::get('/terms', [LandingController::class, 'terms'])->name('terms');
Route::get('/privacy', [LandingController::class, 'privacy'])->name('privacy');
