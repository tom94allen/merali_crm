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
use DB;
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
        $customers = Customer::orderBy('name', 'ASC')->get();
        $cust_status = CustomerStatus::all();
    
        //return view parsing necessary vars
        return view('customers.index')->with('user', $user)
                                      ->with('customers', $customers)
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
        return view('customers.create')->with('users', $users)->with('cust_status', $cust_status);
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
        //fetch all user info to establish owner of customer
        $users = User::all();
        //fetch the customer in question and the cust status text
        $customer = Customer::find($id);
        $cust_status = CustomerStatus::all();
        //get their open tasks and all task status
        $tasks = Task::where('customer_id', "{$id}")->get();
        $task_status = TaskStatus::all();
        //get their recent contacts
        $contacts_five = Contact::where('customer_id', "{$id}")->orderBy('created_at', 'DESC')->take(6)->get();
        $last_contact = Contact::where('customer_id', "{$id}")->orderBy('created_at', 'DESC')->take(1)->first();
        $cont_type = ContactType::all();
        return view('customers.show')->with('customer', $customer)
                                     ->with('cust_status', $cust_status)
                                     ->with('tasks', $tasks)
                                     ->with('task_status', $task_status)
                                     ->with('contacts_five', $contacts_five)
                                     ->with('cont_type', $cont_type)
                                     ->with('users', $users)
                                     ->with('last_contact', $last_contact);
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

        return view('customers.edit')->with('customer', $customer)
                                     ->with('cust_status', $cust_status)
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
        $customer->save();

        return redirect('/customers')->with('success', 'Customer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $cust_tasks = Task::where('customer_id', "{$id}")->get();
        $cust_contacts = Contact::where('customer_id', "{$id}")->get();
        if(!empty($cust_tasks)){
            foreach($cust_tasks as $task){
                $task->delete();
            }   
        }
        if(!empty($cust_contacts)){
            foreach($cust_contacts as $contact){
                $contact->delete();
            }
            
        }
        $customer->delete();

        return redirect('customers')->with('success', 'Customer Deleted');
    }
    
    public function search(Request $request)
    {
        //ajax method used for search field on customers index view

        $data = $request->all();
        $query_data = $data['val'];
        // $cust_results = Customer::where('name', 'LIKE','%' . $data . '%')-->get();
        $query = Customer::where('name', 'like', "%{$query_data}%")->orderBy('name', 'ASC')->get();
        // return $query;
        $output = '<ul class="result-display">';
        foreach($query as $item){
            $output .= '<li class="result-item"><a href="customers/'.$item->customer_id.'">'.$item->name.'</a></li>';
        }
        $output .= '</ul>'; 
        return $output;
    }

}
