<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the mass assignable attributes
    protected $fillable = [
        'user_id',
        'category_id',
        'photo',
        'brand',
        'name',
        'description',
        'details',
        'price',
    ];

    /**
     * Define the relationship between Product and User.
     * A Product belongs to a User (the creator or owner of the product).
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Define the relationship between Product and Category.
     * A Product belongs to a Category.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Define the relationship between Product and Review.
     * A Product can have multiple Reviews.
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    /**
     * Define the relationship between Product and Stock.
     * A Product can have multiple Stock items.
     */
    public function stocks()
    {
        return $this->hasMany('App\Models\Stock');
    }

    /**
     * Optionally, define an accessor to get the product's full URL for its image.
     * This assumes you're storing images locally or through a service.
     */
    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
