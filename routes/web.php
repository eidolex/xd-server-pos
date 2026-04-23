<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/login', 'pages::login')->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::livewire('/', 'pages::two-d.pos')->name('dashboard');
    Route::livewire('/users', 'pages::users')->name('users');
});
