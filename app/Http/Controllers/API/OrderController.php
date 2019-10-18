<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use File;
use App\Category;
use App\Order;
use App\OrderProducts;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    
    public function saveOrder(Request $request){
        $user = User::find(Auth::user()->id);
        
        $numbers = range(000000, 999999);
        shuffle($numbers);
        $order_number = array_slice($numbers, 0, 1);
        
        try {
            \Stripe\Stripe::setApiKey('sk_test_lGYVBFWZ1KU9pYIR99eYcY2C00tbQXG4NG');

            $charge = \Stripe\Charge::create([
                'amount' => $request->total_price * 100,
                'currency' => 'usd',
                'description' => 'Amount charged for order #'.$order_number[0],
                'customer' => $user->stripe_id,
            ]);


            $order = new Order();
            $order->order_no = $order_number[0];
            $order->user_id = $user->id;
            $order->quantity = $request->total_quantity;
            $order->price = $request->total_price;
            $order->save();

            $products = $request->product;
            if(!empty($products)){
                foreach ($products as $product){
                    $orderproduct = new OrderProducts();
                    $orderproduct->order_id = $order->id;
                    $orderproduct->product_id = $product['id'];
                    $orderproduct->quantity = $product['quantity'];
                    $orderproduct->price = $product['price'];
                    $orderproduct->save();
                }
            }


        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            echo($e->getMessage());
        }

        $success = $order_number[0];
        return Response::json(array('status' => 'success', 'successMessage' => 'Your order has been successfully placed.', 'successData' => $success), 200, []);
    }
    
    public function trackOrder($id){
        $order = Order::with('getOrderProducts')->where('order_no',$id)->first();
        if(!empty($order)){
             $success = $order;
            return Response::json(array('status' => 'success', 'successMessage' => 'Order Tracking.', 'successData' => $success), 200, []);
        } else {
            return Response::json(array('status' => 'error', 'errorMessage' => 'No order has been placed on this number'), 400, []);
        }
       
    }
}
