@extends('layouts.app')

@section('content')
    <div id="page" class="col-lg">
        <div class="row">
            <h1 class="col-lg-5 welcome" style="text-decoration:underline">{{$customer->name}}</h1>
            <a class="col-lg-2 cust-btns" href='../customers/{{$customer->customer_id}}/edit'>Edit Customer</a>
            <a class="col-lg-2 cust-btns" href='../tasks/create/{{$customer->customer_id}}'>Create Task</a>
            <a class="col-lg-2 cust-btns" href='../contacts/create/{{$customer->customer_id}}'>Create Contact</a>
        </div>
        <br>

        <div class="row">
            <div id="customer_info">
                <h4 class="welcome">Customer Details</h4>
                <hr>
                <div id="info">
                    <div class="row">
                        <aside class="col-lg-1 table-label">Status</aside>
                        @foreach ($cust_status as $status)
                            @if ($status->status_id == $customer->status)
                                <aside class="col-lg-2 table-item">{{$status->name}}</aside>
                            @endif
                        @endforeach
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Owner</aside>
                        @foreach ($users as $user)
                            @if ($user->id == $customer->owner)
                                <aside class="col-lg-2 table-item">{{$user->name}}</aside>
                            @endif
                        @endforeach
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Contacted</aside>
                        @if (!empty($last_contact))
                            <aside class="col-lg-2 table-item">{{$last_contact->created_at->format('d/m/Y')}}</aside>
                        @else
                            <aside class="col-lg-2 table-item">None made yet</aside>
                        @endif
                        
                    </div>
                    <br>
                    <div class="row">
                        <aside class="col-lg-1 table-label">Address</aside>
                        <aside class="col-lg-2 table-item">{{$customer->address_line1}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Postcode</aside>
                        <aside class="col-lg-2 table-item">{{$customer->postcode}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Town</aside>
                        <aside class="col-lg-2 table-item">{{$customer->town}}</aside>
                    </div>
                    <br>
                    <div class="row">
                        <aside class="col-lg-1 table-label">Contact</aside>
                        <aside class="col-lg-2 table-item">{{$customer->contact_name}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <aside class="col-lg-1 table-label">Telephone</aside>
                        <aside class="col-lg-2 table-item">{{$customer->telephone}}</aside>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                        <aside class="col-lg-1 table-label">Position</aside>
                        <aside class="col-lg-2 table-item">{{$customer->contact_role}}</aside>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6" id="cx-task-display">
                <br>
                <h4 class="welcome">Open Tasks</h4>
                <hr>
                @foreach ($tasks as $task)
                    <a href="../tasks/{{$task->task_id}}/edit">
                        <div class="card cust-tasks">
                            <div class="card-body">{{$task->task_name}}</div>
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
                        <a href="../contacts/{{$contact->contact_id}}/edit">
                            <li>{{$contact->details}} on {{$contact->created_at->format('d/m/Y')}}</li>
                        </a>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection