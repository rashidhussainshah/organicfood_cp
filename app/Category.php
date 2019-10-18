<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getProducts(){
       return $this->hasMany(Product::class,'cat_id','id')->with('getRatings','getFeaturedImage', 'getUnit');
   }

   public function countCategoryProducts(){
       return $this->hasMany(Product::class,'cat_id','id');
   }
}
