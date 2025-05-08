<?php

use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'home'])
     ->name('home');
