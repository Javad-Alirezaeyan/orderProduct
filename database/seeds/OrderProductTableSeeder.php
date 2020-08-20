<?php

use Illuminate\Database\Seeder;
use App\OrderProduct;
use App\Order;
use App\Product;
class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OrderProduct::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Brand in our database:
        $orders = Order::all();

        foreach ($orders as $order){
            for ($i = 0; $i < $faker->numberBetween(1, 5); $i++) {
                $product = Product::all()->random();
                OrderProduct::create([
                    'order_id' =>  $order->id,
                    'product_id'=> $product->id,
                    'price' => $product->price,
                    'count' => $faker->numberBetween(1, 5)
                ]);
            }
        }

    }
}
