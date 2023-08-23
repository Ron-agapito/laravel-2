<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //product model


        // Product::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Product::create(
                [
                    'name' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'price' => $faker->randomFloat(2, 1, 100),
                    'image' => $faker->imageUrl(640, 480, 'animals', true),
                ]
            );

        }

    }
}
