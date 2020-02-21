@extends('layouts.app')

@section('content')
    <br>
    {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Add a new Task</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('task_name', 'Task Name', ['class' => 'main-text']) !!}
            {!! Form::text('task_name', '', ['class' => 'form-control', 'placeholder' => 'Enter name of task...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('due_date', 'Due Date', ['class' => 'main-text']) !!}
            {!! Form::date('due_date', '', ['class' => 'form-control', 'placeholder' => 'Enter due date...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('details', 'Notes', ['class' => 'main-text']) !!}
            {!! Form::text('details', '', ['class' => 'form-control', 'placeholder' => 'Enter further details of task...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('user_id', 'Task Owner', ['class' => 'main-text']) !!}
            <select name="user_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('status_id', 'Task Status', ['class' => 'main-text']) !!}
            <select name="status_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($task_status as $status)
                    <option value="{{$status->status_id}}">{{$status->text}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', 'Customer (if applicable)', ['class' => 'main-text']) !!}
            <select name="customer_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($customers as $customer)
                    <option value="{{$customer->customer_id}}">{{$customer->name}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::submit('Create Task', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url('/tasks')}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>
    {!! Form::close() !!}
        
   
@endsection