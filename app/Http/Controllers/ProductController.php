<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class ProductController extends Controller
{
public function index()
{
    $obj = Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    dd($obj);
}

}
