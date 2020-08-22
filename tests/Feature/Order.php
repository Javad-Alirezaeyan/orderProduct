<?php

namespace Tests\Feature;

use App\Product;
use Faker\Provider\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Order extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPages()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/orders');
        $response->assertStatus(200);

        $response = $this->get('/products');
        $response->assertStatus(200);

        $response = $this->get('/order/1');
        $response->assertStatus(200);

        $response = $this->get('/order/22222');
        $response->assertStatus(404);

        $response = $this->get('/checkout?productId=1');
        $response->assertStatus(200);
    }

    public function testRegisterOrder()
    {
        $product = factory(Product::class)->create();

        $data = [
            'customer' => [
                'firstName' => "Javad",
                'lastName' => "Alirezaeyan",
                'address' => "Test Test Test",
                'email' => "alirezaeyan.javad@gmail.com"
            ] ,
            'card'=>[
                'name' => "Javad Alirezaeyan",
                'cardNumber' => '4242424242424242',
                'year' => '2022',
                'month' => '9',
                'cvv' => '233'
            ],
            'product'=> $product,
            'shippingFee' => 10
        ];

        $this->json('POST', 'registerOrder', $data)
            ->assertStatus(200)->assertJson([
                'orderId'
            ]);

    }

    public function testFailCustomerInfoRegisterOrder()
    {
        $product = factory(Product::class)->create();


        $data = [
            'customer' => [
                'lastName' => "g",
                'address1' => "Test Test ",
                'email' => "alirezaeyan"
            ] ,
            'card'=>[
                'name' => "Javad Alirezaeyan",
                'cardNumber' => '4242424242424242',
                'year' => '2022',
                'month' => '9',
                'cvv' => '233'
            ],
            'product'=> $product,
            'shippingFee' => 10
        ];

        $this->json('POST', 'registerOrder', $data)
            ->assertStatus(400)->assertJson([
                'customer.firstName' => ["The customer.first name field is required."],
                'customer.lastName' => ["The customer.last name must be at least 3 characters."],
                'customer.email' => ["The customer.email must be a valid email address."],
                'customer.address' => ["The customer.address field is required."],
            ]);

    }

    public function testFailCardInfoRegisterOrder()
    {
        $product = factory(Product::class)->create();


        $data = [
            'customer' => [
                'firstName' => "Javad",
                'lastName' => "Alirezaeyan",
                'address' => "Test Test Test",
                'email' => "alirezaeyan.javad@gmail.com"
            ] ,
            'card'=>[
                'name' => "Javad Alirezaeyan",
                'cardNumber' => '424242424242424233',
                'year' => '203',
                'month' => '9',
                'cvv' => '9'
            ],
            'product'=> $product,
            'shippingFee' => 10
        ];

        $this->json('POST', 'registerOrder', $data)
            ->assertStatus(400)->assertJson([
                'card.cardNumber' => ["The card.card number must be 16 characters."],
                'card.year' => ["The card.year must be 4 characters."],
                'card.cvv' => ["The card.cvv must be 3 characters."],
            ]);

    }


    public function testWrongCardInfoRegisterOrder()
    {
        $product = factory(Product::class)->create();


        $data = [
            'customer' => [
                'firstName' => "Javad",
                'lastName' => "Alirezaeyan",
                'address' => "Test Test Test",
                'email' => "alirezaeyan.javad@gmail.com"
            ] ,
            'card'=>[
                'name' => "Javad Alirezaeyan",
                'cardNumber' => '4242424242424232',
                'year' => '2020',
                'month' => '9',
                'cvv' => '234'
            ],
            'product'=> $product,
            'shippingFee' => 10
        ];

        $this->json('POST', 'registerOrder', $data)
            ->assertStatus(400)->assertJson([
                "message" => "Your card number is incorrect."
            ]);

        $data = [
            'customer' => [
                'firstName' => "Javad",
                'lastName' => "Alirezaeyan",
                'address' => "Test Test Test",
                'email' => "alirezaeyan.javad@gmail.com"
            ] ,
            'card'=>[
                'name' => "Javad Alirezaeyan",
                'cardNumber' => '4242424242424242',
                'year' => '2001',
                'month' => '9',
                'cvv' => '234'
            ],
            'product'=> $product,
            'shippingFee' => 10
        ];

        $this->json('POST', 'registerOrder', $data)
            ->assertStatus(400)->assertJson([
                "message" => "Your card's expiration year is invalid."
            ]);


    }

}
