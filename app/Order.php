<?php

namespace App;

use App\OrderFarm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\OrderProducts;
use App\FarmOrder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Product;

class Order extends Model {

    use SoftDeletes;

    public function getFarm() {
        return $this->hasMany(FarmOrder::class, 'order_id', 'id');
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
   public static function saveOnHoldOrder($request)
   {
       $order_no = generateUniqueOrderNo();
       $cart_total = Cart::total();
       $total_cart_items = Cart::count();
       $cart_contents = Cart::content();

       //save one time order
       $order = new Order;
       $order->order_no = $order_no;
       $order->price =$cart_total ;
       $order->quantity = $total_cart_items;
       $order->user_id = Auth::guard('user')->user()->id;
       $order->created_at = Carbon::now();
       $order->updated_at = Carbon::now();
       $order->type= 'hold';
       $order->save();

       //save data into Order farm
       foreach ($cart_contents as $cart)
       {
           $farm_order = new OrderFarm;
           $farm_order->order_id = $order->id;
           $farm_order->price =$cart->price ;
           $farm_order->quantity = $cart->qty;
           $farm_order->farm_id =Product::getProductOwnId($cart->id);
           $farm_order->status= 'processing';
           $farm_order->created_at = Carbon::now();
           $farm_order->updated_at = Carbon::now();
           $farm_order->save();

           //save order products
           $order_product = new OrderProducts;
           $order_product->price =$cart->price ;
           $order_product->quantity = $cart->qty;
           $order_product->order_id = $order->id;
           $order_product->product_id = $cart->id;
           $order_product->created_at = Carbon::now();
           $order_product->updated_at = Carbon::now();
           $order_product->order_farm_id =$farm_order->id;
           $order_product->save();


       }
       return true;



   }
   public static function saveVisaCardOrder($request, $customer_id, $charge_id)
   {
       $order_no = generateUniqueOrderNo();
       $cart_total = Cart::total();
       $total_cart_items = Cart::count();
       $cart_contents = Cart::content();

       //save one time order
       $order = new Order;
       $order->order_no = $order_no;
       $order->stripe_charge_id = $charge_id;
       $order->price =$cart_total ;
       $order->quantity = $total_cart_items;
       $order->user_id = Auth::guard('user')->user()->id;
       $order->created_at = Carbon::now();
       $order->updated_at = Carbon::now();
       $order->type= 'cash';
       $order->save();

       //save data into Order farm
       foreach ($cart_contents as $cart)
       {
           $farm_order = new OrderFarm;
           $farm_order->order_id = $order->id;
           $farm_order->price =$cart->price ;
           $farm_order->quantity = $cart->qty;
           $farm_order->farm_id =Product::getProductOwnId($cart->id);
           $farm_order->status= 'processing';
           $farm_order->created_at = Carbon::now();
           $farm_order->updated_at = Carbon::now();
           $farm_order->save();

           //save order products
           $order_product = new OrderProducts;
           $order_product->price =$cart->price ;
           $order_product->quantity = $cart->qty;
           $order_product->order_id = $order->id;
           $order_product->product_id = $cart->id;
           $order_product->created_at = Carbon::now();
           $order_product->updated_at = Carbon::now();
           $order_product->order_farm_id =$farm_order->id;
           $order_product->save();
       }
       return true;



   }

}
