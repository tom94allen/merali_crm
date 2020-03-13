<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\CustomerStatus;
use App\Task;
use App\TaskStatus;
use App\Contact;
use App\ContactType;
use App\User;
use App\SectorType;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
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
        //dashboard style page for customers where all customers are displayed by default 
        
        //get necessary info from DB
        $user = Auth::user();
        $users = User::all();
        $customers = Customer::orderBy('name', 'ASC')->get();
        $cust_status = CustomerStatus::all();
        $sectors = SectorType::all();
        $error='';
        //return view parsing necessary vars
        return view('customers.index')->with('user', $user)
                                      ->with('customers', $customers)
                                      ->with('users', $users)
                                      ->with('sectors', $sectors)
                                      ->with('error', $error)
                                      ->with('cust_status', $cust_status);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $cust_status = CustomerStatus::all();
        $sectors = SectorType::all();

        return view('customers.create')->with('users', $users)
                                       ->with('cust_status', $cust_status)
                                       ->with('sectors', $sectors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address_line1' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'telephone' => 'required',
            'owner' => 'required',
            'status' => 'required',
            'contact_name' => 'required',
            'contact_role' => 'required',
            'sector' => 'required',
        ]);

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->address_line1 = $request->input('address_line1');
        $customer->town = $request->input('town');
        $customer->postcode = $request->input('postcode');
        if($request->input('email')){
            $customer->email = $request->input('email');
        }
        else{
            $customer->email = NULL;
        }
        $customer->telephone = $request->input('telephone');
        $customer->owner = $request->input('owner');
        $customer->status = $request->input('status');
        $customer->contact_name = $request->input('contact_name');
        $customer->contact_role = $request->input('contact_role');
        $customer->sector = $request->input('sector');
        $customer->active_ind = 1;
        $customer->created_by = Auth::user()->id;
        $customer->save();
        return redirect('/customers')->with('success', 'Customer Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch the required info on the customer in question dynamically parsing the id to the query
        $customer = DB::select(DB::raw('select c.*, u.name as username, cs.name as cust_status, st.name as sector
                                from customers c
                                left join users u on c.owner = u.id
                                left join customer_status cs on c.status = cs.status_id
                                left join sector_type st on c.sector = st.sector_id
                                where c.active_ind = 1
                                and c.customer_id = '.$id.';'));
        $note = Customer::select('notes')
                           ->where('customer_id', $id)
                           ->where('active_ind', 1)
                           ->firstOrFail();
        //get their open tasks and all task status
        $tasks = DB::select(DB::raw('select t.task_id, t.task_name, t.due_date, u.name
                                    from tasks t
                                    left join users u on t.user_id = u.id
                                    where t.status_id <> 3
                                    and t.customer_id = '.$id.';'));
        
        //get their 5 most recent contacts
        $contacts_five = DB::select(DB::raw('select c.*, ct.name as con_type, u.name as username, cast(c.created_at as date) as date
                                            from contacts c
                                            left join contact_type ct on c.type_id = ct.type_id
                                            left join users u on c.created_by = u.id
                                            where c.customer_id = '.$id.'
                                            order by c.created_at desc
                                            limit 5'));
        
        return view('customers.show')->with('customer', $customer)
                                     ->with('tasks', $tasks)
                                     ->with('contacts_five', $contacts_five)
                                     ->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $cust_status = CustomerStatus::all();
        $users = User::all();
        $sectors = SectorType::all();

        return view('customers.edit')->with('customer', $customer)
                                     ->with('cust_status', $cust_status)
                                     ->with('sectors', $sectors)
                                     ->with('users', $users);
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
        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->address_line1 = $request->input('address_line1');
        $customer->town = $request->input('town');
        $customer->postcode = $request->input('postcode');
        if($request->input('email')){
            $customer->email = $request->input('email');
        }
        else{
            $customer->email = NULL;
        }
        $customer->telephone = $request->input('telephone');
        $customer->owner = $request->input('owner');
        $customer->status = $request->input('status');
        $customer->contact_name = $request->input('contact_name');
        $customer->contact_role = $request->input('contact_role');
        $customer->sector = $request->input('sector');
        $customer->active_ind = 1;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect('/customers')->with('success', 'Customer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function deactivate($id)
    {
        //find the customer
        $deactivate_customer = Customer::find($id);

        //change their active_ind column to 0
        $deactivate_customer->active_ind = 0;
        $deactivate_customer->save();

        //return to view with success message
        return redirect('/customers')->with('success', 'Customer Deactivated');



    }

    public function search(Request $request)
    {
        //ajax method used for search field on customers index view

        $data = $request->all();
        $query_data = $data['val'];
        // $cust_results = Customer::where('name', 'LIKE','%' . $data . '%')-->get();
        $query = Customer::where('name', 'like', "%{$query_data}%")
                           ->where('active_ind', 1) 
                           ->orderBy('name', 'ASC')->get();
        // return $query;
        $output = '<ul class="result-display">';
        foreach($query as $item){
            $output .= '<li class="result-item"><a href="customers/'.$item->customer_id.'">'.$item->name.'</a></li>';
        }
        $output .= '</ul>'; 
        return $output;
    }

    public function custAdvancedSearch(Request $request)
    {
        //get references to form input sent by user
        $search = $request->all();
        $error = '';
        //set the raw query to be added to depending on requests
        $query = 'SELECT * from customers where active_ind = 1';

        //loop through items sent from form and append it to the query if there is a value against the key
        foreach($search as $k => $item){
            if($search[$k]){
                $query .= ' AND '.$k.' = '.$item.'';
            }
            else{
                continue;
            }
        }
        //ensure the query has changed from original otherwise revert back with error message
        if($query == 'SELECT * from customers where active_ind = 1'){
             $error = 'At least one selection is required!';
             return back()->with('error', $error);
        }

        $results = DB::select(DB::raw("".$query.""));

        //check results is not empty otherwise no customers found that match if not return view parsing results
        if(empty($results)){
            $error = 'No results found matching your query!';
            return back()->with('error', $error);
        }
        else{
            return view('customers.custAdvancedSearch')->with('results', $results);
        }

        
    }

    public function addNote(Request $request, $id)
    {
        //find customer, get the details from the request and save it to the correct column in db
        $customer = Customer::find($id);
        $customer->notes = $request->input('notes');
        $customer->save();
        //redirect back to customers page with success message
        return redirect('customers/'.$id)->with('success', 'Note Created');
    }

}
