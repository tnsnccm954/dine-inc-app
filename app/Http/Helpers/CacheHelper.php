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
    public static function remember(string $key, ?int $minutes = null, \Closure $callback)
    {   
        $key = config('cache.prefix') . $key;
        $minutes = $minutes ?? config('cache.lifetime');

        return config('cache.enable') ? Cache::remember($key, $minutes, $callback) : $callback();
    }

    /**
     * Store the value in cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int $minutes
     * @return void
     */
    public static function put(string $key, $value, ?int $minutes = null)
    {
        $minutes = $minutes ?? config('cache.lifetime');
        Cache::put($key, $value, $minutes);
    }

    public static function generateKey(array $params)
    {
        return http_build_query($params);
    }
}