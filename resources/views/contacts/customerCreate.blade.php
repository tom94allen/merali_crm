@extends('layouts.app')

@section('content')
    <br>
    {!! Form::open(['action' => ['ContactsController@customerStore', $customer->customer_id], 'method' => 'POST', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Add Contact With Customer</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('type_id', 'Type of Contact', ['class' => 'main-text']) !!}
            <select name="type_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($con_type as $type)
                    <option value="{{$type->type_id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', 'Customer', ['class' => 'main-text']) !!}
            <select name="customer_id" class="form-control" disabled>
                <option value="">Please Select</option>
                <option value="" selected>{{$customer->name}}</option>
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('details', 'Provide detailed notes of contact', ['class' => 'main-text']) !!}
            {!! Form::textarea('details', '', ['class' => 'form-control', 'row' => '3', 'style' => 'resize:none']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url()->previous()}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>
    {!! Form::close() !!}
@endsection