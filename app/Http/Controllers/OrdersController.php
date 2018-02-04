<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();

        return view( 'orders.create', compact('locations') );
    }
    public function show ($id) {
        $order = Order::findOrFail($id);

        //$order = $order->with('location');
        return view( 'orders.show', compact('order') );
    }
}
