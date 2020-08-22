<?php

namespace App\Http\Controllers;

use App\lib\StripePayment;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Stripe\Customer;

class OrderController extends Controller
{
    //

    public function checkout(Request $request)
    {
        $productId = $request->input('productId', null);
        $product = Product::findOrFail($productId);

        return view("order.checkout",
            [
                'product'=>$product
            ]);
    }

    public function list()
    {



        $stripe = new \Stripe\StripeClient(
            'pk_test_51HILVmH3zr450lLqw1PGsMMEpU2Gh11zg68pREYwaSsamBYO3x3pZR5zegGObiwQyyXC6eo8vyz0dfyiWq73edut00aM18Rx3w'
        );
        try{
            $res = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 8,
                    'exp_year' => 2021,
                    'cvc' => '314',
                ],
            ]);

        }
        catch (\Exception $e){
            var_dump($e->getMessage());
        }

       $stripe = new StripePayment();
       $res = $stripe->chargeAmountFromCard(
      ['amount'=>200,
      'currency_code'=>'usd',
      'item_name'=>'test',
      'item_number'=>123,
      'email'=>'a@gmail.com','token'=> 'tok_visa']);
       dd($res);


        $orders = DB::table("order")->paginate(DEFAULT_TABLE_ROWS);

        return view("order.list", [
            'orders' => $orders
        ]);
    }

    public function view($id = null)
    {
        $order = Order::findOrFail($id);

        $products = OrderProduct::fullGet(['order_id'=>$id]);

        return view("order.view",[
            'order' => $order,
            'products' => $products
        ]);
    }

    public function register(Request $request)
    {

        $card = $request->input('card');
        $product = $request->input('product');
        $customer = $request->input('customer');
        //validation data

        //check card info
        $stripe = new StripePayment();
        list($res, $code) = $stripe->addCard($card);

        if($res === false){
            //card is invalid
            return Response::json(['message'=> $code], 400);
        }
        //pay
        $res = $stripe->chargeAmountFromCard(
            [
                'token' => 'tok_visa',
                'amount' => (int) $product['price'] ,
                'currency_code' => CURRENCY,
                'email' => $customer['email'],
                'item_name'=> $product['name'],
                'item_number'=> $product['id'],
            ]
        );

        //save to db
        if(isset($res['id'])){
            $orderId = $this->saveOrder($product, $card, $customer);
            return Response::json(['orderId'=> $orderId]);
        }
        else{
            return Response::json(['message'=> "error in pay"], 400);
        }

    }

    private function saveOrder($product, $card, $customer){

        $product = Product::find($product['id']);

        $order = new Order();
        $order->total_product_value = $product->price;
        $order->total_shipping_value = SHIPPING_Fee;
        $order->client_name = $customer['firstName'] + " " + $customer['lastName'];
        $order->client_address = $customer['address'];
        $order->client_email = $customer['address'];
        $order->client_card = json_encode($card);
        $order->save();

        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product->id;
        $orderProduct->price = $product->price;
        $orderProduct->save();
    }
}
