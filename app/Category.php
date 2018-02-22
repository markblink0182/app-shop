<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public static $messages = [
            'name.required' => 'Nombre campo obligatorio',
            'name.min'  => 'Nombre Longitud mínima 3 caracteres',
            'description.max' => 'Descripción máxima 200 caracteres'
        ];
    public static  $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200'
        ];



	protected $fillable = ['name','description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        //si la categoria contiene 1 imagen q se muestre
        if($this->image)
        
            return '/images/categories/'.$this->image;
       
        //caso contrario mostrar la del producto
        
            $firstProduct = $this->products()->first();
            if ($firstProduct) {
               return $firstProduct->featured_image_url;
            }
            else
            {
                return '/images/default.png';
            }
         
        
       

    }
}
