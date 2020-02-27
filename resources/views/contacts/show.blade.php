@extends('layouts.app')

@section('content')
    
    <div class="float-right">
        <a href="{{url()->previous()}}" id="cust-delete" style="padding:5px 15px">Go back</a>
    </div>
    <br>
    <br>
    <div id="top-summary">
        <div id="white-back">
            <div class="row">
                <h2 class="welcome col-lg-9" id="ver-align">Contact with {{$customer->name}} on {{$con->created_at->format('d/m/Y')}}</h2>
                @switch($con_type->type_id)
                    @case(1)
                        <div class="col-lg-3">
                            <img class="con-image" src="{{asset('images/phone.png')}}">
                        </div>
                        @break
                    @case(2)
                        <div class="col-lg-3">
                            <img class="con-image" src="{{asset('images/email.png')}}">
                        </div>
                        @break
                    @case(3)
                        <div class="col-lg-3">
                            <img class="con-image" src="{{asset('images/facetoface.png')}}">
                        </div>
                        @break
                    @default
                        
                @endswitch
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <h4 class="welcome">Created by: {{$created_by->name}}</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div id="contact-detail">
        <div id="white-back">
            <div class="row">
                <h4 class="welcome col-lg">Details of contact</h4>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg">
                    <article class="main-text contact-body">{{$con->details}}</article>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div id="danger-zone">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">Danger Zone</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                {!! Form::open(['action' => ['ContactsController@destroy', $con->contact_id], 'method' => 'DELETE', 'id' => 'deleteForm']) !!}
                    {!! Form::submit('Delete Contact', ['id' => 'cust-delete']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    
    
    

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection