<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Store;
use App\Models\Product;
use App\Models\User;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stores()
    {
        if (Auth::user()->role == 'admin') {
            $stores = Store::all();

            return view('store.stores', compact('stores'));
        } else {
            $store = Store::where('user_id', Auth::id())->get()->first();
            if (isset($store)) {
                $products = Product::where('store_id', $store->id)->get();
                return view('store.my_store', compact('store', 'products'));
            } else
                return view('store.my_store', compact('store'));
        }
    }

    public function createStore()
    {
        return view('store.store_create');
    }

    public function registStore(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'picture' => 'required',
            'location' => 'required'
        ]);

        $file = $req->file('picture');
        $path = time() . '_' . $req->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Store::create([
            'user_id' => Auth::id(),
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'picture' => $path,
            'location' => $req->location
        ]);

        return Redirect::route('stores');
    }

    public function detailStore(Store $store)
    {
        $products = Product::where('store_id', $store->id)->get();

        return view('store.store_detail', compact('store', 'products'));
    }

    public function editStore(Store $store)
    {
        return view('store.store_edit', compact('store'));
    }

    public function updateStore(Store $store, Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'picture' => 'required',
            'location' => 'required'
        ]);

        $file = $req->file('picture');
        $path = time() . '_' . $req->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $store->update([
            'name' => $req->name,
            'email' => $req->email,
            'picture' => $path,
            'location' => $req->location
        ]);

        return Redirect::route('stores');
    }

    public function deleteStore(Store $store)
    {
        $store->delete();

        return Redirect::route('stores');
    }
}
