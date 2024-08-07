<?php

namespace App\Services;
use App\Http\Helpers\CacheHelper;
use App\Models\Restaurant;

class RestaurantService
{
    
    protected $googleMapService;

    public function __construct(GoogleMapService $googleMapService)
    {
        $this->googleMapService = $googleMapService;
    }

    public function exists(string $placeId)
    {
        return Restaurant::where('place_id', $placeId)->exists();
    }

    public function filterNotExsits(array $placeIds)
    {
        $exists = Restaurant::whereIn('place_id', $placeIds)->pluck('place_id');
        return array_diff($placeIds, $exists->toArray());
    }

    public function getPlaceDetail($placeId)
    {
        return $this->googleMapService->getPlaceDetail($placeId);
    }

    public function create($placeDetail)
    {   

       $fillable = [
            'name' => $placeDetail['name'],
            // 'description' => $restaurantDatum['description'],
            'place_id' => $placeDetail['place_id'],
            'expire_cache_datetime' => now()->addWeekday(),
            'location' => isset($placeDetail['geometry']) ? $placeDetail['geometry']['location'] : null,
        ];

        return Restaurant::updateOrCreate(['place_id' => $fillable['place_id']], $fillable);
    }

    public function getNearbyRestaurants(array $params, ?int $latitude = null, ?int $longitude = null, $radius = 5000)
    {

        $restaurants = $this->googleMapService->nearbySearch($latitude, $longitude, $radius, $params);
        $placeIds = array_column($restaurants['results'], 'place_id');
        $notExists = $this->filterNotExsits($placeIds);

        foreach ($restaurants['results'] as $restaurant) {
            if (in_array($restaurant['place_id'], $notExists)) {
                $this->create($restaurant);
            }
        }


        // return Restaurant::where('is_active', true)->get();
        // return Restaurant::whereIn('place_id', $placeIds)->get();
        return CacheHelper::remember('restaurants_service_query_'.CacheHelper::generateKey($params), null, function () use ($placeIds) {
            return Restaurant::whereIn('place_id', $placeIds)->get(); 
        });
    }
}

