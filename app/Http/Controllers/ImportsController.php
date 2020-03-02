<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Customer;


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

        Excel::import(new CustomersImport, request()->file('import_file'));
        return back();
    }
}

