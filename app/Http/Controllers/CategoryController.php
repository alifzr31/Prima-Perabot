<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name'           => 'required|string|max:255|unique:categories,name',
            'description'    => 'nullable|string',
            // 'icon'           => 'nullable|string',
            'is_active'      => 'nullable|boolean',
            'is_popular'     => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('dashboard.category')->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $validated = $this->validate($request, [
            'name'           => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description'    => 'nullable|string',
            // 'icon'           => 'nullable|string',
            'is_active'      => 'nullable|boolean',
            'is_popular'     => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('dashboard.category')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.category')->with('success', 'Kategori produk berhasil dihapus.');
    }
}
