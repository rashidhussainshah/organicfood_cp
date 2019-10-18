<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Unit;
use App\ProductImages;
use Session;
use File;

class AdminController extends Controller
{
    public function allCategories(){
        $data['categories'] = Category::paginate(10);
        $data['title'] = 'Categories';
        return view('layouts.categories',$data);
    }

    public function addCategory(Request $request){
        $cat = new Category();
        $image_path = addFile($request->category_image, 'public/images/category_images/');
        if ($image_path == FALSE)
        {
         return redirect()->back()->with('error','Invalid File Selection.');
        }
        $cat->image_path = $image_path;
        $cat->name = $request->category ;
        $str = strtolower($request->category);
        $cat->slug = preg_replace('/\s+/', '-', $str);
        $cat->save();
        return redirect()->back()->with('success','Category has been added successfully.');
    }

    public function updateCategory(Request $request){
        $cat = Category::where('id',$request->cat_id)->first();
        if($request->has('category_image'))
        {
            if($cat->image_path != '')
            {
                if (File::exists($cat->image_path)) {
                    File::delete($cat->image_path);
                }

            }

        }
        $image_path = addFile($request->category_image, 'public/images/category_images/');
        if ($image_path == FALSE)
        {
            return redirect()->back()->with('error','Invalid File Selection.');
        }
        $cat->name = $request->category;
        $cat->image_path = $image_path;
        $cat->save();
        return redirect()->back()->with('success','Category has been updated successfully.');

    }

    public function deleteCategory($id){

        $cat = Category::where('id',$id)->first();
        if($cat->image_path != '')
        {
            if (File::exists($cat->image_path)) {
                File::delete($cat->image_path);
            }

        }
        $cat->delete();
        return redirect()->back()->with('success','Category has been deleted successfully.');

    }

    public function allProducts(){

        $data['products'] = Product::paginate(10);
        $data['title'] = 'Products';

        return view('layouts.products',$data);
    }

    public function addProduct($id=''){
        if ($id) {
//            dd($id);
            $data['title'] = 'Update Product';
            $data['categories'] = Category::all();
            $data['units'] = Unit::all();
            $data['product'] = Product::where('id',$id)->with('getUser','getUnit','getCategory','getFeaturedImage','getProductImages')->first();

            return view('layouts.add_products', $data);

        } else {

            $data['title'] = 'Add Product';
            $data['categories'] = Category::all();
            $data['units'] = Unit::all();

            return view('layouts.add_products', $data);
        }
    }

    public function postAddProduct(Request $request){
//        dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantityy;
        $product->cat_id = $request->category_id;
        $product->user_id =
        $product->unit_id = $request->unitt_id;
//        $product->slug = 'safsadf';
        $product->save();

        $image_uploaded = false;
        if ($request->hasFile('image')) {
                $product_images  = new ProductImages();
                $product_images->product_id = $product->id;
                $product_images->is_featured = 1;

            $image_path = addFile($request->image, 'public/images/product_images/');
            if ($image_path == true) {
                $product_images->path = $image_path;
                $product_images->original_path = url('/').'/'.$image_path;
                $product_images->save();
            } else {
                $image_uploaded = true;
                return redirect()->back()->with('error', 'Featured Image type not allowed.');
            }
        }

        if ($request->hasFile('product_images')) {

               foreach($request->product_images as $product_images){
//                   dd($product_images->getClientMimeType());
                    $product_image  = new ProductImages();
                    $product_image->product_id = $product->id;
//                    dd($product_images);
            $image_path = addFile($product_images, 'public/images/product_images/');
//            dd($image_path);
            if ($image_path == true) {
//                dd($image_path);
                $product_image->path = $image_path;
                $product_image->save();
            } else {
//                dd('her');
                $image_uploaded = true;
                return redirect()->back()->with('error', 'Product Image type not allowed.');
            }
               }
        }
        return redirect()->back()->with('success','Product has been added successfully.');

    }

    public function updateAddProduct(Request $request){
//        dd($request->all());
        $product = Product::where('id',$request->product_id)->first();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantityy;
        $product->cat_id = $request->category_id;
        $product->unit_id = $request->unitt_id;
        $product->save();

        $image_uploaded = false;
        if ($request->hasFile('image')) {
                $productImg = ProductImages::where('product_id',$product->id)->where('is_featured','1')->delete();
                $product_images  = new ProductImages();
                $product_images->product_id = $product->id;
                $product_images->is_featured = 1;

            $image_path = addFile($request->image, 'public/images/product_images/');
//            dd($image_path);
            if ($image_path == true) {
//                dd($image_path);
                $product_images->path = $image_path;
                $product_images->save();
            } else {
//                dd('her');
                $image_uploaded = true;
                return redirect()->back()->with('error', 'Featured Image type not allowed.');
            }
        }

        if ($request->hasFile('product_images')) {


               foreach($request->product_images as $product_images){
//                   dd($product_images->getClientMimeType());
                    $product_image  = new ProductImages();
                    $product_image->product_id = $product->id;
//                    dd($product_images);
            $image_path = addFile($product_images, 'public/images/product_images/');
//            dd($image_path);
            if ($image_path == true) {
//                dd($image_path);
                $product_image->path = $image_path;
                $product_image->save();
            } else {
//                dd('her');
                $image_uploaded = true;
                return redirect()->back()->with('error', 'Product Image type not allowed.');
            }
               }
        }
        return redirect()->back()->with('success','Product has been updated successfully.');
    }

    public function deleteProductImage(Request $request){

        ProductImages::where('id',$request->id)->delete();
        return response()->json(['status'=>'1']);
    }

    public function productDelete($id){

        Product::where('id',$id)->delete();
        return redirect()->back()->with('success','Product deleted successfully.');

    }

    public function detailProduct($id){
//        dd($id);
        $data['title'] = 'Detail Product';
        $data['detail_product']= Product::where('id',$id)->with('getUser','getUnit','getCategory','getFeaturedImage','getProductImages')->first();
//        $data['detail_product'] = 'Render';

        return view('layouts.add_products',$data);
    }
}
