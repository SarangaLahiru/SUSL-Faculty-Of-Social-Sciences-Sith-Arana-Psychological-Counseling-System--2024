<?php

namespace App\Http\Controllers;

use App\Models\counsellor;

class HomeController extends Controller
{
    public function index(){

        $counsellors = counsellor::all();
        return view('welcome',[
            'counsellors' => $counsellors,
        ]);
    }
    
    public function aboutus(){
        return view('aboutus');
    }
    
    
    public function contactus(){
        return view('contactus');
    }
    
}
