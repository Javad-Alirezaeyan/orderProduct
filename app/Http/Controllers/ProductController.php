<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::fullGet();
        return view("product.list",
            [
                'products' => $products
            ]);
    }


}
