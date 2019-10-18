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

class CategoryController extends Controller
{
    public function search($id) {
        $data['categories'] = Category::with('getProducts')->where('id', $id)->first();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'Search Category Result', 'successData' => $success), 200, []);
    
    }
    
    public function searchMultiple(Request $request) {
        
        if($request->category_id  && !$request->farm_id){
            
            $categories_id = $request->category_id;
            $data['products'] = Product::with('getCategory','getUnit' , 'getFeaturedImage','getRatings')->whereIN('cat_id', $categories_id)->get();
            $success = $data;
            return Response::json(array('status' => 'success', 'successMessage' => 'Search Category Result', 'successData' => $success), 200, []);
            
        } else if(!$request->category_id  && $request->farm_id){ 
            
            $farm_id = $request->farm_id;
            $data['products'] = Product::with('getCategory','getUnit' , 'getFeaturedImage','getRatings')->whereIN('cat_id', $farm_id)->get();
            $success = $data;
            return Response::json(array('status' => 'success', 'successMessage' => 'Search Category Result', 'successData' => $success), 200, []);
            
        } else if($request->category_id  && $request->farm_id){ 
            
            $categories_id = $request->category_id;
            $farm_id = $request->farm_id;
            $data['products'] = Product::with('getCategory','getUnit' , 'getFeaturedImage','getRatings')->whereIN('cat_id', $categories_id)->whereIN('user_id', $farm_id)->get();
            $success = $data;
            return Response::json(array('status' => 'success', 'successMessage' => 'Search Category Result', 'successData' => $success), 200, []);
            
        } else {
            return Response::json(array('status' => 'error', 'errorMessage' => 'No Category Selected'), 200, []);
        }
    }
}
