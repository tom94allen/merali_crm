@extends('layouts.app')

@section('content')
    @if ($customer[0]->active_ind == 0)
        <div class="row">
            <div class="col-lg">
                <h1 class="welcome text-center">Customer is deactivated</h1>
            </div>
        </div>
    @endif
    <div id="page" class="col-lg">
        <div class="row">
            <h1 class="col-lg-3 welcome" style="text-decoration:underline">{{$customer[0]->name}}</h1>
            <a class="col-lg-2 cust-btns" @if($customer[0]->active_ind == 0) href="" @else href='../customers/{{$customer[0]->customer_id}}/edit' @endif>Edit Customer</a>
            <a class="col-lg-2 cust-btns" @if($customer[0]->active_ind == 0) href="" @else href='../tasks/create/{{$customer[0]->customer_id}}' @endif>Create Task</a>
            <a class="col-lg-2 cust-btns" @if($customer[0]->active_ind == 0) href="" @else href='../contacts/create/{{$customer[0]->customer_id}}' @endif>Create Contact</a>
            <a class="col-lg-2 cust-btns" @if($customer[0]->active_ind == 0) href="{{url('customers')}}" @else href='{{url()->previous()}}' @endif>Go Back</a>
        </div>
        <br>

        <div class="row">
            <div id="customer_info">
                <h4 class="welcome">Customer Details</h4>
                <hr>
                <div id="info">
                    <div class="row">
                        <aside class="col-lg-1 table-label">Status</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->cust_status}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Owner</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->username}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Sector</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->sector}}</aside>
                    </div>
                    <br>
                    <div class="row">
                        <aside class="col-lg-1 table-label">Address</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->address_line1}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Postcode</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->postcode}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Town</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->town}}</aside>
                    </div>
                    <br>
                    <div class="row">
                        <aside class="col-lg-1 table-label">Contact</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->contact_name}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Telephone</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->telephone}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Position</aside>
                        <aside class="col-lg-2 table-item">{{$customer[0]->contact_role}}</aside>
                    </div>
                </div>
            </div>
        </div>
        
        @if($note['notes'])
        <br>
            <div class="row">
                <div class="col-lg" id="addtl-info">
                    <h4 class="welcome">Additional information</h4>    
                    <hr>
                    <article class="main-text">{{$note['notes']}}</article>  
                </div>
            </div>
            <br>
        @else
            <div class="row">
                <div class="btn-group btn-block" id="add-addtl-info">
                    <button type="button" style="text-align:left !important" class="welcome btn btn-block dropdown-toggle" data-toggle="dropdown" onclick="pushContent()"><span class="glyphicon glyphicon-cog"></span>Add additional information eg. socials etc<span class="caret"></span>
                    </button>
                    <hr>
                    <div class="dropdown-menu col-lg" role="menu">
                        {!! Form::open(['action' => ['CustomerController@addNote', $customer[0]->customer_id], 'method' => 'POST', 'class' => 'col-lg-6']) !!}
                            <div class="form-group">
                                {!! Form::label('notes', 'Enter details below...', ['class' => 'main-text']) !!}
                                {!! Form::textarea('notes', '', ['class' => 'form-control', 'row' => '2', 'style' => 'resize:none;']) !!}
                            </div>
                            {!! Form::submit('Add', ['class' => ['change-view', 'col-lg-3']]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6" id="cx-task-display">
                <br>
                <h4 class="welcome">Open Tasks</h4>
                <hr>
                @foreach ($tasks as $task)
                    <a href="../tasks/{{$task->task_id}}/edit">
                        <div class="card cust-tasks">
                        <div class="card-body" style="padding: 2px 20px !important">{{$task->task_name}} | <small>Due: {{date('d-m-Y',strtotime($task->due_date))}}</small></div>
                        <div class="card-body" style="padding: 2px 20px !important"><small>Created by: {{$task->name}}</small></div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5" id="cx-contacts">
                <br>
                <h4 class="welcome">Recent Contacts</h4>
                <hr>
                <ol>
                    @foreach ($contacts_five as $contact)
                            <a href="../contacts/{{$contact->contact_id}}">
                                @switch($contact->type_id)
                                    @case(1)
                                        <li>Phone call on {{date('d/m/Y',strtotime($contact->date))}}, taken by {{$contact->username}}</li>
                                        @break
                                    @case(2)
                                        <li>Email on {{date('d/m/Y',strtotime($contact->date))}}, sent by {{$contact->username}}</li>
                                        @break
                                    @case(3)
                                        <li>{{$contact->username}} met face to face with {{$customer[0]->name}} on {{date('d/m/Y',strtotime($contact->date))}}</li>
                                        @break
                                    @default
                                        @break
                                @endswitch
                    @endforeach
                </ol>
                <!--Insert button that links to all contacts associated to this customer, once route is setup-->
                <br><br>
                <div class="row">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="col-lg-4 cust-btns" @if($customer[0]->active_ind ==0) href="" @else href='../contacts/showcontacts/{{$customer[0]->customer_id}}' @endif>View All</a>
                </div>
            </div>
            <div id="danger-zone">
                <div class="row">
                    <div class="col-lg">
                        <h4 class="welcome">Danger Zone</h4>
                    </div>
                </div>
                @if($customer[0]->active_ind != 0)
                    <div class="row">
                        <div class="col-lg">
                            {!! Form::open(['action' => ['CustomerController@deactivate', $customer[0]->customer_id], 'method' => 'POST', 'id' => 'deleteForm']) !!}
                                {!! Form::submit('Deactivate Customer', ['id' => 'cust-delete']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection