<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
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
        //
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
    
    public function find(Request $request){
        $data = $request->all();
        $query_data = $data['val'];
        // $cust_results = Customer::where('name', 'LIKE','%' . $data . '%')-->get();
        $data = Customer::where('name', 'like', "%{$query_data}%")->get();
        return $data;
        // $output = '<ul class="dropdown-menu" style="display:block">';
        // foreach($data as $k => $item){
        //     $output .= '
        //             <li class = "dropdown-item">
        //                 <a href="/customers/'.$item[$k]->customer_id.'>'.$item[$k]->name.'</a>"
        //             </li>;';
        // }
        // $output .= '</ul>';
        // return $output;
        
    }

}
