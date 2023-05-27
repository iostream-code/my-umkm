<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        return view('users.umkm.products');
    }

    public function createProduct()
    {
        $product = new Product;

        
    }
}
