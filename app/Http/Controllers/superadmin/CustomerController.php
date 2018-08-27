<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Company;
use App\Project;
use App\Group;
use App\Helpers\Packages;
use Validator;
use Hash;
use App\Activity;
use App\LOB;

class CustomerController extends Controller {

    protected $activityObj;

    function __construct() {
        $this->activityObj = new Activity();
        $this->middleware('web');
    }

    /**
     * customer listing
     * @return type
     */
    function customerListing() {
        return view('superadmin/customer/customerListing');
    }

    /**
     * customer datatable
     * @param Request $request
     */
    function customerDatatable(Request $request) {
        $userObj = new User();
        $data = $userObj->getApprovedCustomers($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * Add new customer
     * @param Request $request
     * @return type
     */
    function add(Request $request) {
        if ($request->method() == 'POST') {
            //validation for the controls
            $rules = [
                'userName' => 'required|unique:users',
                'firstName' => 'required',
                'lastName' => 'required',
                'password' => 'required',
                'confirmPassword' => 'required',
                'companyName' => 'required',
                'phone' => 'required',
                'email' => 'required|unique:users',
                'companyLOB' => 'required',
                'packageId' => 'required'
            ];
            $messages = [
                'userName.unique' => 'Username already exist',
                'email.unique' => 'Email already exist'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $companyObj = new Company();
                $companyId = $companyObj->addCompany($request);
                $companyObj->updateCompany($companyId, ['companyStatus' => '1']);
                
                $userObj = new User();
                $userId = $userObj->addUserAdmin($request, $companyId);
                $userObj->updateUserData($userId, [
                            'activated' => '1',
                            'userStatus' => '1'
                        ]);

                //insert into profile table
                $profileDetail = new \App\Profile();
                $profileDetail->userId = $userId;
                $profileDetail->save();

                //insert the user roles
                $userRole = new \App\UserRole();
                $userRole->roleId = '3';
                $userRole->userId = $userId;
                $userRole->save();



                $userPackageObj = new \App\UserPackage();
                if ($userPackageObj->add([
                            'userId' => $userId,
                            'packageId' => $request->packageId,
                            'userPackageStatus' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]) > 0) {
                    
                       
                    //add quick group
                    $groupObj = new Group();
                    $groupId = $groupObj->addQuickGroup($request, $companyId , $userId);

                    //add quick  project
                    $projectObj = new Project();
                    $projectObj->addQuickProject($request, $companyId, $groupId , $userId); 
                    
                   
                    return response()->json(['code' => '1', 'message' => 'Customer added successfully']);                  
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        $data['lobs'] = LOB::get();
        $data['packages'] = \App\Package::get();
        return view('superadmin/customer/add')->with($data);
    }

    /**
     * change password for customer
     * @param type $id
     * @param Request $request
     */
    function changePassword($id = 0, Request $request) {
        $userObj = User::find($id); //get the user data
        $data['userDetailArray'] = $userObj;
        if (count($data['userDetailArray']) > 0) {
            if ($request->method() == 'POST') {
                //validation for the password
                $rules = [
                    'newPassword' => 'required',
                    'confirmPassword' => 'required|same:newPassword'
                ];
                $validator = Validator::make($request->all(), $rules);
                if (!$validator->fails()) {
                    $userObj->password = Hash::make(md5($request->newPassword));
                    $userObj->save(); //update the password
                    return response()->json(['code' => '1', 'message' => 'Password changed']);
                } else {
                    return response()->json(['code' => '0', 'message' => $validator->errors()->all()]);
                }
                return response()->json(['code' => '0', 'message' => 'Something went wrong']);
            }
            return view('superadmin/customer/changePassword');
        } else {
            if ($request->method() == 'POST') {
                return response()->json(['code' => '0', 'message' => 'Something went wrong']);
            } else {
                return redirect('/customers');
            }
        }
    }

    /**
     * view customer 
     * @param type $id
     * @return type
     */
    function viewCustomer(User $id) {
        $data['user'] = $id;
        return view('superadmin/customer/viewCustomer')->with($data);
    }

    /**
     * edit customer screen
     * @param User $id
     */
    function editCustomer(User $id, Request $request) {
        $data['user'] = $id;
        if ($request->method() == 'POST') {
            $rules = [
                'email' => 'required|unique:users,email,' . $id->id,
                'firstName' => 'required',
                'lastName' => 'required',
                'phone' => 'required',
                'companyName' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                Company::where('id', $id->company->id)->update(['companyName' => $request->companyName, 'companySlug' => str_slug($request->companyName)]);
                $editUserArray = [
                    'firstName' => $request->firstName,
                    'email' => $request->email,
                    'lastName' => $request->lastName,
                    'phone' => $request->phone,
                ];
                $userObj = new User();
                $userObj->updateUserData($id->id, $editUserArray);
                return response()->json(['code' => '1', 'message' => 'User updated successfully!!!']);
            } else {
                return response()->json(['code' => '-1', 'message' => 'Something went wrong', 'data_array' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Error creating superadmin!!!']);
        }
        return view('superadmin/customer/editCustomer')->with($data);
    }

    /**
     * account request datatables
     * @param Request $request
     */
    function accountRequestDatatable(Request $request) {
        $userObj = new User();
        $data = $userObj->getNewCustomerDatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * approve customer
     * @param Request $request
     */
    function approveCustomer(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'userId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $userObj = new User();
                $userDetails = $userObj->getNewCustomers($request->userId);
                if (count($userDetails) > 0) {
                    $userPackageObj = new \App\UserPackage();
                    $userPackageDetail = $userPackageObj->getQueuedPackageByUserId($userDetails->id);
                    if (count($userPackageDetail) > 0) {
                        //calculate package start and expiry date
                        $packageStart = date('Y-m-d H:i:s');
                        $packageHelperObj = new Packages();
                        $packageExipryDate = $packageHelperObj->calculateExpiryDate($userPackageDetail->packageId, $packageStart);
                        //activate the user
                        $userObj->updateUserData($request->userId, [
                            'activated' => '1',
                            'userStatus' => '1'
                        ]);
                        //activate the company
                        $companyObj = new Company();
                        $companyObj->updateCompany($userDetails->companyId, ['companyStatus' => '1']);
                        //start the package
                        $userPackageObj->updateDataById($userPackageDetail->id, [
                            'packageInit' => $packageStart,
                            'packageExpire' => $packageExipryDate,
                            'userPackageStatus' => '1'
                        ]);
                        //add quick group
                        $groupObj = new Group();
                        $groupId = $groupObj->addQuickGroup($request, $userDetails->companyId ,$request->userId);
                        //add quick  project
                        $projectObj = new Project();
                        $projectObj->addQuickProject($request, $userDetails->companyId, $groupId ,$request->userId);
                        //add activity logs
                        $this->activityObj->add('Aprroved Customer', $userDetails->firstName . ' ' . $userDetails->lastName . ' has been approved by ' . Auth::user()->firstName . ' ' . Auth::user()->lastName);
                        return response()->json(['code' => '1', 'message' => 'successful']);
                    }
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * approve customer
     * @param Request $request
     */
    function deleteCustomer(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'userId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $userObj = new User();
                $userDetails = $userObj->getNewCustomers($request->userId);
                if (count($userDetails) > 0) {
                    if (count($userPackageDetail) > 0) {
                        return response()->json(['code' => '1', 'message' => 'successful']);
                    }
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * 
     * @return type
     */
    function accountRequest() {
        return view('superadmin/customer/accountRequest');
    }

}
