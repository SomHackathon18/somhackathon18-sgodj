<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store (Request $request)
    {
        $order = Order::create([
            'title' => $request->title,
            'description' => $request->description,
            'reward' => $request->reward,
            'user_id' => Auth::user()->id,
            'location_id' => rand(1, 20), // TO DO
        ]);

        return redirect()->route('show-order', $order);
    }
}
