<?php

namespace App;
use App\Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','address','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Func devuelve todos los carritos/pedidos asociados al usuario
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    //card_id
    public function getCartAttribute ()
    {
       $cart =  $this->carts()->where('status','Active')->first();
       if($cart)
       {
           return $cart;
       }
       else
       {
           $cart = new Cart();
           $cart->status = 'Active';
           $cart->user_id = $this->id;
           $cart->save();
           return $cart;
       }
    }
}
