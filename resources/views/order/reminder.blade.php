<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/22/20
 * Time: 11:22 PM
 */

?>
<style>
    .table {
        border-collapse: collapse !important;
    }
    .table td,
    .table th {
        background-color: #fff !important;
    }
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6 !important;
    }
    .table-dark {
        color: inherit;
    }
    .table-dark th,
    .table-dark td,
    .table-dark thead th,
    .table-dark tbody + tbody {
        border-color: #dee2e6;
    }
    .table .thead-dark th {
        color: inherit;
        border-color: #dee2e6;
    }

    card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    .card > hr {
        margin-right: 0;
        margin-left: 0;
    }

    .card > .list-group {
        border-top: inherit;
        border-bottom: inherit;
    }

    .card > .list-group:first-child {
        border-top-width: 0;
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }

    .card > .list-group:last-child {
        border-bottom-width: 0;
        border-bottom-right-radius: calc(0.25rem - 1px);
        border-bottom-left-radius: calc(0.25rem - 1px);
    }

    .card > .card-header + .list-group,
    .card > .list-group + .card-footer {
        border-top: 0;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
    }






</style>
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