<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    function home(){
        return view('Front/home');
    }
    function about(){
        return view('Front/about');
    }
    function contact(){
        return view('Front/contact');
    }
    function services(){
        return view('Front/services');
    }
    
}
