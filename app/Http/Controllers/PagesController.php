<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    public function index(){
        if(Auth::user()){
            return redirect('/dashboard');
        }
        else{
            return redirect('/login');
        }
    }
}
