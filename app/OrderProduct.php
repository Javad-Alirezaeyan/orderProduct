<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "orderproduct";

    public static function fullGet($where = [])
    {
        return  OrderProduct::select(['*','brand.name as brandName' , 'product.name as productName','orderproduct.price as realPrice'])->where($where)->
        join("product", 'product_id', '=', 'product.id')->
        join("brand", 'brand_id', '=', 'brand.id')
            ->get();
    }
}
