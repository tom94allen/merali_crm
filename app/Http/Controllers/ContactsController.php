<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use App\Customer;
use App\Contact;
use App\ContactType;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_contacts = Contact::all();
        $cont_type = ContactType::all();
        $customers = Customer::where('active_ind', 1)
                               ->orderBy('name', 'ASC')
                               ->get();

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
        $cont_type = ContactType::all();
        $customers = Customer::where('active_ind', 1)
                               ->orderBy('name', 'ASC')
                               ->get();

        return view('contacts.create')->with('cont_type', $cont_type)
                                      ->with('customers', $customers);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //new DB instance
        $contact = new Contact;
        //get references to the data
        $contact->type_id = $request->input('type_id');
        $contact->customer_id = $request->input('customer_id');
        $contact->details = $request->input('details');
        $contact->created_by = Auth::user()->id;
        //save
        $contact->save();

        //redirect to contact dashboard parsing success message
        return redirect('contacts')->with('success', 'Contact Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //reference to specific contact parsed from previous view
        $con = Contact::find($id);
        $type_id = $con['type_id'];
        $cust_id = $con['customer_id'];
        $user_id = $con['created_by'];
        //references to info required to display on show view
        $con_type = ContactType::find($type_id);
        $customer = Customer::find($cust_id);
        $created_by = User::find($user_id);

        return view('contacts.show')->with('con', $con)
                                    ->with('con_type', $con_type)
                                    ->with('customer', $customer)
                                    ->with('created_by', $created_by);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "hello";
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
        $query = Customer::where('name', 'like', "%{$query_data}%")
                           ->where('active_ind', 1)
                           ->orderBy('name', 'ASC')
                           ->get();

        $output = '<ul class="result-display">';
        foreach($query as $item){
            $output .= '<li class="result-item"><a href="contacts/showcontacts/'.$item->customer_id.'">'.$item->name.'</a></li>';
        }

        $output .= '</ul>';
        
        return $output;
    }

    public function showContacts($id)
    {
        //get references to necessary data
        $customer = Customer::find($id);
        $query = $customer->customer_id;
        $cust_contacts = Contact::where('customer_id', "{$query}")->get();
        $con_type = ContactType::all();
        $users = User::all();
        $error = '';
        //parse to view
        return view('contacts.showContacts')->with('customer', $customer)
                                            ->with('cust_contacts', $cust_contacts)
                                            ->with('con_type', $con_type)
                                            ->with('error', $error)
                                            ->with('users', $users);

    }

    public function customerCreate($id)
    {
        //get necessary references
        $customer = Customer::find($id);
        $con_type = ContactType::all();
        //return
        return view('contacts.customerCreate')->with('customer', $customer)
                                              ->with('con_type', $con_type);
    }

    public function customerStore(Request $request, $id)
    {
        //new instance of table
        $con = new Contact;
        //parse info to correct columns
        $con->type_id = $request->input('type_id');
        $con->details = $request->input('details');
        $con->customer_id = $id;
        $con->created_by = Auth::user()->id;
        //save
        $con->save();
        //redirect with success message
        return redirect('customers/'.$id)->with('success', 'Contact created for this customer');


    }

    public function advancedSearch(Request $request, $id)
    {
        
        //get references
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $created_by = $request->input('created_by');
        $type_id = $request->input('type_id');
        $customer = Customer::find($id);
        $query = $customer->customer_id;
        $cust_contacts = Contact::where('customer_id', "{$query}")->get();
        $con_type = ContactType::all();
        $users = User::all();
        $query_data = array(
            'date_from' => '',
            'date_to' => '',
            'created_by' => '',
            'type_id' => '',
        );
        //ensure one field is filled out otherwise return view with error message
        if(!$date_from && !$date_to && !$created_by && !$type_id){
            $error = 'At least one field is required!';
            return view('contacts.showContacts')->with('error', $error)
                                                ->with('customer', $customer)
                                                ->with('cust_contacts', $cust_contacts)
                                                ->with('con_type', $con_type)
                                                ->with('users', $users);
        }
        else{
            $error = '';
            //push necessary vars to $query_data array if not null
            if($date_from != null){
                $query_data['date_from']= $date_from;
            }
            if($date_to !=null){
                $query_data['date_to']= $date_to;
            }
            if($created_by != null){
                $query_data['created_by'] = $created_by;
            }
            if($type_id != null){
                $query_data['type_id'] = $type_id;
            }
            // echo '<pre>';print_r($query_data);exit;
            $output = ''.$customer->customer_id.'';
            foreach($query_data as $k => $data){
                if($query_data[$k]){
                    switch ($k) {
                        case 'date_from':
                            $output .= ' AND created_at >= "'.$query_data[$k].'"';
                            break;
                        case 'date_to':
                            $output .= ' AND created_at <= "'.$query_data[$k].'"';
                            break;
                        case 'created_by':
                            $output .= ' AND created_by = '.$query_data[$k].'';
                            break;
                        case 'type_id':
                            $output .= ' AND type_id = '.$query_data[$k].'';
                            break;
                        default:
                            break;
                    }
                }
            }
            $results = DB::select(DB::raw('select * from contacts where customer_id = '.$output));
            if($results){
                $cust_contacts = '';
            }
            else{
                $error = 'No results could be found';
            }
            return view('contacts.showContacts')->with('cust_contacts', $cust_contacts)
                                                ->with('customer', $customer)
                                                ->with('con_type', $con_type)
                                                ->with('results', $results)
                                                ->with('users', $users)
                                                ->with('error', $error);
        }
        
        

    }
}
