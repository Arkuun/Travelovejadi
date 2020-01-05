<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::attempt(['email' => 'bawor@gmail.com', 'password' => 'bawor'])){ 
        //     $user = Auth::user(); 
        //     return response()->json(['success' => $user]); 
        // } 
        // else{ 
        //     return response()->json(['error'=>'Unauthorised'], 401); 
        // } 
        $title='OJAL';
        return view('xmanage.dashboard.index',compact('title'));
    }

}
