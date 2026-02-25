<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File as HttpFile;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::files(database_path('seeders/brand-logos'));

        foreach ($files as $file) {
            $rawName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $brandName = Str::title($rawName);

            $slug = Str::slug($brandName);

            $storedPath = Storage::disk('public')->put(
                'brands/' . $slug,
                new HttpFile($file->getRealPath())
            );

            Brand::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $brandName,
                    'description' => null,
                    'logo' => $storedPath,
                    'is_active' => true,
                    'is_highlighted' => false,
                ]
            );
        }
    }
}
