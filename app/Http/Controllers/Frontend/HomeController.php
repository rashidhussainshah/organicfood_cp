<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Tag;
use App\User;
use Response;
use App\Product;
use App\Category;
use App\FarmOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = [];
        $data['title'] = 'Organic Food | Home';
        $data['explore_categories'] = Category::with('countCategoryProducts')->limit(5)->get();
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate(16);
        $data['farmers_id'] = DB::select('SELECT farm_id,COUNT(*) AS `count` FROM orders_farm GROUP BY farm_id ORDER BY COUNT(*) DESC LIMIT 10 ');
        //                 ->groupBy('farm_id')
        //                 ->get();
        //        dd($data['farmers_id']);    
        foreach ($data['farmers_id'] as $farm_id) {
            $name[] = $farm_id->farm_id;
        }
        //        dd($name)
        $data['farmers'] = User::whereIn('id', $name)->get();
        //        dd($data['farmers']);
        //        
        return view('frontend.home.index', $data);
    }
    public function searchByname(Request $request)
    {

        $name = [];
        $data['products'] = Product::where('name', 'like', '%' . $request->product . '%')->with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate(16);
        $data['farmers_id'] = DB::select('SELECT farm_id,COUNT(*) AS `count` FROM orders_farm GROUP BY farm_id ORDER BY COUNT(*) DESC LIMIT 10 ');
        foreach ($data['farmers_id'] as $farm_id) {
            $name[] = $farm_id->farm_id;
        }
        $data['farmers'] = User::whereIn('id', $name)->get();
        return view('frontend.home.index', $data);
    }


    public function showCategoryProducts($cat_slug)
    {
        $per_page = 10;
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }
        $data['per_page'] = $per_page;
        $data['title'] = 'Organic Food | Category';
        $data['farms'] = User::where('type', 'farmer')->where('is_active', 1)->get();
        $data['categories'] = Category::where('is_verified', 1)->get();
        $data['tags'] = Tag::getPopularTags();
        $cat_id = Category::where('slug', $cat_slug)->pluck('id')->first();
        $data['category_name'] = '';
        $project_url = URL::to('/');
        //check farmers array
        if (isset($_GET['cat']) && !empty($_GET['farms']) && !empty($_GET['cat'])) {

            $cat_ids_str = $_GET['cat'];
            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('user_id', $data['farmer_ids'])->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
        } else if (isset($_GET['farms']) && empty($_GET['cat'])) {

            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=');
            $data['pagination_search'] = true;
        } else if (isset($_GET['cat']) && empty($_GET['farms'])) {
            $cat_ids_str = $_GET['cat'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
        } else {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->where('cat_id', $cat_id)->orderBy('id', 'desc')->paginate($per_page);
            $data['farmer_ids'] = [];
            $data['cat_id'] = $cat_id;
            $data['pagination_search'] = false;
            $data['category_name'] = Category::where('slug', $cat_slug)->pluck('name')->first();
        }

        return view('frontend.product.search_products_by_category', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
