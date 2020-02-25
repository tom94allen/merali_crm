@extends('layouts.app')

@section('content')
    <br>
    {!! Form::open(['action' => 'CustomerController@store', 'method' => 'POST', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Add Customer</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('name', 'Customer Name', ['class' => 'main-text']) !!}
            {!! Form::text('name', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address_line1', 'Address Line 1', ['class' => 'main-text']) !!}
            {!! Form::text('address_line1', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('town', 'Town', ['class' => 'main-text']) !!}
            {!! Form::text('town', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('postcode', 'Postcode', ['class' => 'main-text']) !!}
            {!! Form::text('postcode', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'main-text']) !!}
            {!! Form::text('email', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telephone', 'Telephone', ['class' => 'main-text']) !!}
            {!! Form::text('telephone', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('owner', 'Owner', ['class' => 'main-text']) !!}
            <select name="owner" class="form-control">
                <option value="">Please Select</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status', ['class' => 'main-text']) !!}
            <select name="status" class="form-control">
                <option value="">Please Select</option>
                @foreach ($cust_status as $status)
                    <option value="{{$status->status_id}}">{{$status->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('contact_name', 'Contact Name', ['class' => 'main-text']) !!}
            {!! Form::text('contact_name', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('contact_role', 'Contact Role', ['class' => 'main-text']) !!}
            {!! Form::text('contact_role', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url('customers')}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>
    {!! Form::close() !!}
@endsection