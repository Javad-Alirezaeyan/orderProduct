<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/20/20
 * Time: 6:23 PM
 */

?>


@extends('layouts.master')
@section('title', "Orders")
@section('content')


    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Orders</h6>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Total Price</th>
                <th scope="col">Shipping price</th>
                <th scope="col">Client Name</th>
                <th scope="col">Date</th>
                <th scope="col">State</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $order->total_product_value }}</td>
                    <td>{{ $order->total_shipping_value }}</td>
                    <td>{{ $order->client_name }}</td>
                    <td>{{  $order->created_at }}</td>
                    <td><span class="badge badge-success">Success</span></td>
                    <td>
                        <a href="{{ subdirUrl("order/". $order->id) }}" class="btn btn-info btn-sm " role="button" aria-disabled="true"> View</a>

                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
@endsection
