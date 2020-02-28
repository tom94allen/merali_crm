@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-lg">
            <h1 class="welcome">Contact Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <a class="col-lg-2 main-text change-view" href="{{url('contacts/create')}}">{{ __('Add Contact') }}</a>
    </div>
    <br>

    <div id="search-area" class="show">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">View all contacts by customer</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <input type="text" name="search_field" id="search_field" class="form-control" placeholder="Begin typing name of customer..." onkeyup="customerContacts()">
                <div id="search_result"></div>
            </div>
        </div>
    </div>

    <div id="main-area">
        <div class="row">
            @foreach ($all_contacts as $contact)
                @foreach ($customers as $customer)
                    @if ($contact->customer_id == $customer->customer_id)
                    <div class="card col-lg-2 contact-card" style="margin:auto">
                        @if($contact->type_id == 1)
                            <img class="card-img-top card-image" src="{{asset('images/phone.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Phone Call</div>
                        @elseif($contact->type_id == 2)
                            <img class="card-img-top card-image" src="{{asset('images/email.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Email</div>
                        @elseif($contact->type_id == 3)
                            <img class="card-img-top card-image" src="{{asset('images/facetoface.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Face to Face</div>
                        @endif
                            <p class="card-text main-text" style="text-align:center">{{$contact->created_at->format('d/m/Y')}}</p>
                            <p class="card-text main-text" style="text-align:center">{{$customer->name}}</p>
                            <div class="text-center">
                                <a href="contacts/{{$contact->contact_id}}" class="main-text contact-view">View Contact</a>
                            </div>
                        </div>
                      </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        </div>
        </div>
    </div>

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection