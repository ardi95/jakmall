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
                            {!! Form::open(['url' => url('product'), 'method' => 'post']) !!}
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Product</label>
                                    <div class="col-md-8">
                                        <textarea name="name" rows="5" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">{{ old('name') }}</textarea>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Shipping Address</label>
                                    <div class="col-md-8">
                                        <textarea name="shipping_address" rows="5" class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}">{{ old('shipping_address') }}</textarea>

                                        @if ($errors->has('shipping_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('shipping_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Price</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price" value="{{ old('price') }}">

                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-outline-primary">Submit</button>
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
