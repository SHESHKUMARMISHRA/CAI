<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Correct way to use Auth facade

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AuthorsTable;

// Authentication routes
Route::get('login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

// Livewire authors route (uncomment if required)
# Route::get('authors', AuthorsTable::class)->name('authors.index');
