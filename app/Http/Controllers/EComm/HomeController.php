<?php

namespace App\Http\Controllers\EComm;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->where('is_highlighted', true)->limit(8)->get();
        $brands = Brand::where('is_active', true)->where('is_highlighted', true)->limit(25)->orderBy('name', 'asc')->get();
        $products = Product::where('is_active', true)->where('is_highlighted', true)->where('is_hot_sale', true)->limit(4)->get();

        return view('customer.pages.home.index', compact('categories', 'brands', 'products'));
    }
}
