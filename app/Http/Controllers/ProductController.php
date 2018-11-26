<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('updatestatus');
    }

    public function index()
    {
        return view('product.index');
    }

    public function buy(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:10|max:150',
            'shipping_address' => 'required|min:10|max:150',
            'price' => 'required|numeric'
        ]);

        $order_number = $this->make_order_number();
        $total = 10000 + $request->price;

        $user = Auth::user();

        $order = Order::create([
            'order_number' => $order_number,
            'total' => $total,
            'status' => 'waiting',
            'type_order' => '2',
            'user_id' => $user->id
        ]);

        Product::create([
            'name' => $request->name,
            'shipping_address' => $request->shipping_address,
            'price' => $request->price,
            'order_id' => $order->id
        ]);

        return redirect('product/'.$order->id);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('product.result')->with(compact('order'));
    }

    public function make_order_number()
    {
        $order_number = NULL;
        for ($i=1; $i <= 10 ; $i++) {
            $number_random = rand(0,9);
            $order_number = $order_number.$number_random;
        }
        $result = $this->check_order_number($order_number);

        if($result) {
            return $order_number;
        }
    }

    public function check_order_number($order_number)
    {
        $count_prepaid = Order::where('order_number','=',$order_number)->count();
        if ($count_prepaid >= 1) {
            $this->make_order_number();
        }
        else {
            return TRUE;
        }
    }
}
