<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Store;
use Ramsey\Uuid\Type\Integer;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();

        return view('product.products', compact('products'));
    }

    public function createProduct(Store $store)
    {
        return view('product.product_create', compact('store'));
    }

    public function registProduct(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'stock' => $request->stock
        ]);

        return Redirect::route('stores', compact('store'));
    }

    public function detailProduct(Product $product)
    {
        if (Auth::user()->role == 'seller')
            return view('product.product_detail_seller', compact('product'));
        return view('product.product_detail', compact('product'));
    }

    public function editProduct(Product $product)
    {
        return view('product.product_edit', compact('product'));
    }

    public function updateProduct(Product $product, Request $req)
    {
        $req->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $file = $req->file('image');
        $path = time() . '_' . $req->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $product->update([
            'name' => $req->name,
            'price' => $req->price,
            'description' => $req->description,
            'image' => $path,
            'stock' => $req->stock
        ]);

        return Redirect::route('stores');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return Redirect::route('products');
    }
}
