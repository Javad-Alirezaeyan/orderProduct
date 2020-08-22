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


    <form id="frmStripePayment" action="" method="post">
        <div class="field-row">
            <label>Card Holder Name</label> <span id="card-holder-name-info"
                                                  class="info"></span><br> <input type="text" id="name"
                                                                                  name="name" class="demoInputBox">
        </div>
        <div class="field-row">
            <label>Email</label> <span id="email-info" class="info"></span><br>
            <input type="text" id="email" name="email" class="demoInputBox">
        </div>
        <div class="field-row">
            <label>Card Number</label> <span id="card-number-info"
                                             class="info"></span><br> <input type="text" id="card-number"
                                                                             name="card-number" class="demoInputBox">
        </div>
        <div class="field-row">
            <div class="contact-row column-right">
                <label>Expiry Month / Year</label> <span id="userEmail-info"
                                                         class="info"></span><br> <select name="month" id="month"
                                                                                          class="demoSelectBox">
                    <option value="08">08</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select> <select name="year" id="year"
                                  class="demoSelectBox">
                    <option value="18">2018</option>
                    <option value="19">2019</option>
                    <option value="20">2020</option>
                    <option value="21">2021</option>
                    <option value="22">2022</option>
                    <option value="23">2023</option>
                    <option value="24">2024</option>
                    <option value="25">2025</option>
                    <option value="26">2026</option>
                    <option value="27">2027</option>
                    <option value="28">2028</option>
                    <option value="29">2029</option>
                    <option value="30">2030</option>
                </select>
            </div>
            <div class="contact-row cvv-box">
                <label>CVC</label> <span id="cvv-info" class="info"></span><br>
                <input type="text" name="cvc" id="cvc"
                       class="demoInputBox cvv-input">
            </div>
        </div>
        <div>
            <input type="submit" name="pay_now" value="Submit"
                   id="submit-btn" class="btnAction"
                   onClick="stripePay(event);">

            <div id="loader">
                <img alt="loader" src="LoaderIcon.gif">
            </div>
        </div>
        <input type='hidden' name='amount' value='0.5'> <input type='hidden'
                                                               name='currency_code' value='USD'> <input type='hidden'
                                                                                                        name='item_name' value='Test Product'> <input type='hidden'
                                                                                                                                                      name='item_number' value='PHPPOTEG#1'>
    </form>

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
                    <td>1</td>
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
