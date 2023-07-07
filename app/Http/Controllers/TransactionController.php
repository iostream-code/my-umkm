<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.payment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.payment_create');
    }
}
