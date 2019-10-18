<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
     use HasApiTokens, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



   public function getDetail(){
       return $this->hasOne(UserDetails::class,'user_id','id');
   }

   public function getLocation(){
       return $this->hasMany(UserLocations::class,'user_id','id');
   }

   public function getProducts(){
       return $this->hasMany(Product::class,'user_id','id')->with('getRatings','getFeaturedImage','getProductImages','getUnit','getCategory');
   }

}
