<?php

namespace App\Http\Controllers;

use App\Contracts\GoogleMapService;
use App\Models\Restaurant;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $restaurantService;
    // protected $googleMapService;
    // public function __construct(GoogleMapService $googleMapService)
    // {
    //     $this->googleMapService = $googleMapService;
    // }

    public  function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->validate([
            // api 
            'lat' => 'sometimes|numeric',
            'lng' => 'sometimes|numeric',
            'radius' => 'sometimes|numeric',
            'keyword' => 'sometimes|string',
            'type' => 'sometimes|string',
            'page_token' => 'sometimes|string',
            'business_status'=>'sometimes|string',
            'formatted_address'=>'sometimes|string',
            'name'=>'sometimes|string',


            //filter by food type
            'food_type' => 'sometimes|string|exists:food_types,name',
            'food_types' => 'sometimes|array|min:1',
            'food_types.*' => 'string|exists:food_types,name',

            'with_relationships' => 'sometimes|array|min:1',
            'with_relationships.*' => 'string|in:menus',
        ]);

        $lat = $params['lat'] ?? null;
        $lng = $params['lng'] ?? null;
        $radius = $params['radius'] ?? 5000;
        unset($params['lat'], $params['lng'], $params['radius']);

        $restaurants = $this->restaurantService->getNearbyRestaurants($params, $lat, $lng, $radius);
        // $response = $this->googleMapService->nearbySearch($lat, $lng, $radius, $params);

        return response()->json($restaurants);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'name' => 'required|string',
            'place_id' => 'required|string',
            ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
