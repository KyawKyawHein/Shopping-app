<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use App\Models\ProductSave;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'Admin',
            'role'=>'admin',
            'image'=> 'image/user.png',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('kyawkyawhein')
        ]);

        User::factory()->create([
            'name' => 'User',
            'image'=> 'image/user.png',
            'email' => 'user@gmail.com',
            'password' => bcrypt('kyawkyawhein')
        ]);
        
        // $categories = ['Men Shirt',"Women Shirt","Baby Shirt","Pants","Skirt","UnderWer"];
        Category::factory()->create([
            'name'=>"Men Shirt",
            "slug"=>"men-shirt"
        ]);
        Category::factory()->create([
            'name'=>"Women Shirt",
            "slug"=>"women-shirt"
        ]);
         Category::factory()->create([
            'name'=>"Baby Shirt",
            "slug"=>"baby-shirt"
        ]);
         Category::factory()->create([
            'name'=>"Pants",
            "slug"=>"pants"
        ]);
         Category::factory()->create([
            'name'=>"Skirt",
            "slug"=>"skirt"
        ]);
         Category::factory()->create([
            'name'=>"Underwear",
            "slug"=>"underwear"
        ]);

        Product::factory(20)->create();
        ProductCart::factory(5)->create();
        ProductOrder::factory(5)->create();
        ProductSave::factory(5)->create();
    }
}
