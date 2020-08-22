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
        $rpt = [];
        foreach ($orders as $order){
            $total_price = 0;
            for ($i = 0; $i <= $faker->numberBetween(1, 5); ) {
                $product = Product::all()->random();

                //preventing of repeated product in a order
                if(in_array($product->id, $rpt)) continue;
                array_push($rpt, $product->id);

                $price = (float) $product->price;
                $count = (int) $faker->numberBetween(1, 5);
                OrderProduct::create([
                    'order_id' =>  $order->id,
                    'product_id'=> $product->id,
                    'price' => $price,
                    'count' => $count
                ]);

                $total_price =  $total_price + ($count * $price);
                $i++;
            }
            $order->total_product_value = $total_price + SHIPPING_Fee;
            $order->save();
        }

    }
}
