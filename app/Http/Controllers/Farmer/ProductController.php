<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\FarmOrder;
use App\Category;
use App\Unit;
use App\User;
use App\Product;
use App\Tag;
use App\ProductImages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ProductController extends Controller {

    public function addProduct() {

        $data['categories'] = Category::all();

        $data['units'] = Unit::all();
        $data['user'] = User::where('id', Auth::user()->id)->first();
        return view('farmer.add_product', $data);
    }

    public function editProduct($id) {

        $data['categories'] = Category::all();
        $data['product'] = Product::where('id', $id)->first();
//       dd($data['product']->getProductImages);
        $data['units'] = Unit::all();
        $data['user'] = User::where('id', Auth::user()->id)->first();
        return view('farmer.edit_product', $data);
    }

    public function postProduct(Request $request) {
//        dd($request->all());
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_tags' => 'required',
//            'image' => 'required',
//            'product_images' => 'required',
        ]);
        $product = new Product;
        $product->name = $request->product_name;
        $product->slug = Str::slug( $request->product_name, '-');
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->quantity = $request->product_quantity;
        $product->location_id = $request->product_location;
        $product->location_id = $request->product_location;
        $product->unit_id = $request->unit;
        $product->cat_id = $request->category;
        $product->is_draft = $request->is_draft;
        $product->user_id = Auth::user()->id;
        $product->save();
        if($request->featured_image)
        { 
        $image_path = addFile($request->featured_image, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 1;
        $featured_image->save();
    }
         if($request->image_1)
        { 
        $image_path = addFile($request->image_1, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_2)
        { 
        $image_path = addFile($request->image_2, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_3)
        { 
        $image_path = addFile($request->image_3, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_4)
        { 
        $image_path = addFile($request->image_4, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }

        foreach ($request->product_tags as $tag)
        {
            $tags=new Tag;
            $tags->name=$tag;
            $tags->user_id=Auth::user()->id;
            $tags->product_id=$product->id;
            $tags->save();
        }
        return redirect('farmer/farmer_products');
    }

    public function editpostProduct(Request $request) {
//        dd($request->all());
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_tags' => 'required',
//            'image' => 'required',
//            'product_images' => 'required',
        ]);
        $product =  Product::where('id',$request->id)->first();
        $product->name = $request->product_name;
        $product->slug = Str::slug( $request->product_name, '-');
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->quantity = $request->product_quantity;
        $product->location_id = $request->product_location;
        $product->location_id = $request->product_location;
        $product->unit_id = $request->unit;
        $product->cat_id = $request->category;
        $product->is_draft = $request->is_draft;
        $product->user_id = Auth::user()->id;
        $product->save();
        if($request->featured_image)
        { 
        $image_path = addFile($request->featured_image, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image =new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 1;
        $featured_image->save();
    }
         if($request->image_1)
        { 
        $image_path = addFile($request->image_1, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_2)
        { 
        $image_path = addFile($request->image_2, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_3)
        { 
        $image_path = addFile($request->image_3, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }
         if($request->image_4)
        { 
        $image_path = addFile($request->image_4, 'public/images/product_images/');
            if ($image_path == FALSE) {
            return redirect()->back()->with('error', 'Invalid File Selection.');
        }
        $featured_image = new ProductImages;
        $featured_image->path = $image_path;
        $featured_image->original_path = $image_path;
        $featured_image->product_id = $product->id;
        $featured_image->product_id = $product->id;
        $featured_image->is_featured = 0;
        $featured_image->save();
    }

        foreach ($request->product_tags as $tag)
        {
            $tags=new Tag;
            $tags->name=$tag;
            $tags->user_id=Auth::user()->id;
            $tags->product_id=$product->id;
            $tags->save();
        }
        return redirect('farmer/farmer_products');
    }

    public function products() {
        $data['tab'] = 'product';
        $data['products'] = Product::withTrashed()->where('user_id', Auth::user()->id)->with('orderProduct')->with('getFeaturedImage')->orderBy('created_at','DESC')->get();
        $data['products_count'] = Product::withTrashed()->where('user_id', Auth::user()->id)->with('getFeaturedImage')->count();
        $data['published_products'] = Product::where('user_id', Auth::user()->id)->with('orderProduct')->with('getFeaturedImage')->where('is_draft', 0)->orderBy('created_at','DESC')->get();
        $data['published_products_count'] = Product::where('user_id', Auth::user()->id)->with('getFeaturedImage')->where('is_draft', 0)->count();
        $data['draft_products'] = Product::where('user_id', Auth::user()->id)->with('orderProduct')->with('getFeaturedImage')->where('is_draft', 1)->orderBy('created_at','DESC')->get();
        $data['draft_products_count'] = Product::where('user_id', Auth::user()->id)->with('getFeaturedImage')->where('is_draft', 1)->count();
        $data['trash_products'] = Product::onlyTrashed()->where('user_id', Auth::user()->id)->with('getFeaturedImage')->orderBy('created_at','DESC')->get();
        $data['trash_products_count'] = Product::onlyTrashed()->where('user_id', Auth::user()->id)->with('getFeaturedImage')->count();
//             dd($data['products'][1]->orderProduct);
        return view('farmer.products', $data);
    }

    public function calendarOrder($days) {
        $dt = Carbon::now()->addDays(-$days);
        $dt_now = Carbon::now();
        $date = $dt->toDateString();
        $date_now = $dt_now->toDateString();
        $data['tab'] = 'dashboard';
        $data['days'] = $days;
        $data['orders'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->with('getOrderProducts.getProduct.getUnit')->get();
//        dd( $data['orders']);
        return view('farmer.main_content', $data);
    }

    public function calendar($days) {
        $dt = Carbon::now()->addDays(-$days);
        $dt_now = Carbon::now();
        $date = $dt->toDateString();
        $date_now = $dt_now->toDateString();

        $data['days'] = $days;
        $data['tab'] = 'orders';
        $data['orders'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->with('getOrderProducts.getProduct.getUnit')->orderBy('created_at','DESC')->get();
        $data['orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->count();
        $data['trashed_orders'] = FarmOrder::onlyTrashed()->where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->with('getOrderProducts.getProduct.getUnit')->orderBy('created_at','DESC')->get();
        $data['trashed_orders_count'] = FarmOrder::onlyTrashed()->where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->count();
        $data['processing_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'processing')->with('getOrderProducts.getProduct.getUnit')->orderBy('created_at','DESC')->get();
        $data['processing_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'processing')->count();
        $data['onhold_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'onhold')->with('getOrderProducts.getProduct.getUnit')->orderBy('created_at','DESC')->get();
        $data['onhold_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'onhold')->count();
        $data['cancelled_orders'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'cancelled')->with('getOrderProducts.getProduct.getUnit')->orderBy('created_at','DESC')->get();
        $data['cancelled_orders_count'] = FarmOrder::where('farm_id', Auth::user()->id)->whereBetween('created_at', [$date, $date_now])->where('status', 'cancelled')->count();

//        dd( $data['orders']);
        return view('farmer.orders', $data);
    }

    public function productDelete($id) {
        $data['tab'] = 'product';
        Product::where('id', $id)->delete();
        return redirect()->back()->with('error', 'Product deleted successfully');
    }
       public function deleteImage(Request $request) {
//           dd($request->all());
        ProductImages::where('id',$request->id)->delete();
     
           response()->json(['status' => 'success', 'message' => 'Image deleted']);
    
    }
      public function deleteTags(Request $request) {
    
        Tag::where('product_id',$request->id)->delete();
     
           response()->json(['status' => 'success', 'message' => 'Tag deleted']);
    
    }
}
