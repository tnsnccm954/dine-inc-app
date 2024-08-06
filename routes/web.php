<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('App');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

