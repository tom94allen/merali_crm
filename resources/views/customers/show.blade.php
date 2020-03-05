@extends('layouts.app')

@section('content')
    @if ($customer->active_ind == 0)
        <div class="row">
            <div class="col-lg">
                <h1 class="welcome text-center">Customer is deactivated</h1>
            </div>
        </div>
    @endif
    <div id="page" class="col-lg">
        <div class="row">
            <h1 class="col-lg-3 welcome" style="text-decoration:underline">{{$customer->name}}</h1>
            <a class="col-lg-2 cust-btns" href='../customers/{{$customer->customer_id}}/edit'>Edit Customer</a>
            <a class="col-lg-2 cust-btns" href='../tasks/create/{{$customer->customer_id}}'>Create Task</a>
            <a class="col-lg-2 cust-btns" href='../contacts/create/{{$customer->customer_id}}'>Create Contact</a>
            <a class="col-lg-2 cust-btns" href='{{url()->previous()}}'>Go Back</a>
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
                        <aside class="col-lg-1 table-label">Sector</aside>
                        @foreach ($sectors as $sector)
                            @if ($sector->sector_id == $customer->sector)
                                <aside class="col-lg-2 table-item">{{$sector->name}}</aside>
                            @endif
                        @endforeach
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
                        <a href="../contacts/{{$contact->contact_id}}">
                            @switch($contact->type_id)
                                @case(1)
                                    <li>Phone call on {{$contact->created_at->format('d/m/Y')}}</li>
                                    @break
                                @case(2)
                                    <li>Email on {{$contact->created_at->format('d/m/Y')}}</li>
                                    @break
                                @case(2)
                                    <li>Spoke face to face on {{$contact->created_at->format('d/m/Y')}}</li>
                                    @break
                                @default
                                    
                            @endswitch
                            
                        </a>
                    @endforeach
                </ol>
                <!--Insert button that links to all contacts associated to this customer, once route is setup-->
                <br><br>
                <div class="row">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="col-lg-4 cust-btns" href='../contacts/showcontacts/{{$customer->customer_id}}'>View All</a>
                </div>
            </div>
            <div id="danger-zone">
                <div class="row">
                    <div class="col-lg">
                        <h4 class="welcome">Danger Zone</h4>
                    </div>
                </div>
                @if($customer->active_ind != 0)
                    <div class="row">
                        <div class="col-lg">
                            {!! Form::open(['action' => ['CustomerController@deactivate', $customer->customer_id], 'method' => 'POST', 'id' => 'deleteForm']) !!}
                                {!! Form::submit('Deactivate Customer', ['id' => 'cust-delete']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection