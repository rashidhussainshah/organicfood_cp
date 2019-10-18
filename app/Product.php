<?php

namespace App;


//use Gloudemans\Shoppingcart\Contracts\Buyable;
use App\User;
use App\UserLocations;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;
    public static function getPerPageProductsOfUserSearch($request, $zip_code = null, $cat_id = null)
    {
        $selected_categories = $request->selected_categories ? $request->selected_categories : [];
        $selected_farmers = $request->selected_farmers ? $request->selected_farmers : [];
        $per_page = $request->per_page;
        //convert array to string to becuase it will used for pagination
        $farmers = implode(",", $selected_farmers);
        $categories = implode(",", $selected_categories);
        $project_url = URL::to('/');
        //search by category
        if ($cat_id != null) {
            $cat_slug = Category::where('id', $cat_id)->pluck('slug')->first();
            //set custom url for pagination
            $project_url = URL::to('/');

            if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                    ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
                return $data['products'];
            } else if (!empty($selected_categories) && (empty($selected_farmers))) {
                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                    ->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=&cat=' . $categories);
                return $data['products'];
            } else if (!empty($selected_farmers) && (empty($selected_categories))) {
                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                    ->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/category/' . $cat_slug . '?per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
                return $data['products'];
            } else {
                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')
                    ->where('cat_id', $cat_id)
                    ->orderBy('id', 'desc')->paginate($per_page);
            }
        }

        // search by zip
        if ($zip_code != null) {


            if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                    ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
                return $data['products'];
            } else if (!empty($selected_categories) && (empty($selected_farmers))) {
                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                    ->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=&cat=' . $categories);
                return $data['products'];
            } else if (!empty($selected_farmers) && (empty($selected_categories))) {
                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                    ->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
                return $data['products'];
            } else {
                $farmer_ids = User::where('type', 'farmer')
                    ->where('zip_code', $zip_code)
                    ->where('is_active', 1)
                    ->pluck('id');

                $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')
                    ->whereIn('user_id', $farmer_ids)
                    ->orderBy('id', 'desc')->paginate($per_page);
                $data['products']->setPath($project_url . '/search?zip_code=' . $zip_code . '&per_page=' . $per_page);
                return $data['products'];
            }
        }

        //search by shop
        if ((!empty($selected_categories)) && (!empty($selected_farmers))) {

            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->WhereIn('user_id', $selected_farmers)->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmers . '&cat=' . $categories);
            return $data['products'];
        } else if (!empty($selected_categories) && (empty($selected_farmers))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('cat_id',  $selected_categories)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=&cat=' . $categories);
            return $data['products'];
        } else if (!empty($selected_farmers) && (empty($selected_categories))) {
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')->whereIn('user_id',  $selected_farmers)
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page . '&farms=' . $farmers . '&cat=');
            return $data['products'];
        } else {
            $data['nearby_products'] = true;
            $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getUser')
                ->orderBy('id', 'desc')->paginate($per_page);
            $data['products']->setPath('shop?per_page=' . $per_page);
            return $data['products'];
        }
    }
    public static function getProductOwnId($product_id)
    {
        return Product::where('id', $product_id)->pluck('user_id')->first();
    }
    public function getTagProducts()
    {
        return $this->hasMany(Tag::class, 'product_id', 'id');
    }
    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function getLocation()
    {
        return $this->hasOne(UserLocations::class, 'id', 'location_id');
    }

    public function getUnit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }

    public function getRatings()
    {
        return $this->hasMany(Rating::class, 'product_id', 'id');
    }

    public function getFeaturedImage()
    {
        return $this->hasOne(ProductImages::class, 'product_id', 'id')->where('is_featured', '1');
    }

    public function getProductImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->where('is_featured', '0');
    }
    public function getUnitDetail()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function orderProduct()
    {
        return $this->hasMany(OrderProducts::class, 'product_id', 'id');
    }
}
