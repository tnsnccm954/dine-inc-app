<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('App');
});

Route::get('/restaurants/search/{viewMode}', function ($viewMode) {
    // $params = $request->validate([
    //     'viewMode' => 'string|in:card,map',
    // ]);
    $props = [
        'view-mode' => $viewMode,
    ];

    switch ($viewMode) {
        case 'map-view':
            $props['layout'] = 'CardViewerLayout';
            return Inertia::render('RestaurantIndexMapViewer', $props);
        case 'card':
        default:
            $props['layout'] = 'RestaurantIndexMapViewer';
            return Inertia::render('RestaurantIndexCardViewer', $props);
    }
});
