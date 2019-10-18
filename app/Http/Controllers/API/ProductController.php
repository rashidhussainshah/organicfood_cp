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
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function getProducts()
    {
        $data['products'] = Product::with('getCategory', 'getUnit', 'getProductImages', 'getFeaturedImage', 'getRatings')->get();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of Products', 'successData' => $success), 200, []);
    }
    public function getLatestProducts()
    {
        $data['title'] = 'Organic Food | Home';
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate(16);
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of Recent Products', 'successData' => $success), 200, []);
    }
    public function getHeaderCategories()
    {
        $data['header_categories'] = getMainMenu();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of Header Categories', 'successData' => $success), 200, []);
    }
    public function getExploreCategories()
    {
        $data['explore_categories'] = Category::with('countCategoryProducts')->limit(5)->get();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of explore categories ', 'successData' => $success), 200, []);
    }
}
