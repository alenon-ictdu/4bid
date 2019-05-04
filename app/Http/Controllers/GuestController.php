<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class GuestController extends Controller
{
    public function showCar($product_id) {
    	$product = Product::where('product_id', $product_id)->first();
    	$productImages = ProductImage::where('product_id', $product->id)->get();
    	$t = date('Y-m-d');
    	
    	return view('guest.show-car')
    		->with('t', $t)
    		->with('productImages', $productImages)
    		->with('product', $product);
    }
}
