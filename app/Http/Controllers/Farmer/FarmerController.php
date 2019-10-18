<?php

namespace App\Http\Controllers\Farmer;

use App\User;
use App\Order;
use App\Product;
use App\FarmOrder;
use App\Favrourite;
use App\UserDetails;
use App\UserLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FarmerController extends Controller
{

    public function dashboardView()
    {
        $data['tab'] = 'dashboard';
        //        dd(Auth::user()->id);
        $data['orders'] = FarmOrder::where('farm_id', Auth::user()->id)->with('getOrderProducts.getProduct.getUnit')->get();
        //        dd( $data['orders']);
        return view('farmer.main_content', $data);
    }

    public function orderDetail($id)
    {
        //         dd($id);
        $data['order'] = FarmOrder::withTrashed()->where('id', $id)->with('getOrderProducts.getProduct.getUnit')->first();
        //        dd( $data['order']);
        return view('farmer.order_detail', $data);
    }

    public function info()
    {
        //         dd($id);
        $data['tab'] = 'info';
        $data['farmer'] = User::where('id', Auth::user()->id)->with('getDetail')->first();
        //        dd( $data['farmer']);
        return view('farmer.farm_info', $data);
    }

    public function farmerInfo(Request $request)
    {
        dd($request->all());
        //         dd($id);
        $data['tab'] = 'info';
        $data['farmer'] = User::where('id', Auth::user()->id)->with('getDetail')->first();
        //        dd( $data['farmer']);
        return view('farmer.farm_info', $data);
    }

    public function orderdelete($id)
    {


        $order = FarmOrder::where('id', $id)->first();
        $order->status = 'trash';
        $order->save();
        $order->delete();

        //        dd( $data['order']);
        return redirect()->back()->with('error', 'Order deleted successfully');
    }

    public function orderStatus(Request $request)
    {

        //            dd($request->all());
        $order = FarmOrder::where('id', $request->id)->first();
        $order->status = $request->status;
        $order->save();
        //        dd( $data['order']);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function orders()
    {
        $data['tab'] = 'orders';
        $data['orders'] = FarmOrder::where('farm_id', Auth::user()->id)->with('getOrderProducts.getProduct.getUnit')->get();
        $data['orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->count();
        $data['trashed_orders'] = FarmOrder::onlyTrashed()->where('farm_id', Auth::user()->id)->with('getOrderProducts.getProduct.getUnit')->get();
        $data['trashed_orders_count'] = FarmOrder::onlyTrashed()->where('farm_id', Auth::user()->id)->count();
        $data['processing_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'processing')->with('getOrderProducts.getProduct.getUnit')->get();
        $data['processing_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'processing')->count();
        $data['onhold_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'onhold')->with('getOrderProducts.getProduct.getUnit')->get();
        $data['onhold_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'onhold')->count();
        $data['cancelled_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'cancelled')->with('getOrderProducts.getProduct.getUnit')->get();
        $data['cancelled_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->where('status', 'cancelled')->count();
        //             dd($data['cancelled_orders']);
        return view('farmer.orders', $data);
    }

    public function orderComplete(Request $request)
    {
        //      dd($request->all());

        $order = FarmOrder::where('id', $request->id)->first();
        $order->status = 'completed';
        $order->save();
        return response()->json(['status' => 'success', 'Order' => $order]);
    }
    public function openFarmerProfile(Request $request, $farmer_id)
    {

        $data['farmer_main_loc'] = UserLocations::where('user_id', $farmer_id)->where('is_main', 1)->pluck('address')->first();
        $data['farmer_locations'] = UserLocations::where('user_id', $farmer_id)->where('is_main', 0)->get();
        $data['farmer_about'] = UserDetails::where('user_id', $farmer_id)->pluck('description')->first();
        $data['form'] = User::where('id', $farmer_id)->first();
        $data['title'] = 'Organic Food | ' . $data['form']->name;
        $base_url = URL::to('/');
        $data['former_profile_link'] = $base_url . '/farmer/' . $farmer_id;
        $data['former_profile_photo'] = $base_url . $data['form']->profile_photo;
        $per_page = 10;
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->where('user_id', $farmer_id)->orderBy('id', 'desc')->paginate($per_page);
        if (!$data['farmer_main_loc']) {
            $data['farmer_main_loc'] = 'N/A';
        }
        if (!$data['farmer_about']) {
            $data['farmer_about'] = 'N/A';
        }
        $data['farmer_id'] = $farmer_id;
        $data['per_page'] = $per_page;
        $data['already_favorite'] = false;
        $isAlreadyFavorite = Favrourite::where('user_id', Auth::guard('user')->user()->id)
            ->where('product_id', $farmer_id)
            ->where('type', 'farmer')
            ->first();
        if ($isAlreadyFavorite) {
            $data['already_favorite'] = true;
        }


        return view('frontend.farmer_profile_page', $data);
    }
}
