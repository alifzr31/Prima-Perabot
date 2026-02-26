<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'putri@gmail.com',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Putri Hanifah Maharanisa',
                'password' => bcrypt('putri123'),
                'role' => 'superadmin',
            ]
        );
    }
}
