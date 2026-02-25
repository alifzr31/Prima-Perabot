<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Kursi',
            'Rak & Lemari Serbaguna',
            'Baskom, Ember, Jolang & Bak Serbaguna',
            'Thinwall',
            'Storage Box',
            'Wajan',
            'Gas & Regulator',
            'Hampers & Parcel Lebaran',
        ];

        foreach ($names as $name) {
            $slug = Str::slug($name);

            Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => 'Nyaman & Ergonomis',
                    'icon' => null,
                    'is_active' => true,
                    'is_popular' => false,
                    'is_highlighted' => false,
                ]
            );
        }
    }
}
