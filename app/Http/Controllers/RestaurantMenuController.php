<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class RestaurantMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qParams = $request->validate([
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'page' => 'sometimes|integer',
            'per_page' => 'sometimes|integer',
        ]);
        $builder = RestaurantMenu::query();
        if (isset($qParams['restaurant_id'])) {
            $builder->where('restaurant_id', $qParams['restaurant_id']);
        }
        $menus = $builder->paginate($qParams['per_page'] ?? 10);

        return response()->json($menus);
    }

    public function indexByRestaurant(Restaurant $restaurant, Request $request)
    {
        $restaurantMenus = $restaurant->menus()->get();
        return response()->json($restaurantMenus);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string',
            'description' => 'sometimes|string|max:255',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean',
        ]);

        $restaurantMenu = RestaurantMenu::create($params);
        return response()->json($restaurantMenu);
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantMenu $restaurantMenu)
    {
        return response()->json($restaurantMenu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantMenu $restaurantMenu)
    {
        $params = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'sometimes|string',
            'description' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'is_available' => 'sometimes|boolean',
        ]);
        $restaurantMenu->update($params);
        return response()->json($restaurantMenu->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantMenu $restaurantMenu)
    {
        $restaurantMenu->delete();
        return response()->json($restaurantMenu);
    }
}
