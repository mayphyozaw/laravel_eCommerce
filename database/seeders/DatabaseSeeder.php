<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => "userone",
            'email' => "userone@gmail.com",
            'password' => Hash::make('password')
        ]);

        Admin::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('11223344')
        ]);

        $category = ['Tshirt', 'Hat', 'Electronic', 'Mobile', 'Earphone'];
        foreach ($category as $c) {
            Category::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }
        $brand = ['Samsung', 'Huawei', 'Apple'];
        foreach ($brand as $c) {
            Brand::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }

        $color = ['red', 'green', 'black'];
        foreach ($color as $c) {
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }

        Supplier::create([
            'name' => "Mg Mg",
            'image' => "supplier.png"
        ]);
    }
}
