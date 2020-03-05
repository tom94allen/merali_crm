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

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection