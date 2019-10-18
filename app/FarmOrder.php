<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FarmOrder extends Model
{
     use SoftDeletes;
    protected $table = 'orders_farm';
     public function getOrderProducts() {
        return $this->hasMany(OrderProducts::class, 'order_farm_id', 'id');
    }
        public function getUser() {
        return $this->belongsTo(User::class, 'farm_id', 'id');
    }
       public function getOrder() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
