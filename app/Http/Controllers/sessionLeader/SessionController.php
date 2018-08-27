<?php

namespace App\Http\Controllers\sessionLeader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
   function showSession(){
       return view('sessionLeader/session/showSession');
   }
    function createSession(){
       return view('sessionLeader/session/createSession');
   }
   
     function copySession(){
       return view('sessionLeader/session/copySession');
   }
     function editSession(){
       return view('sessionLeader/session/editSession');
   }
    function participantList(){
       return view('sessionLeader/session/participantList');
   }
     function addParticipant(){
       return view('sessionLeader/session/addParticipant');
   }
   
    function defineDevice(){
       return view('sessionLeader/session/defineDevice');
   }
    function setParameterDevice(){
       return view('sessionLeader/session/setParameterDevice');
   }
   
   function createPhoneKitParticipant(){
       return view('sessionLeader/session/createPhoneKitParticipant');
   }
   
}
