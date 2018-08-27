<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Package;
use App\Activity;
use Auth;

class PricingController extends Controller {

    protected $activityObj;

    function __construct() {
        $this->activityObj = new Activity();
    }

    /**
     * load view of package listing
     * @param Request $request
     * @return type
     */
    function packages(Request $request) {
        $data = array();
        $data['packageDetailsArray'] = Package::get();
        return view('superadmin/pricing/packages')->with($data);
    }

    /**
     * Add package
     * @param Request $request
     * @return type
     */
    function add(Request $request, $packageId = 0) {
        $data = array();
        $data['packageId'] = $packageId;
        if ($packageId > 0) {
            $packageObj = Package::find($packageId);
            $data['packageDetailsArray'] = $packageObj;
        } else {
            $packageObj = new \App\Package();
        }
        if ($request->method() == 'POST') {
            $rules = [
                'packageTitle' => 'required',
                'packagePrice' => 'required',
                'packageDuration' => 'required',
                'packageDescription' => 'required',
                'packageType' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                //insert package data
                if ($packageId == 0) {
                    $packageId = $packageObj->addPackage($request);
                    /**
                     * Insert package detail
                     */
                    foreach ($request->input('description') as $description) {
                        if ($description != null && $description != '') {
                            $packageDetailObj = new \App\PackageDetail();
                            $packageDetailObj->packageId = $packageId;
                            $packageDetailObj->description = $description;
                            $packageDetailObj->save();
                        }
                    }
                    return response()->json(['code' => '1', 'message' => 'Package added successfully!!!']);
                } else {
                    //Update Package data
                    $editPackageArray = ['packageTitle' => $request->packageTitle,
                        'packagePrice' => $request->packagePrice,
                        'packageDescription' => $request->packageDescription,
                        'packageDuration' => $request->packageDuration,
                        'packageType' => $request->packageType,
                    ];
                    $packageObj->updatePackageData($packageId, $editPackageArray);
                    \App\PackageDetail::where('packageId', $packageId)->delete();
                    foreach ($request->input('description') as $description) {
                        if ($description != null && $description != '') {
                            $packageDetailObj = new \App\PackageDetail();
                            $packageDetailObj->packageId = $packageId;
                            $packageDetailObj->description = $description;
                            $packageDetailObj->save();
                        }
                    }
                    return response()->json(['code' => '1', 'message' => 'Package updated successfully!!!']);
                }
            } else {
                return response()->json(['code' => '-1', 'message' => 'Something went wrong', 'data_array' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Error creating package!!!']);
        }
        return view('superadmin/pricing/add')->with($data);
    }

}
