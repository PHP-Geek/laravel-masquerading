<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CloudSpeechController;
use Google\Cloud\Speech\SpeechClient;
use Validator;
use App\User;
use App\Country;
use App\State;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class CommonController extends Controller {

    /**
     * convert speech to text screen and post request handling
     * @param Request $request
     * @return type
     */
    function convertSpeechToText(Request $request) {
//        $cloudSpeechObj = new CloudSpeechController();
//        $data['transcriptionData'] = $cloudSpeechObj->convertSpeechToText(public_path('/uploads/flac/phpCG9yIE_1528452767.flac'));
//        dd($data['transcriptionData']);
        $data = [];
        if ($request->method() == 'POST') {
            if ($request->file('fileName') != null && $request->file('fileName') != null && $request->file('fileName') != '')
                $file = $request->file('fileName');
            $extension = $file->getClientOriginalExtension();
            if (strtoupper($extension != 'flac')) {
                $data['error'] = 'Please upload only flac file';
            } else {
                $destinationPath = public_path('/uploads/flac');
                $fileName = $file->getFilename() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $fileName);
                $cloudSpeechObj = new CloudSpeechController();
                $data['transcriptionData'] = $cloudSpeechObj->convertSpeechToText($destinationPath . '/' . $fileName);
                $data['success'] = "Success";
            }
        }
        return view('common.converSpeechToText')->with($data);
    }

    /**
     * edit profile
     * @param Request $request
     * @return type
     */
    function editProfile(Request $request) {
        $data = array();
        //get user profile data
        $userObj = new User();
        $userObj = $userObj->getUserData(Auth::user()->id);
        $data['userProfileArray'] = $userObj;
        //get countries data
        $countryObj = new Country();
        $countryObj = $countryObj->getCountries();
        $data['countriesArray'] = $countryObj;

        if ($request->method() == 'POST') {
            $rules = [
                'firstName' => '',
                'lastName' => '',
                'contactNo' => ''
            ];

            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {

                $editUserArray = ['firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'phone' => $request->contactNo,
                ];
                $userObj->updateUserData(Auth::user()->id, $editUserArray);

                $editProfileArray = [
                    'address' => $request->address,
                    'address1' => $request->address1,
                    'country_id' => $request->country_id != null ? $request->country_id : 0,
                    'state' => $request->stateId != null ? $request->stateId : 0,
                    'city' => $request->city != null ? $request->city : 0,
                    'dateOfBirth' => date('Y-m-d', strtotime($request->dateOfBirth)),
                    'pinCode' => $request->pinCode,
                ];

                \App\Profile::where('userId', Auth::user()->id)->update($editProfileArray);
                return response()->json(['code' => '1', 'message' => 'Profile updated successfully!!!']);
            } else {
                return response()->json(['code' => '-1', 'message' => 'Something went wrong', 'data_array' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Error editing profile!!!']);
        }
        return view('common/editProfile')->with($data);
    }

    /**
     * get States 
     */
    function getStateData(Request $request) {
        $stateObj = new State();
        $stateObj = $stateObj->getStates($request);
        echo json_encode($stateObj);
    }

    /**
     * import excel file with sheets
     * @param type $excelFile
     */
    function importExcelSheets($excelFile = '') {
        if ($excelFile != '') {
            $excel = (new FastExcel())->importSheets($excelFile);
            return $excel;
        }
        return [];
    }

    /**
     * import the csv file 
     * @param type $file
     * @return string
     */
    function importCSV($file = '') {
        if ($file != '') {
            $handle = fopen($file, 'r');
            $ProductData = [];
            $column = fgetcsv($handle);
            while (!feof($handle)) {
                $ProductData[] = fgetcsv($handle);
            }
            $time_now = date('Y-m-d H:i:s');
//To check any empty field
            if (count($ProductData[0]) < 10) {
                return 'Looks like insufficient data or no data in the file';
            }
            foreach ($ProductData as $key => $products) {
                if ($products != false) {
                    if ($products[0] == '' || $products[1] == '' || $products[2] == '') {
                        return 'Please enter all required data at row' . " " . ($key + 1);
                    }
                }
            }
            return $ProductData;
        }
        return '0';
    }

    /**
     * masquerade customer admin from vadi admin
     * @param Request $request
     * @return int
     */
    function masqueradeCustomer(Request $request) {
        $userId = $request->userId;
        $userDetailArray = User::find($userId);
        if (count($userDetailArray) > 0 && $userDetailArray->companyId > 0 && $userDetailArray->isCompanyOwner == '1') {
            \Session::put('superadmin.loggedIn', Auth::user());
            Auth::login($userDetailArray);
            return response()->json(['code' => '1', 'message' => 'Successful']);
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * remove the masquerading
     * @param Request $request
     * @return type
     */
    function dropMasquerade(Request $request) {
        $userId = $request->userId;
        $userDetailArray = User::find($userId);
        if (count($userDetailArray) > 0 && $userDetailArray->userRole[0]->id == '1') {
            \Session::forget('superadmin.loggedIn');
            Auth::login($userDetailArray);
            return response()->json(['code' => '1', 'message' => 'Successful']);
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

}
