<?php

use Inertia\Inertia;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\HomeController;



Route::get('/',[HomeController::class,'index'])->name('home');
Route::resource('faqs', FaqController::class);
Route::resource('tags', TagController::class);



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
