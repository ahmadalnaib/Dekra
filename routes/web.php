<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::resource('questions', QuestionController::class);



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
