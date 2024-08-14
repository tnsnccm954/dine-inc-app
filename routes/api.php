<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantMenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('restaurants.restaurant-menus', RestaurantMenuController::class)->parameters(['restaurant-menus' => 'restaurantMenu']);
Route::get('restaurants/restaurant-menus', [RestaurantMenuController::class, 'getAllRestaurantMenus']);
