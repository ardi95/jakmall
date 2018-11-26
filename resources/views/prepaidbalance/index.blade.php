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
                            {!! Form::open(['url' => url('prepaid-balance'), 'method' => 'post']) !!}
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Mobile Phone Number</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control {{ $errors->has('number_phone') ? 'is-invalid' : '' }}" name="number_phone" value="{{ old('number_phone') }}">

                                        @if ($errors->has('number_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('number_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Value</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="valuepaid">
                                            <option value="10000">10.000</option>
                                            <option value="50000">50.000</option>
                                            <option value="100000">100.000</option>
                                        </select>
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
