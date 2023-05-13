<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

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
        // User::factory(50)->create();

        // User
        User::create([
            'name' => 'ROOT',
            'username' => 'root',
            'email' => 'root@root.com',
            'password' => bcrypt('root'),
            'address' => 'Kosong',
            'remember_token' => Str::random(10)
        ]);

        // Categories
        Category::create([
            'name' => 'Kain Drill',
            'short_name' => 'kain-drill'
        ]);

        Category::create([
            'name' => 'Kain Oxford',
            'short_name' => 'kain-oxford'
        ]);

        Category::create([
            'name' => 'Kain Katun',
            'short_name' => 'kain-katun'
        ]);

        Category::create([
            'name' => 'Kain Polyster',
            'short_name' => 'kain-polyster'
        ]);

        Category::create([
            'name' => 'Kain Thalistik',
            'short_name' => 'kain-thalistik'
        ]);

        Category::create([
            'name' => 'Kain Denim',
            'short_name' => 'kain-denim'
        ]);

        Category::create([
            'name' => 'Kain Corduroy',
            'short_name' => 'kain-corduroy'
        ]);

        // Kebaya
        Category::create([
            'name' => 'Kain Brokat',
            'short_name' => 'kain-brokat'
        ]);

        Category::create([
            'name' => 'Kain Organdi',
            'short_name' => 'kain-organdi'
        ]);

        Category::create([
            'name' => 'Kain Sutra',
            'short_name' => 'kain-sutra'
        ]);

        Category::create([
            'name' => 'Kain Chiffron',
            'short_name' => 'kain-chiffron'
        ]);

        Category::create([
            'name' => 'Kain Tulle',
            'short_name' => 'kain-tulle'
        ]);

        Category::create([
            'name' => 'Kain Jumputan',
            'short_name' => 'kain-jumputan'
        ]);

        Category::create([
            'name' => 'Kain Satin',
            'short_name' => 'kain-satin'
        ]);

        Category::create([
            'name' => 'Kain Wolfis',
            'short_name' => 'kain-wolfis'
        ]);

        Category::create([
            'name' => 'Kain Balotelli',
            'short_name' => 'kain-balotelli'
        ]);

        Category::create([
            'name' => 'Kain Organza',
            'short_name' => 'kain-organza'
        ]);

        // Products
        // Product::create([
        //     'name' => 'Baju Batik',
        //     'category_id' => rand(1, 17),
        //     'short_name' => 'baju-batik',
        //     'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis animi iste dignissimos corrupti qui quam minus dicta voluptatum adipisci ratione!',
        //     'price' => '50000',
        //     'stock' => rand(1, 20),
        //     'product_type' => 'local',
        //     'image_path' => '/uploads/products/1679711145.jpg'
        // ]);

        // Product::create([
        //     'name' => 'Baju Tidur',
        //     'category_id' => rand(1, 17),
        //     'short_name' => 'baju-tidur',
        //     'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis animi iste dignissimos corrupti qui quam minus dicta voluptatum adipisci ratione!',
        //     'price' => '30000',
        //     'stock' => rand(1, 20),
        //     'product_type' => 'external',
        //     'image_path' => '/uploads/products/1679733363.jpg'
        // ]);
    }
}
