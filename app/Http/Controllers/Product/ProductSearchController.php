<?php

namespace App\Http\Controllers\Product;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use DB;

class ProductSearchController extends Controller
{
    public function getPerPageProductsForSearchByZip(Request $request)
    {
        $zip_code = $request->zip_code;
        $per_page = $request->per_page;
        $data['products'] = Product::getPerPageProductsOfUserSearch($request, $zip_code);
        $data['per_page'] = $per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getPerPageProductsForFarmerPage(Request $request)
    {
        $farmer_id = $request->farmer_id;
        $per_page = $request->per_page;
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->where('user_id', $farmer_id)->orderBy('id', 'desc')->paginate($per_page);
        $data['per_page'] = $per_page;
        $project_url = URL::to('/');
        $data['products']->setPath($project_url . '/farmer/' . $farmer_id . '?per_page=' . $per_page);

        return view('frontend.partails.ajax_load_more_products_for_farmer_page', $data);
    }

    public function getPerPageProductsForShop(Request $request)
    {
        $per_page = $request->per_page;
        $data['nearby_products'] = false;
        $data['products'] = Product::getPerPageProductsOfUserSearch($request);
        //set custom url for pagination
        // $data['products']->setPath('shop?per_page=' . $per_page);
        $data['per_page'] = $per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getPerPageProductsForTag(Request $request)
    {

        $per_page = $request->per_page;
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $per_page = $request->per_page;
        //convert array to string to becuase it will used for pagination
        $farmer_ids_str = implode(",", $selected_farmers);
        $cat_ids_str = implode(",", $selected_categories);
        $project_url = URL::to('/');
        $data['tag_name'] = '';
        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=&cat=' . $cat_ids_str);
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=' . $farmer_ids_str . '&cat=');
        } else {
            $tag_id = $request->tag_id;
            $tagname = Tag::where('id', $tag_id)->pluck('name')->first();
            $product_ids = Tag::where('name', $tagname)->pluck('product_id');
            $data['tags'] = Tag::getPopularTags();
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')
                ->WhereIn('id', $product_ids)
                ->orderBy('id', 'desc')->paginate($per_page);
            //set custom url for pagination
            $data['products']->setPath($tag_id . '?per_page=' . $per_page);
            $data['tag_name'] = $tagname;
        }

        $data['per_page'] = $per_page;

        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getPerPageProductsByName(Request $request)
    {

        $search_product_name = $request->search_product_name;
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $per_page = $request->per_page;
        //convert array to string to becuase it will used for pagination
        $farmer_ids_str = implode(",", $selected_farmers);
        $cat_ids_str = implode(",", $selected_categories);
        $project_url = URL::to('/');
        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=&cat=' . $cat_ids_str);
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=');
        } else {
            $data['products'] = Product::where('name', 'like', '%' . $search_product_name . '%')->with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate($per_page);
            $data['search_product_name'] = $search_product_name;
            $data['pagination_search'] = false;
            $data['products']->setPath($project_url . '/search_by_name?product=' . $search_product_name . '&per_page=' . $per_page);
        }

        $data['per_page'] = $per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }

    public function getPerPageProductsOfCategory(Request $request)
    {
        $per_page = $request->per_page;
        $cat_id = $request->cat_id;
        $data['products'] = Product::getPerPageProductsOfUserSearch($request, $zip_code = null, $cat_id);
        $data['per_page'] = $per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getPoductsForShop(Request $request)
    {
        //first time iteration while search by shop
        $per_page = 10;
        $data['title'] = 'Organic Food | Shop';
        $data['tags'] = Tag::getPopularTags();
        $data['farmers'] = User::where('type', 'farmer')->where('is_active', 1)->get();
        $data['categories'] = Category::where('is_verified', 1)->get();
        $lat = '';
        $lng = '';
        $data['shop_page'] = 'yes';
        $data['per_page'] = $per_page;

        $data['farmer_ids'] = [];
        $data['categories_id'] = [];
        $data['pagination_search'] = false;
        $data['latest_products'] = '';
        $data['nearby_products'] = '';
        $data['search_result'] = '';
        $project_url = URL::to('/');
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }

        //check farmers array
        if (isset($_GET['cat']) && !empty($_GET['farms']) && !empty($_GET['cat'])) {
            $cat_ids_str = $_GET['cat'];
            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
            $data['search_result'] = 'Search Results';
        } else if (isset($_GET['farms']) && empty($_GET['cat'])) {

            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=');
            $data['pagination_search'] = true;
            $data['search_result'] = 'Search Results';
        } else if (isset($_GET['cat']) && empty($_GET['farms'])) {
            $cat_ids_str = $_GET['cat'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
            $data['search_result'] = 'Search Results';
        }


        //for first time iteration
        //if user logged in show nearby products
        else if (Auth::guard('user')->check()) {
            $loggedInUser = Auth::guard('user')->user();
            if (($loggedInUser->lat && $loggedInUser->lng) != '') {
                $lat = $loggedInUser->lat;
                $lng = $loggedInUser->lng;
            }
            $farmer_ids = User::selectRaw("users.id,( 3959 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians($lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat)))) AS distance")
                ->having('distance', '<=', 50)
                ->where('id', '!=', $loggedInUser->id)
                ->where('type', 'farmer')
                ->pluck('id');
            $data['farmer_ids'] = $farmer_ids;
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id', $farmer_ids)->orderBy('id', 'desc')->paginate($per_page);
            $data['nearby_products'] = 'Products Near You';
        }
        //otherwise show latest products
        else {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($per_page);
            $data['latest_product'] = 'Latest Products';
        }
        return view('frontend.product.product_search_page', $data);
    }
    public function getSearchResults(Request $request)
    {
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $zip_code = $request->zip_code ? $request->zip_code : '';
        $per_page = $request->per_page;
        //convert array to string to becuase it will used for pagination
        $farmers = implode(",", $selected_farmers);
        $categories = implode(",", $selected_categories);
        $project_url = URL::to('/');
        //set custom url for pagination
        if ($zip_code != '') {
            $farmer_ids = User::where('zip_code', $zip_code)
                ->where('type', 'farmer')
                ->pluck('id');
        }
        if ((!empty($selected_categories)) && (!empty($selected_farmers)) && ($zip_code != '')) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->WhereIn('user_id', $farmer_ids)->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
        } elseif ((!empty($selected_categories)) && (!empty($selected_farmers)) && ($zip_code == '')) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id', $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
        } elseif (!empty($selected_categories) && ($zip_code != '') && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $farmer_ids)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=&cat=' . $categories);
        } elseif (!empty($selected_categories) && ($zip_code == '') && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id', $selected_categories)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=&cat=' . $categories);
        } elseif (!empty($selected_farmers) && ($zip_code != '') && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->whereIn('user_id', $farmer_ids)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
        } elseif (!empty($selected_farmers) && ($zip_code == '') && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id', $selected_farmers)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
        }
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function searchProductsByName(Request $request)
    {
        $per_page = 10;
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }
        $search_product_name = $request->product;
        $data['title'] = 'Organic Food | ' . $search_product_name;
        $data['tags'] = Tag::getPopularTags();
        $data['farms'] = User::where('type', 'farmer')->where('is_active', 1)->get();
        $data['categories'] = Category::where('is_verified', 1)->get();
        $data['search_product_name'] = '';
        $project_url = URL::to('/');
        $data['pagination_search'] = false;

        if (isset($_GET['cat']) && !empty($_GET['farms']) && !empty($_GET['cat'])) {
            $cat_ids_str = $_GET['cat'];
            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
        } else if (isset($_GET['farms']) && empty($_GET['cat'])) {

            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['pagination_search'] = true;
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=');
        } else if (isset($_GET['cat']) && empty($_GET['farms'])) {

            $cat_ids_str = $_GET['cat'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['pagination_search'] = true;
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=&cat=' . $cat_ids_str);
        } else if (isset($_GET['latest_products']) && (!empty($_GET['latest_products']))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($per_page);
            $data['pagination_search'] = true;
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page);
        } else {

            $data['products'] = Product::where('name', 'like', '%' . $search_product_name . '%')->with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate($per_page);
            $data['search_product_name'] = $search_product_name;
            $data['pagination_search'] = false;
        }


        $data['per_page'] = $per_page;
        return view('frontend.product.product_search_by_name', $data);
    }
    public function getProductsByTag(Request $request, $tag_id)
    {
        $per_page = 10;
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }
        $data['per_page'] = $per_page;
        $tagname = Tag::where('id', $tag_id)->pluck('name')->first();
        $product_ids = Tag::where('name', $tagname)->pluck('product_id');

        $data['tags'] = Tag::getPopularTags();


        $data['title'] = 'Organic Food | ' . $tagname;
        $data['farms'] = User::where('type', 'farmer')->where('is_active', 1)->get();
        $data['categories'] = Category::where('is_verified', 1)->get();
        $data['tag_name'] = '';
        $lat = '';
        $lng = '';
        $data['shop_page'] = 'yes';

        $data['farmer_ids'] = [];
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('id', $product_ids)->orderBy('id', 'desc')->paginate($per_page);
        // dd($data['products']);
        $data['tag_name'] = $tagname;
        $data['tag_id'] = $tag_id;
        return view('frontend.product.product_search_by_tag', $data);
    }

    public function searchProductsByZipCode(Request $request)
    {
        $zipcode = '';
        if (!empty($_GET['zip_code']) && isset($_GET['zip_code'])) {
            $zipcode = $_GET['zip_code'];
        }
        $per_page = 10;
        if (!empty($_GET['per_page']) && isset($_GET['per_page'])) {
            $per_page = $_GET['per_page'];
        }
        $data['per_page'] = $per_page;
        $data['title'] = 'Organic Food | Search';
        $data['farmer_ids'] = [];
        $data['categories_id'] = [];
        $data['farmers'] = User::where('type', 'farmer')->where('is_active', 1)->get();
        $data['categories'] = Category::where('is_verified', 1)->get();
        $data['tags'] = Tag::getPopularTags();
        $data['pagination_search'] = false;
        $data['zip_search'] = '';
        $project_url = URL::to('/');


        if (isset($_GET['cat']) && !empty($_GET['farms']) && !empty($_GET['cat'])) {

            $cat_ids_str = $_GET['cat'];
            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search?zip_code=' . $zipcode . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=' . $cat_ids_str);
            $data['pagination_search'] = true;
        } else if (isset($_GET['farms']) && empty($_GET['cat'])) {

            $farmer_ids_str = $_GET['farms'];
            //convert str to arr
            $data['farmer_ids'] = explode(",", $farmer_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('user_id', $data['farmer_ids'])->orderBy('id', 'desc')->paginate($per_page);
            $data['pagination_search'] = true;
            $data['products']->setPath($project_url . '/search?zip_code=' . $zipcode . '&per_page=' . $per_page . '&farms=' . $farmer_ids_str . '&cat=');
        } else if (isset($_GET['cat']) && empty($_GET['farms'])) {

            $cat_ids_str = $_GET['cat'];
            //convert str to arr
            $data['categories_id'] = explode(",", $cat_ids_str);
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->WhereIn('cat_id', $data['categories_id'])->orderBy('id', 'desc')->paginate($per_page);
            $data['pagination_search'] = true;
            $data['products']->setPath($project_url . '/search?zip_code=' . $zipcode . '&per_page=' . $per_page . '&farms=&cat=' . $cat_ids_str);
        } else if (!empty($_GET['latest_products']) && isset($_GET['latest_products'])) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($per_page);
        }
        //search by zip
        else {

            //check farmers array
            $farmer_ids = User::where('zip_code', $zipcode)
                ->where('type', 'farmer')
                ->pluck('id');
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id', $farmer_ids)->orderBy('id', 'desc')->paginate($per_page);
            $data['farmer_ids'] = $farmer_ids;
            $data['zip_search'] = $zipcode;
        }



        return view('frontend.product.product_search_page', $data);
    }

    public function searchByCategory(Request $request)
    {
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $cat_id = $request->cat_id;
        $farmers = implode(",", $selected_farmers);
        $categories = implode(",", $selected_categories);
        $project_url = URL::to('/');

        $cat_slug = Category::where('id', $cat_id)
            ->pluck('slug')
            ->first();


        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($cat_slug . '?per_page=' . $request->per_page . '&farms=' . $farmers . '&cat=' . $categories);
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($cat_slug . '?per_page=' . $request->per_page . '&farms=&cat=' . $categories);
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($cat_slug . '?per_page=' . $request->per_page . '&farms=' . $farmers . '&cat=');
        }

        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getResultsForSearchByName(Request $request)
    {

        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $per_page = $request->per_page;
        $farmers = implode(",", $selected_farmers);
        $categories = implode(",", $selected_categories);
        $project_url = URL::to('/');
        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=&cat=' . $categories);
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath($project_url . '/search_by_name?product=' . $request->search_product_name . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
        }


        $data['per_page'] = $per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getSearchResultsForTagPage(Request $request)
    {
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $tag_id = $request->tag_id;
        $tagname = Tag::where('id', $tag_id)->pluck('name')->first();
        $data['tag_name'] = $tagname;
        $farmers = implode(",", $selected_farmers);
        $categories = implode(",", $selected_categories);
        $project_url = URL::to('/');
        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=' . $farmers . '&cat=' . $categories);
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=&cat=' . $categories);
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($request->per_page);
            $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&farms=' . $farmers . '&cat=');
        }


        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }

    public function getLatestProducts(Request $request)
    {

        $data['latest_products'] = '';
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($request->per_page);
        $isShopPage = $request->isShopPage;
        $isSearchPage = $request->isSearchPage;
        $isSearchByCategoryPage = $request->isSearchByCategoryPage;
        $per_page = $request->per_page;
        if ($isSearchPage == 'true') {
            $project_url = URL::to('/');
            $data['products']->setPath($project_url . '/search?zip_code=' . $request->zip_code . '&per_page=' . $request->per_page . '&latest_products=yes');
        } else if ($isShopPage == 'true') {
            $data['latest_products'] = true;
            $data['products']->setPath('shop?per_page=' . $per_page);
        } else if ($isSearchByCategoryPage == 'true') {
            $cat_slug = Category::where('id', $request->cat_id)->pluck('slug')->first();
            //set custom url for pagination
            $project_url = URL::to('/');
            $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page);
        }
        $data['per_page'] = $request->per_page;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getLatestProductsForTagPage(Request $request)
    {
        $tag_id = $request->tag_id;
        $tagname = Tag::where('id', $tag_id)->pluck('name')->first();
        $product_ids = Tag::where('name', $tagname)->pluck('product_id');

        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($request->per_page);
        //adjust tag id in pagination links
        $project_url = URL::to('/');
        $data['products']->setPath($project_url . '/shop?per_page=' . $request->per_page . '&latest_products=yes');
        //set text
        $data['tag_name'] = $tagname;

        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
    public function getLatestProductsForSearchByName(Request $request)
    {
        $per_page = $request->per_page;
        $search_product_name = $request->search_product_name;
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->orderBy('id', 'desc')->paginate($request->per_page);
        //adjust tag id in pagination links
        //set custom url for pagination
        $project_url = URL::to('/');
        $data['products']->setPath($project_url . '/search_by_name?product=' . $search_product_name . '&per_page=' . $per_page . '&latest_products=yes');
        $data['per_page'] = $per_page;
        $data['pagination_search'] = true;
        return view('frontend.partails.ajax_load_more_products_for_shop_page', $data);
    }
}
