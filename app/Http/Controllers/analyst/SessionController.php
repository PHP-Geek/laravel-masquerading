<?php

namespace App\Http\Controllers\analyst;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectSession;
use App\User;
use Auth;
use Validator;


class SessionController extends Controller
{
   /**
     * session datatable
     */
    function datatable(Request $request) {
	$sessionObj = new ProjectSession();
	$data = $sessionObj->sessionDatatable($request);
	return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * listing of the session under analyst
     * @return type
     */
    function index() {
	$data = [];
	return view('analyst/session/index')->with($data);
    }
    
   
}
