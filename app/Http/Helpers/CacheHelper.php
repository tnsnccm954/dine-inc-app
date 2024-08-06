<?php


namespace App\Http\Helpers;
use Cache;


class CacheHelper
{
    /**
     * Get the value from cache if available, otherwise execute the callback and store the result in cache.
     *
     * @param string $key
     * @param int $minutes
     * @param \Closure $callback
     * @return mixed
     */
    public static function remember(string $key, int $minutes = config('cache.lifetime'), \Closure $callback)
    {   
        $key = config('cache.prefix') . $key;
        return Cache::remember($key, $minutes, $callback);
    }

    /**
     * Store the value in cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int $minutes
     * @return void
     */
    public static function put(string $key, $value, int $minutes = config('cache.lifetime'))
    {
        Cache::put($key, $value, $minutes);
    }
}