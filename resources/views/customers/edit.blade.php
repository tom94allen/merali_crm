@extends('layouts.app')

@section('content')

@if ($customer)
    {!! Form::open(['action' => ['CustomerController@update', $customer->customer_id], 'method' => 'PUT', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Edit Customer</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('name', 'Customer Name', ['class' => 'main-text']) !!}
            {!! Form::text('name', $customer->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address_line1', 'Customer Address', ['class' => 'main-text']) !!}
            {!! Form::text('address_line1', $customer->address_line1, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('town', 'Customer Town', ['class' => 'main-text']) !!}
            {!! Form::text('town', $customer->town, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('postcode', 'Customer Postcode', ['class' => 'main-text']) !!}
            {!! Form::text('postcode', $customer->postcode, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'main-text']) !!}
            {!! Form::text('email', $customer->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telephone', 'Contact Number', ['class' => 'main-text']) !!}
            {!! Form::text('telephone', $customer->telephone, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('owner', 'Owner', ['class' => 'main-text']) !!}
            <select name="owner" class="form-control">
                <option value="">Please Select</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}" @if($customer->owner == $user->id) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status', ['class' => 'main-text']) !!}
            <select name="status" class="form-control">
                <option value="">Please Select</option>
                @foreach ($cust_status as $status)
                    <option value="{{$status->status_id}}" @if($status->status_id == $customer->status) selected @endif>{{$status->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('contact_name', 'Contact Name', ['class' => 'main-text']) !!}
            {!! Form::text('contact_name', $customer->contact_name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('contact_role', 'Contact Role', ['class' => 'main-text']) !!}
            {!! Form::text('contact_role', $customer->contact_role, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Customer', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url('/customers')}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>  
    {!! Form::close() !!}
@else
    <p class="main-text">Record could not be found!</p>
@endif


@endsection