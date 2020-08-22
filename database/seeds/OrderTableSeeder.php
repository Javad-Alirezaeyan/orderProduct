<?php

use Illuminate\Database\Seeder;

use App\Order;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Order::truncate();

        $faker = \Faker\Factory::create();
        //  a few Order in our database:
        for ($i = 0; $i < 50; $i++) {
            Order::create([
                'total_product_value' => $faker->numberBetween(200, 1000),
                'total_shipping_value'=> 10,
                'client_name'=> $faker->name,
                'client_address'=>$faker->address,
                'client_email'=>$faker->safeEmail,
                'client_card' => json_encode(
                    [
                        'name' => $faker->firstName,
                        'cardNumber' => $faker->creditCardNumber,
                        'year' => $faker->year,
                        'month' => $faker->month,
                        'cvv' => $faker->numberBetween(100, 999)
                    ]
                )
            ]);
        }
    }
}
