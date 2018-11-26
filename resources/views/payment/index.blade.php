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
                            {!! Form::open(['url' => url('payment'), 'method' => 'post']) !!}
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Mobile Phone Number</label>
                                    <div class="col-md-8">
                                        <input
                                        type="text"
                                        class="form-control {{ $errors->has('order_number') ? 'is-invalid' : '' }}"
                                        name="order_number"
                                        @if(isset($order_number))
                                            value="{{ $order_number }}"
                                        @endif
                                        >

                                        @if ($errors->has('order_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('order_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-outline-primary">Pay</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
