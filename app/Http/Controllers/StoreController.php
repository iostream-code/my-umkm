<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Store;

class StoreController extends Controller
{
    public function stores()
    {
        $stores = Store::all();

        return view('store.stores', compact('stores'));
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
            'location' => 'required'
        ]);

        Store::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'location' => $req->location
        ]);

        return Redirect::route('stores');
    }

    public function detailStore(Store $store)
    {
        return view('store.store_detail', compact('store'));
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
            'location' => 'required'
        ]);

        $store->update([
            'name' => $req->name,
            'email' => $req->email,
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
