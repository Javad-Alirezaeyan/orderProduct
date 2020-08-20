<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Brand::truncate();

        $faker = \Faker\Factory::create();

        // create a few Brand in our database:
        for ($i = 0; $i < 50; $i++) {
            Brand::create([
                'name' => $faker->text(20),
            ]);
        }
    }
}
