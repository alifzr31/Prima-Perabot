<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return view('admin.pages.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name'           => 'required|string|max:255|unique:brands,name',
            'description'    => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'is_active'      => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('brands/' . $validated['slug'], 'public');
        }

        Brand::create($validated);

        return redirect()->route('dashboard.brand')->with('success', 'Merk berhasil ditambahkan.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.pages.brand.edit', compact('brand'));
    }

    public function update(Brand $brand, Request $request)
    {
        $validated = $this->validate($request, [
            'name'           => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description'    => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'is_active'      => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
        ]);

        $newSlug = Str::slug($validated['name']);
        $oldSlug = $brand->slug;

        if ($oldSlug !== $newSlug) {
            $oldFolder = 'brands/' . $oldSlug;
            $newFolder = 'brands/' . $newSlug;

            if (Storage::disk('public')->exists($oldFolder)) {
                $files = Storage::disk('public')->allFiles($oldFolder);
                foreach ($files as $file) {
                    $newPath = str_replace($oldFolder, $newFolder, $file);
                    Storage::disk('public')->move($file, $newPath);
                }

                Storage::disk('public')->deleteDirectory($oldFolder);
            }

            if ($brand->logo) {
                $validated['logo'] = str_replace($oldFolder, $newFolder, $brand->logo);
            }
        }

        $validated['slug'] = $newSlug;

        if ($request->hasFile('logo')) {
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('brands/' . $newSlug, 'public');
        }

        $brand->update($validated);

        return redirect()->route('dashboard.brand')->with('success', 'Merk berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            $folderPath = dirname($brand->logo);

            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $brand->delete();

        return redirect()->back()->with('success', 'Merk berhasil dihapus.');
    }
}
