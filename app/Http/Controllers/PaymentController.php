<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('updatestatus');
    }

    public function index($order_number = NULL)
    {
        return view('payment.index')->with(compact('order_number'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_number' => 'required|digits:10|numeric|exists:orders,order_number'
        ]);

        $order = Order::where('order_number',$request->order_number)->first();
        if ($order->status == 'Canceled') {
            return back()
            ->withInput()
            ->withErrors(array(
                'order_number' => 'Order canceled, because not yet paid in 5 minute'
            ));
        }
        else {
            if ($order->type_order == '1') {
                $result_information = rand(1,9);
                // echo $result_information;die();

                $date_now = date('H');
                if ($date_now < 9 OR $date_now > 17) {
                    if($result_information > 4) {
                        $status = 'Fail';
                    }
                    else {
                        $status = 'Success';
                    }
                }
                else {
                    if($result_information > 1) {
                        $status = 'Success';
                    }
                    else {
                        $status = 'Fail';
                    }
                }
            }
            else {
                $shipping_code = $this->make_shipping_code();

                $product = Product::where('order_id',$order->id);
                $product->update([
                    'shipping_code' => $shipping_code
                ]);

                $status = 'Success';
            }

            $order->update([
                'status' => $status
            ]);

            return redirect('order');
        }

    }

    public function make_shipping_code()
    {
        $abjad = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shipping_code = '';
        for ($i=1; $i <= 8 ; $i++) {
            $abjad_temp = rand(0, strlen($abjad)-1);
            $shipping_code .= $abjad{$abjad_temp};
        }

        $result = $this->check_shipping_code($shipping_code);

        if($result) {
            return $shipping_code;
        }
    }

    public function check_shipping_code($shipping_code)
    {
        $count_product = Product::where('shipping_code','=',$shipping_code)->count();
        if ($count_product >= 1) {
            $this->make_shipping_code();
        }
        else {
            return TRUE;
        }
    }
}
