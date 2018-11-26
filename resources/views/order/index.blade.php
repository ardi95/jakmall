@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Prepaid Balance</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <table class="table table-hover">
                                <tr>
                                    <th>Order No.</th>
                                    <th>Description</th>
                                    <th>Total</th>
                                    <th>Information</th>
                                </tr>
                                @foreach($order as $o)
                                    <tr>
                                        <td>{{ $o->order_number }}</td>
                                        <td>
                                            @if($o->type_order == '1')
                                                {{ number_format($o->prepaid->valuepaid,0,',','.') }} For {{ $o->prepaid->no_hp }}
                                            @endif
                                            @if($o->type_order == '2')
                                                {{ $o->product->name }} that cost {{ number_format($o->product->price,0,',','.') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($o->total,0,',','.') }}</td>
                                        <td>
                                            @if($o->type_order == '1')
                                                @if($o->status == 'waiting')
                                                    <a href="{{ url('payment/'.$o->order_number) }}" class="btn btn-outline-primary">Pay</a>
                                                @elseif($o->status == 'Canceled')
                                                    <span class="text-danger">Canceled</span>
                                                @else
                                                    {{ $o->status }}
                                                @endif
                                            @endif
                                            @if($o->type_order == '2')
                                                @if($o->status == 'waiting')
                                                    <a href="{{ url('payment/'.$o->order_number) }}" class="btn btn-outline-primary">Pay</a>
                                                @elseif($o->status == 'Canceled')
                                                    <span class="text-danger">Canceled</span>
                                                @elseif($o->status == 'Success')
                                                    Shipping Code: {{ $o->product->shipping_code }}
                                                @else
                                                    {{ $o->status }}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{ $order->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
