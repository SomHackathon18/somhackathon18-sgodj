<?php

namespace App\Http\Controllers;

use App\Models\Location;
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
}
