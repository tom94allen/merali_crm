@extends('layouts.app')

@section('content')
    <br>
    {!! Form::open(['action' => ['ContactsController@update', $contact->contact_id], 'method' => 'PUT', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Edit Contact With Customer</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('type_id', 'Type of Contact', ['class' => 'main-text']) !!}
            <select name="type_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($cont_type as $type)
                    <option value="{{$type->type_id}}" @if($type->type_id == $contact->type_id) selected @endif>{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', 'Customer', ['class' => 'main-text']) !!}
            <select name="customer_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($customers as $customer)
                    <option value="{{$customer->customer_id}}" @if($customer->customer_id == $contact->customer_id) selected @endif>{{$customer->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('details', 'Provide detailed notes of contact', ['class' => 'main-text']) !!}
            {!! Form::textarea('details', $contact->details, ['class' => 'form-control', 'row' => '3', 'style' => 'resize:none']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url()->previous()}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>
    {!! Form::close() !!}
@endsection