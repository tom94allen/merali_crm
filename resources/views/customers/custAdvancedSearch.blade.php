@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="float-right">
                <a class="col-lg-2 cust-btns" href='{{url()->previous()}}'>Go Back</a>
            </div>
        </div>
    </div>
    <div id="main-area">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">Search Results</h4>
                <hr>
            </div>
        </div>
        @foreach ($results as $customer)
            <div class="row">
                <a class="col-lg" href='customers/{{$customer->customer_id}}'>
                    <div class="card customer-card">
                        <div class="card-body welcome s{{$customer->status}}">
                            {{$customer->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

