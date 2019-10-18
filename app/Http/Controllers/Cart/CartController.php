<?php

namespace App\Http\Controllers\Cart;

use App\CartProducts;
use App\Http\Controllers\Controller;
use App\Product;
use Cart;
use Illuminate\Http\Request;
use Response;

class CartController extends Controller

{
    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product) {
            if ($product->quantity >= $request->quantity) {
                Cart::add($request->id, $request->name, $request->quantity, $request->price);
                CartProducts::saveProductInCart($request);
                $product->quantity -= $request->quantity;
                $product->save();
                return Response::json(array('status' => true, 'message' => 'Successfully added to cart', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);
            } else {
                return Response::json(array('status' => true, 'message' => 'Sorry, Product Not Available in Stock ', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);

            }

        } else {
            return Response::json(array('status' => true, 'message' => 'Product Not Found'), 200);
        }


    }

    public function getProductFromCart()
    {
//                Cart::destroy();
        $data['title'] = 'Organic Food | Cart';
        return view('frontend.cart.cart_detail', $data);

    }

    public function descreaseCartItem(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product) {
            if ($product->quantity >= 1) {
                Cart::update($request->rowId, $request->quantity);
                CartProducts::updateCartProduct($request);
                $product->quantity += 1;
                $product->save();
                return Response::json(array('status' => true, 'message' => 'Decrease Product From Cart', 'cart_total' => number_format((float)Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);

            } else {
                return Response::json(array('status' => true, 'message' => 'Sorry, Product Not Available in Stock ', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);

            }

        } else {
            return Response::json(array('status' => true, 'message' => 'Product Not Found'), 200);
        }

    }

    public function increaseCartItem(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product) {
            if ($product->quantity >= 1) {
                Cart::update($request->rowId, $request->quantity);
                CartProducts::saveProductInCart($request);
                $product->quantity -= 1;
                $product->save();
                return Response::json(array('status' => true, 'message' => 'Product Quantity Increases', 'cart_total' =>number_format(Cart::total(),2), 'cart_total_item' => Cart::count()), 200);

            } else {
                return Response::json(array('status' => true, 'message' => 'Sorry, Product Not Available in Stock ', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);

            }

        } else {
            return Response::json(array('status' => true, 'message' => 'Product Not Found'), 200);
        }

    }

    public function removeItemFromCart(Request $request)
    {

        if (Cart::remove($request->rowId));
        {
            return Response::json(array('status'=> true, 'message'=> 'Product Successfully Removed From Cart', 'cart_total'=> number_format(Cart::total(),2) , 'cart_total_item'=>Cart::count()  ),200);
        }
    }
}
