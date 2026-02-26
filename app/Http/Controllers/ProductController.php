<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
            'images' => 'nullable|array|max:6',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_hot_sale' => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $createProduct = Product::create(Arr::except($validated, ['images']));

        if ($createProduct) {
            if ($request->hasFile('images')) {
                for ($i = 0; $i < count($request->images); $i++) {
                    $image = $request->images[$i];
                    $imagePath = $image->store('products/' . $validated['slug'], 'public');

                    ProductImage::create([
                        'product_id' => $createProduct->id,
                        'image_path' => $imagePath,
                        'sort_order' => $i + 1,
                    ]);
                }
            }

            return redirect()->route('dashboard.product')->with('success', 'Produk berhasil ditambahkan.');
        }
    }

    public function show(Product $product)
    {
        return view('admin.pages.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $brands = Brand::get();
        $categories = Category::get();

        return view('admin.pages.product.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Product $product, Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:6',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'is_active'      => 'nullable|boolean',
            'is_hot_sale' => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $newSlug = Str::slug($validated['name']);
        $oldSlug = $product->slug;

        if ($oldSlug !== $newSlug) {
            $oldFolder = 'products/' . $oldSlug;
            $newFolder = 'products/' . $newSlug;

            if (Storage::disk('public')->exists($oldFolder)) {
                $files = Storage::disk('public')->allFiles($oldFolder);

                foreach ($files as $file) {
                    $newPath = str_replace($oldFolder, $newFolder, $file);
                    Storage::disk('public')->move($file, $newPath);

                    ProductImage::where('product_id', $product->id)
                        ->where('image_path', $file)
                        ->update(['image_path' => $newPath]);
                }

                Storage::disk('public')->deleteDirectory($oldFolder);
            }
        }

        $validated['slug'] = $newSlug;

        $product->update($validated);

        if ($request->hasFile('images')) {
            $productImages = $product->productImage()->get();
            if ($productImages->isNotEmpty()) {
                foreach ($productImages as $productImage) {
                    if ($productImage->image_path && Storage::disk('public')->exists($productImage->image_path)) {
                        Storage::disk('public')->delete($productImage->image_path);
                    }
                }
            }

            $product->productImage()->delete();

            foreach ($request->images as $i => $image) {
                $imagePath = $image->store('products/' . $newSlug, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $i + 1,
                ]);
            }
        }

        return redirect()->route('dashboard.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $productImages = $product->productImage()->get();

        if ($productImages->isNotEmpty()) {
            foreach ($productImages as $productImage) {
                if ($productImage->image_path && Storage::disk('public')->exists($productImage->image_path)) {
                    $folderPath = dirname($productImage->image_path);

                    Storage::disk('public')->deleteDirectory($folderPath);
                }
            }
        }

        $product->delete();

        return redirect()->route('dashboard.product')->with('success', 'Produk berhasil dihapus.');
    }
}
