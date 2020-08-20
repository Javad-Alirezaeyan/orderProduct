<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Brand;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();

        $faker = \Faker\Factory::create();

        // create a few Product in our database:
        for ($i = 0; $i < 200; $i++) {
            Product::create([
                'brand_id' => Brand::all()->random()->id,
                'name' => $faker->text(20),
                'price'=> $faker->numberBetween(1, 100)
            ]);
        }
    }
}
