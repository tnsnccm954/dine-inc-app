<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'is_available',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    
}
