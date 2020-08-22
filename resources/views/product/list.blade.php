<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/20/20
 * Time: 6:23 PM
 */

?>

@extends('layouts.master')
@section('title', "Products")
@section('content')
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Products</h6>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Brand</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <a href="{{ subdirUrl("checkout") }}?productId={{$product->id}}" class="btn btn-warning btn-sm " role="button" aria-disabled="true"> Buy</a>
                        <a href="{{ subdirUrl("addToBasket")  }}" class="btn btn-danger btn-sm disabled  " title="Unavailable" role="button" aria-disabled="true"> Add to Basket</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
