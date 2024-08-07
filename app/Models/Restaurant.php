<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'place_id',
        'expire_cache_datetime',
        'is_active',
        'location',
    ];

    protected $casts = [
        'expire_cache_datetime' => 'datetime',
        'location' => 'json',
    ];

    public function menus()
    {
        return $this->hasMany(RestaurantMenu::class);
    }

}
