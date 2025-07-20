<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\HomeController;



Route::get('/',[HomeController::class,'index'])->name('home');
Route::resource('faqs', FaqController::class)->middleware('auth');
Route::resource('tags', TagController::class)->middleware('auth');




require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
