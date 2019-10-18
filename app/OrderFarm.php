<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderFarm extends Model
{
    protected $table = 'orders_farm';

    public static function getProductOwnId($product_id)
    {
        return Product::where('id', $product_id)->pluck('user_id')->first();
    }
}
