@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product Commerce</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <p class="text-center">
                                Your Order Number
                                <br>
                                {{ $order->order_number }}
                            </p>
                            <p class="text-center">
                                Total
                                <br>
                                {{ number_format($order->total,0,',','.') }}
                            </p>
                            <p class="text-center">
                                {{ $order->product->name }} that cost {{ $order->product->price }} will be shipped to {{ $order->product->shipping_address }} after you pay
                            </p>
                            <p class="text-center">
                                <a class="btn btn-outline-primary" href="{{ url('payment/'.$order->order_number) }}">Pay Here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
