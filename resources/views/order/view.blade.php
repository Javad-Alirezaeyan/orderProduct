<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/22/20
 * Time: 9:43 AM
 */

?>
@extends('layouts.master')
@section('title', "View order")
<style>
    .title-customer{
        font-weight: bold;
        font-size: 15px;
    }
</style>
@section('content')

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div  style=" text-align:center;font-size: 18px;color: #8898aa; vertical-align: center" >
            order Id: {{ $order->id }}
        </div>
        <div class="">
            <div class="">
                Summary
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Count</th>
                    <th scope="col">Price</th>
                    <th scope="col">total Price</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($products as $product)
                    <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $product->productName }}</td>
                    <td>{{ $product->brandName }}</td>
                    <td>{{ $product->count }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price * $product->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            <div >
                    <div class="col-md-12" style="height: 40px" >
                        <span class="text-left font-weight-bold "> Shipping Fee</span>
                        <span class="float-right font-weight-bold"> {{ $order->total_shipping_value }}</span>
                    </div>

                    <div class="col-md-12" style="height: 40px;background-color: #1b1e21; color: white" >
                        <span style="font-size: 20px" class="text-left  font-weight-bold "> Amount</span>
                        <span class="float-right font-weight-bold"> {{ $order->total_product_value + $order->total_shipping_value  }}</span>
                    </div>

            </div>
        </div>


        <div class="card" style="margin-top: 20px">
            <div class="card-header">
                Customer
            </div>
            <div class="card-body">
                <div>
                    <span class="title-customer" > Name:</span>
                    <span>{{ $order->client_name }}</span>
                </div>
                <div>
                    <span class="title-customer"> Address:</span>
                    <span>{{ $order->client_address }}</span>
                </div>
                <div>
                    <span class="title-customer"> Email:</span>
                    <span>{{ $order->client_email }}</span>
                </div>
            </div>
        </div>

        <?php $card = json_decode($order->client_card, true) ?>
        <div class="card" style="margin-top: 20px">
            <div class="card-header">
                Card Info
            </div>
            <div class="card-body">
                <div>
                    <span class="title-customer" > Card Number:</span>
                    <span>{{ $card['cardNumber'] }}</span>
                </div>
                <div>
                    <span class="title-customer"> Expiration:</span>
                    <span>{{ $card['year']."-". $card['month']}}</span>
                </div>
                <div>
                    <span class="title-customer"> CVV:</span>
                    <span>{{ $card['cvv'] }}</span>
                </div>
            </div>
        </div>
    </div>


@endsection
