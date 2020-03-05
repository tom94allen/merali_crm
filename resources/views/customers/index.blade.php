@extends('layouts.app')

@section('content')
    <div class="row">
        <h1 class="col-lg welcome">
            Customer Dashboard
        </h1>
    </div>
    <div class="row">
        <button id="view_button" class="col-lg-2 main-text change-view" onclick="customerView()">View All Customers</button>
        <a class="col-lg-2 main-text change-view" href="{{url('customers/create')}}">{{ __('Add Customer') }}</a>
        <button style="" type="button" class="col-lg-2 main-text change-view" data-toggle="modal" data-target="#search-form">
            Advanced Search
        </button>
    </div>
    <br>

    <div id="search-area" class="show">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">Search by customer</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <input type="text" name="customer_search" id="customer_search" class="form-control" placeholder="Begin typing name of customer..." onkeyup="findCustomer();">
                <div id="customer_result"></div>
            </div>
        </div>
    </div>

    <div id="main-area" class="hide">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">All Customers</h4>
                <hr>
            </div>
        </div>
        @foreach ($customers as $cust)
            @if ($cust->active_ind != 0)
                <div class="row">
                    <a class="col-lg" href='customers/{{$cust->customer_id}}'>
                        <div class="card customer-card">
                            <div class="card-body welcome s{{$cust->status}}">
                                {{$cust->name}}
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

    <div class="modal fade" id="search-form" tabindex="-1" role="dialog" aria-labelledby="search-formTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Advanced Search</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'CustomerController@custAdvancedSearch', 'method' => 'GET', 'class' => 'col-lg', 'style' => 'margin:auto']) !!}
                    <div class="row">
                        <div class="col">
                            &nbsp;{!! Form::label('owner', 'Owner', ['class' => 'main-text', 'style' => 'width:50%']) !!}
                            <select name="owner" class="main-text form-control">
                                <option value="">Please Select</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            &nbsp;{!! Form::label('sector', 'Sector', ['class' => 'main-text', 'style' => 'width:50%']) !!}
                            <select name="sector" class="main-text form-control">
                                <option value="">Please Select</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{$sector->sector_id}}">{{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="cust-btns" style="margin: 10px 5px 10px 0" data-dismiss="modal">Close</button>
                    {!! Form::submit('Apply Filter', ['type' => 'button', 'class' => 'cust-btns']) !!}
                {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection