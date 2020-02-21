@extends('layouts.app')

@section('content')

<br>
@if ($task)
    {!! Form::open(['action' => ['TasksController@update', $task->task_id], 'method' => 'PUT', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
        <h4 class="card-head welcome">Edit Task</h4>
        <hr>
        <div class="form-group">
            {!! Form::label('task_name', 'Task Name', ['class' => 'main-text']) !!}
            {!! Form::text('task_name', $task->task_name, ['class' => 'form-control', 'placeholder' => 'Enter name of task...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('due_date', 'Due Date', ['class' => 'main-text']) !!}
            {!! Form::date('due_date', $task->due_date, ['class' => 'form-control', 'placeholder' => 'Enter due date...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('details', 'Notes', ['class' => 'main-text']) !!}
            {!! Form::text('details', $task->details, ['class' => 'form-control', 'placeholder' => 'Enter further details of task...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('user_id', 'Task Owner', ['class' => 'main-text']) !!}
            <select name="user_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}" @if ($task->user_id == $user->id) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('status_id', 'Task Status', ['class' => 'main-text']) !!}
            <select name="status_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($task_status as $status)
                    <option value="{{$status->status_id}}" @if ($task->status_id == $status->status_id) selected @endif>{{$status->text}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', 'Customer (if applicable)', ['class' => 'main-text']) !!}
            <select name="customer_id" class="form-control">
                <option value="">Please Select</option>
                @foreach ($customers as $customer)
                    <option value="{{$customer->customer_id}}" @if($task->customer_id == $customer->customer_id) selected @endif>{{$customer->name}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Task', ['class' => ['change-view', 'col-lg-3']]) !!}
            <a href="{{url('/tasks')}}" class="change-view col-lg-3">{{ __('Go Back') }}</a>
        </div>  
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong class="main-text">No longer need this task? Click below to delete.</strong>
        </div>
    </div>
        
    <div class="row">
        &nbsp;&nbsp;&nbsp;
        {!! Form::open(['action' => ['TasksController@destroy', $task->task_id], 'method' => 'DELETE', 'id' => 'deleteForm', 'class' => 'col-lg-6', 'style' => 'margin:auto']) !!}
            {!! Form::submit('Delete Task', ['class' => ['change-view', 'col-lg-3']]) !!}
        {!! Form::close() !!}
    </div>
@else
    <p class="main-text">Record could not be found!</p>
@endif


@endsection