<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])->latest()->get();

        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::get();
        $categories = Category::get();

        return view('admin.pages.product.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'is_active'      => 'nullable|boolean',
            'is_hot_sale' => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Product::create($validated);

        return redirect()->route('dashboard.product')->with('success', 'Produk berhasil ditambahkan.');
    }
}
