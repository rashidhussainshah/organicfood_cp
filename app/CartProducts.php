<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProducts extends Model
{
    //
public static function saveProductInCart($request)
{
    $cart = new CartProducts;
    $cart->ip = $request->ip();
    $cart->product_id = $request->id;
    $cart->quantity = 1;
    return $cart->save();

}

public static function updateCartProduct($request)
{
    $product_info = CartProducts::where('product_id', $request->id)->first();
    if ($product_info)
    {
        return $product_info->delete();
    }




}
}
