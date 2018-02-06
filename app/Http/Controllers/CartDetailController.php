<?php

namespace App\Http\Controllers;

use App\CartDetails;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
        $cartDetail = new CartDetails();
        $cartDetail->cart_id = auth()->user()->cart->id; //id carrito usuario autenticado/recuperado de la funcion getCartIdAttribute del User.php
        $cartDetail->product_id =  $request->product_id; //los $request vienen de los formularios
        $cartDetail->quantity   =  $request->quantity; //los $request vienen de los formularios
        $cartDetail->save(); //Guardar informacion
        $notification = 'Producto añadido al Carro de Compra';
        return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
        $cartDetail = CartDetails::find($request->cart_detail_id);
        if($cartDetail->cart_id == auth()->user()->cart->id)
        {
            $cartDetail->delete();
        }

        $notification = 'Producto Eliminado del Carro de Compra';
        return back()->with(compact('notification'));
    }
}
