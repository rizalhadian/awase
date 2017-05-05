<?php

namespace awase\Http\Controllers;

use Illuminate\Http\Request;

class RestAuth extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
