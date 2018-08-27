<?php

namespace App\Http\Controllers\reviewer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    function monitorSession(){
	
	return view('reviewer/session/monitorSession');
    }
    
     function showSession(){
	
	return view('reviewer/session/showSession');
    }
     function setDeviceParameter(){
	
	return view('reviewer/session/setDeviceParameter');
    }
}
