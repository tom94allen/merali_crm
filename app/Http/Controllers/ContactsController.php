<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use App\Customer;
use App\Contact;
use App\ContactType;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_contacts = Contact::all();
        $cont_type = ContactType::all();
        $customers = Customer::all();

        return view('contacts.index')->with('all_contacts', $all_contacts)
                                     ->with('cont_type', $cont_type)
                                     ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "hello";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function find(Request $request)
    {
        //function used for ajax query on contacts index page in search field
        $data = $request->all();
        $query_data = $data['val'];
        $query = Customer::where('name', 'like', "%{$query_data}%")->orderBy('name', 'ASC')->get();

        $output = '<ul class="result-display">';
        foreach($query as $item){
            $output .= '<li class="result-item"><a href="contacts/showcontacts/'.$item->customer_id.'">'.$item->name.'</a></li>';
        }

        $output .= '</ul>';
        
        return $output;
    }

    public function showContacts($id)
    {
        return "hello";
    }
}
