<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = "product";

    public static function fullGet()
    {
        return Product::select(['*', 'product.name as product_name'])->
            join("brand", 'brand_id', '=', 'brand.id')
            ->paginate(DEFAULT_TABLE_ROWS);
    }
}
