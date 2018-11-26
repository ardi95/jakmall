<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prepaid;
use App\Order;
use Illuminate\Support\Facades\Auth;

class PrepaidbalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('updatestatus');
    }

    public function index()
    {
        return view('prepaidbalance.index');
    }

    public function buy(Request $request)
    {
        $validatedData = $request->validate([
            'number_phone' => 'required|digits_between:7,12|regex:/(081)[0-9]/'
        ]);

        $order_number = $this->make_order_number();
        $total = ($request->valuepaid * 5 / 100) + $request->valuepaid;

        $user = Auth::user();

        $order = Order::create([
            'order_number' => $order_number,
            'total' => $total,
            'status' => 'waiting',
            'type_order' => '1',
            'user_id' => $user->id
        ]);

        Prepaid::create([
            'no_hp' => $request->number_phone,
            'valuepaid' => $request->valuepaid,
            'order_id' => $order->id
        ]);

        return redirect('prepaid-balance/'.$order->id);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('prepaidbalance.result')->with(compact('order'));
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
