<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/projects', 'projects')->name('projects');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit']);
Route::get('/contact/{id}/{token}', [ContactController::class, 'markRead'])->where([
    'id' => '[0-9]+', 'token' => '[a-f0-9]{16}'
])->name('mark_submission_read');
