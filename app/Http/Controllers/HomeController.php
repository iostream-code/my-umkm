<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $users = User::where('role', '!=', 'admin')->get();
        $user = User::where('id', Auth::id())->first();

        if (Auth::user()->role == 'visitor')
            return view('home', compact('products'));
        elseif (Auth::user()->role == 'admin')
            return view('users.admin.users', compact('users'));
        else
            return view('users.admin.user_detail', compact('user'));
    }
}
