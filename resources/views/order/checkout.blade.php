<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/20/20
 * Time: 10:17 PM
 */
?>


@extends('layouts.master')
@section('title', "checkout")
@section('content')
<checkout-component
        v-bind:params="{{ json_encode([
        'product'=>$product,
        'shipping_fee'=>SHIPPING_Fee
        ]) }}" >
</checkout-component>




@endsection

