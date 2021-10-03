<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(Request $req){
        return view('Pages/Dashboard/dashboard');
    }
}
