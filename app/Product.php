<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //product -> category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //product->image
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    //Imagen destacada
    public function getFeaturedImageUrlAttribute()
    {
        $featuredImage = $this->images()->where('featured', true)->first();
        if(!$featuredImage)
        {
            $featuredImage = $this->images()->first();
        }
        if($featuredImage)
        {
            return $featuredImage->url;
        }

        return 'images/products/default.png';

    }
}