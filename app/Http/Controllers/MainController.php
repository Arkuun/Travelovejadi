<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wisata;
use App\Berita;
use App\Event;

class MainController extends Controller
{
    public function index(){

    	$wisata = Wisata::where('status',1)->get();
        return view('xfront/beranda',compact('wisata'));
        

    }

    public function event(){
    	$event = Event::where('status',1)->paginate(3);
    	return view('xfront/event',compact('event'));
    }

   
}
