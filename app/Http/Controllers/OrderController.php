<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('updatestatus');
    }

    public function index()
    {
        $user = Auth::user();
        $order = Order::where('user_id',$user->id)->paginate(20);

        return view('order.index')->with(compact('order'));
    }
}
