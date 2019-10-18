<?php

namespace App\Http\Controllers\Product;

use App\Favrourite;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Response;
use Stripe\Customer;


class ProductController extends Controller
{
    public function productDetail(Request $request, $slug)
    {
        $data['title'] = 'Organic Food | Product Detail';
        $data['fresh_products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->limit(8)->get();
        $data['product']  = Product::with('getRatings', 'getProductImages', 'getUser', 'getUnitDetail', 'getCategory')->where('slug', $slug)->first();
        // dd($data['product']);
        return view('frontend.product.product_detail', $data);
    }
    public function  loadMoreProducts(Request $request)
    {
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate(8);
        return view('frontend.partails.ajax_load_more_products', $data);
    }
    public function addToFavourite(Request $request)
    {
        $check_fav = false;
        $fav = new Favrourite;
        if ($request->type == 'product') {
            $check_fav = Favrourite::where('user_id', $request->user_id)->where('product_id', $request->p_id)->first();
            if ($check_fav) {
                return Response::json(array('success' => 'true', 'message' => 'Already Marks as Favrourite'), 200);
            } else {
                $fav->type = 'product';
                $fav->user_id = $request->user_id;
                $fav->product_id = $request->p_id;
                return Response::json(array('success' => 'true', 'message' => 'Product Successfully Added.'), 200);
            }
        } else {

            $check_fav = Favrourite::where('user_id', $request->user_id)->where('product_id', $request->form_id)->first();
            if ($check_fav) {
                return Response::json(array('success' => 'true', 'message' => 'Already Marks as Favrourite'), 200);
            } else {
                $fav->type = 'farmer';
                $fav->user_id = $request->user_id;
                //save form_id in product_id column when type farmer
                $fav->product_id = $request->form_id;
            }
        }
        if ($fav->save()) {
            return Response::json(array('success' => 'true', 'message' => 'Successfully Addeds.'), 200);
        } else {
            return Response::json(array('success' => 'false', 'message' => 'Something Went Wrong'), 400);
        }
    }
    public function showUserFavorites(Request $request, $user_id)
    {
        $data['title'] = 'Organic Food | Favorites';
        $product_ids = Favrourite::where('type', 'product')->where('user_id', $user_id)->pluck('product_id');
        $data['products']  = Product::with('getRatings', 'getProductImages', 'getUser', 'getUnitDetail', 'getCategory')->WhereIn('id', $product_ids)->get();
        return view('frontend.product.favorite_products', $data);
    }
    public function removeFromFavorite(Request $request)
    {
        $result = Favrourite::where('user_id', $request->user_id)->where('product_id', $request->product_id)->delete();
        if ($result) {
            return Response::json(array('success' => 'true', 'message' => 'Successfully Remove From Favorite.'), 200);
        } else {
            return Response::json(array('success' => 'false', 'message' => 'Something Went Wrong'), 400);
        }
    }
    public function placeOnHoldOrder(Request $request)
    {
        $status = Order::saveOnHoldOrder($request);
        if ($status) {
            Cart::destroy();
            return  Response::json(array('status' => true, 'message' => 'Congratulations, Order Place Successfully'), 200);
        } else {
            return Response::json(array('status' => false, 'message' => 'Something Went Wrong', 'error_title' => 'Error'), 400);
        }
    }
    public function placeVisaCartOrder(Request $request)
    {
        $id = Auth::guard('user')->user()->id;
        //find user and update card info
        $user = User::where('id', $id)->first();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        //create customer
        try {
            $customer = Customer::create([
                'source' => $request->stripe_token,
                'email' => $user->email,
                'description' => 'Welcome' . $user->name,
            ]);

            $user->card_brand = 'visa';
            $user->card_last_four = $request->card_number;
            $user->stripe_id = $customer->id;
            $user->save();
        } catch (\Stripe\Error\Base $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        } catch (Exception $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        }

        try {

            $charge = \Stripe\Charge::create([
                'amount' => Cart::total() * 100,
                'currency' => 'usd',
                'customer' => $customer->id,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return Response::json(array('success' => false, 'message' => $e->getError()->message, 'error_title' => 'Stripe Error'), 400);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
            // Invalid parameters were supplied to Stripe's API
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
            // Network communication with Stripe failed
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        } catch (\Stripe\Error\Base $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        } catch (\Exception $e) {
            return Response::json(array('success' => false, 'message' => $e->getMessage(), 'error_title' => 'Stripe Error'), 400);
        }

        //create charge for customer
        $status =  Order::saveVisaCardOrder($request, $customer->id, $charge->id);
        if ($status) {
            Cart::destroy();
            return Response::json(array('status' => true, 'message' => 'Congratulations, Order Place Successfully ', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 200);
        } else {
            return Response::json(array('status' => false, 'message' => 'Something Went Wrong', 'cart_total' => number_format(Cart::total(), 2), 'cart_total_item' => Cart::count()), 400);
        }
    }
}
