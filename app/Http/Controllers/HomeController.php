<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProducts;

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
        $total=OrderProducts::sum('total_amount');
        $order_product=OrderProducts::with('order','products')->paginate(5);
        return view('home',compact('total','order_product'));
    }
}
