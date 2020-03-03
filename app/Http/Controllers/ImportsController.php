<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CustomerImport;
use App\Customer;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class ImportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //returns form to allow user to upload csv file
    public function index()
    {
        return view('imports.index');
    }

    //used to import the data
    public function import(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'required',
        ]);

        $file = $request->file('import_file')->getRealPath();

        $data = Excel::import(new CustomerImport,  $file);
        return back()->with('success', 'Customers Imported');
        
    }
}

