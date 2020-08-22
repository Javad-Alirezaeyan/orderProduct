<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutValidationRequest;
use App\lib\StripePayment;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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

        //validation data
        $validator = Validator::make($request->all(), [
            'shippingFee' =>'required',
            'customer.firstName' => 'required|min:3',
            'customer.lastName' => 'required|min:3',
            'customer.email' => 'required|email',
            'customer.address' => 'required|min:3',
            'card.cardNumber' => 'required|integer|min:16',
            'card.year' => 'required|integer|min:4',
            'card.month'=> 'required|max:2',
            'card.cvv' => 'required|integer|min:3',
            'product.id' => 'required|integer'
        ]);
        if($validator->fails()){
            return Response::json($validator->errors(), 400);
        }

        $card = $request->post('card');
        $product = $request->post('product');
        $customer = $request->post('customer');

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
                'amount' => (int) $product['price'] * 10 ,
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
        $order->client_name = $customer['firstName'] . " "  .$customer['lastName'];
        $order->client_address = $customer['firstName'];
        $order->client_email = $customer['email'];
        $order->client_card = json_encode($card);
        $order->save();

        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product->id;
        $orderProduct->price = $product->price;
        $orderProduct->save();
        return $order->id;
    }
}
