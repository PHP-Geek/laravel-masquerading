<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\User;
use DB;
use Auth;
use App\Activity;

class SettingController extends Controller {
    
     protected $activityObj;

    function __construct() {
        $this->activityObj = new Activity();
       
    }

    /**
     * Load view of superadmin listing
     * @return type
     */
    function superadminListing() {
	return view('superadmin/setting/superadminListing');
    }

    /**
     * Superadmin datatables
     * @param Request $request
     * @return type
     */
    function superadminDatatable(Request $request) {
	$userObj = new User();
	$data = $userObj->getSuperadminDatatable($request);
	return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * Add superadmin view & functionality
     * @param Request $request
     * @return type
     */
    function addSuperadmin(Request $request, $userId = 0) {
	$data = array();
	$data['userId'] = $userId;
	if ($userId > 0) {
	    $userObj = new User();
	    $userObj = $userObj->getUserData($userId);
	    $data['userDetailArray'] = $userObj;
	} else {
	    $userObj = new User();
	}
	if ($request->method() == 'POST') {
	    if ($userId > 0) {
		$rules = [
		    'email' => 'required|unique:users,email,' . $userId,
		    'firstName' => 'required',
		    'lastName' => 'required',
		    'userName' => 'required|unique:users,userName' . $userId,
		    'contactNo' => 'required'
		];
	    } else {
		$rules['password'] = 'required';
		$rules['confirmPassword'] = 'required|same:password';
	    }
	    $rules['firstName'] = 'required';
	    $rules['userName'] = 'required';
	    $rules['email'] = 'required';
	    $rules['lastName'] = 'required';
	    $rules['contactNo'] = 'required';

	    $validator = Validator::make($request->all(), $rules);
	    if (!$validator->fails()) {
		if ($userId == 0) {
		    $userId = $userObj->addSuperadmin($request);
		    //insert into profile table
		    $profileDetailObj = new \App\Profile();
		    $profileDetailObj->extraProperty1 = $request->input('extraProperty1');
		    $profileDetailObj->extraProperty2 = $request->input('extraProperty2');
		    $profileDetailObj->userId = $userId;
		    $profileDetailObj->save();
		    //insert the user roles
		    $userRole = new \App\UserRole();
		    $userRole->roleId = '1';
		    $userRole->userId = $userId;
		    $userRole->save();

		    return response()->json(['code' => '1', 'message' => 'Superadmin created successfully!!!']);
		} else {
		    $editUserArray = ['firstName' => $request->firstName,
			'userName' => $request->userName,
			'email' => $request->email,
			'lastName' => $request->lastName,
			'phone' => $request->contactNo,
		    ];
		    $userObj->updateUserData($userId, $editUserArray);

		    $editProfileArray = [
			'extraProperty1' => $request->extraProperty1,
			'extraProperty2' => $request->extraProperty2,
		    ];

		    \App\Profile::where('userId', $userId)->update($editProfileArray);
		    return response()->json(['code' => '1', 'message' => 'Superadmin edited successfully!!!']);
		}
	    } else {
		return response()->json(['code' => '-1', 'message' => 'Something went wrong', 'data_array' => $validator->errors()->all()]);
	    }
	    return response()->json(['code' => '0', 'message' => 'Error creating superadmin!!!']);
	}

	return view('superadmin/setting/addSuperadmin')->with($data);
    }

}
