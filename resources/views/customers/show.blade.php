@extends('layouts.app')

@section('content')
    <div id="page" class="col-lg">
        <div class="row">
            <h1 class="col-lg-5 welcome">{{$customer->name}}</h1>
            <a class="col-lg-2 cust-btns" href='../customers/{{$customer->customer_id}}/edit'>Edit Customer</a>
            <a class="col-lg-2 cust-btns" href='../tasks/create/{{$customer->customer_id}}'>Create Task</a>
            <a class="col-lg-2 cust-btns" href='../contacts/create/{{$customer->customer_id}}'>Create Contact</a>
        </div>
        <hr>

        <div class="row">
            <div class="col-lg-5" id="cx-task-display">
                <br>
                <h4 class="welcome">Open Tasks</h4>
                <ul class="cx-task-list">
                    @foreach ($tasks as $task)
                        <a href="../tasks/{{$task->task_id}}/edit">
                            <div class="card">
                                <li class="cx-tasks">{{$task->task_name}}</li>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5" id="cx-contacts">
                <br>
                <h4 class="welcome">Recent Contacts</h4>
            </div>
        </div>
    </div>
@endsection