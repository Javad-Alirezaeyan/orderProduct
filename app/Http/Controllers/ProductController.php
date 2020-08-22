<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this function returns the list of products
     */
    public function index()
    {
        $products = Product::fullGet();
        return view("product.list",
            [
                'products' => $products
            ]);
    }


}
