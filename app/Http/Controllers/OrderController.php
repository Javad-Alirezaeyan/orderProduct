<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutValidationRequest;
use App\lib\StripePayment;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;

class OrderController extends Controller
{
    //

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this method shows the view of checkout to insert card info and customer
     */
    public function checkout(Request $request)
    {
        $productId = $request->input('productId', null);
        $product = Product::findOrFail($productId);

        return view("order.checkout",
            [
                'product'=>$product
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * This method shows the list of all orders
     */
    public function list()
    {

        $orders = DB::table("order")->paginate(DEFAULT_TABLE_ROWS);

        return view("order.list", [
            'orders' => $orders
        ]);
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * This function shows the details of a order
     * Router:  order/{$id}
     */
    public function view($id = null)
    {
        $order = Order::findOrFail($id);
        $products = OrderProduct::fullGet(['order_id'=>$id]);

        return view("order.view",[
            'order' => $order,
            'products' => $products
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * this method register a new orders. The information send by post method including card info, customer, and product information
     */
    public function register(Request $request)
    {
        $card = $request->post('card');
        $product = $request->post('product');
        $customer = $request->post('customer');
        $shippingFee = $request->post('shippingFee');

        //validation data
        $validator = Validator::make($request->all(), [
            'shippingFee' =>'required',
            'customer.firstName' => 'required|min:3',
            'customer.lastName' => 'required|min:3',
            'customer.email' => 'required|email',
            'customer.address' => 'required|min:3',
            'card.cardNumber' => 'required|size:16',
            'card.year' => 'required|size:4',
            'card.month'=> 'required|max:2',
            'card.cvv' => 'required|size:3',
            'product.id' => 'required|integer'
        ]);
        if($validator->fails()){
            return Response::json($validator->errors(), 400);
        }

        if(! Product::find($product['id'])){
            //if product is invalid, it responses an error
            return Response::json(['product.id'=> "product.id isn't valid"], 400);
        }


        //checking card info
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
                'amount' => ((float) $product['price'] + (float)$shippingFee) * 10  ,
                'currency_code' => CURRENCY,
                'email' => $customer['email'],
                'item_name'=> $product['name'],
                'item_number'=> $product['id'],
            ]
        );
        //save to db if the payment is successful
        if(isset($res['id'])){
            //
            $orderId = $this->saveOrder($product, $card, $customer);
            //sending an email to Admin
            $this->sendNotificationEmail($product, $card, $customer, $orderId);
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

    /**
     * @param $product
     * @param $card
     * @param $customer
     * @param $orderId
     * this function send an notification e-mail to the user and administrator
     */
    private function sendNotificationEmail($product, $card, $customer, $orderId){
        $order = Order::findOrFail($orderId);
        $products = OrderProduct::fullGet(['order_id'=>$orderId]);
        Mail::send('order.reminder', ['order'=>$order, 'products'=> $products], function ($m) use ($customer, $orderId) {
            $m->from('test@fashion.com', 'A new Order');
            $m->to($customer['email'], $customer['firstName']." ".$customer['lastName'])->bcc(env("ADMIN_EMAIL"),
                env("ADMIN_NAME"))->subject("Notification email of order: $orderId!");
        });

    }


}
