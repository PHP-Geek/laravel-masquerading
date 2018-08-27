<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model {

    /**
     * foreign key with user package details
     */
    public function packageDetail() {
        return $this->hasMany(PackageDetail::class, 'packageId');
    }

    /**
     * get all the package having status active
     * 
     */
    function getAllPackages() {
        return $this->where('packageStatus', '1')->get();
    }

    /**
     * Insert package data
     * @param type $request
     * @return type
     */
    function addPackage($request) {
        $this->packageTitle = $request->packageTitle;
        $this->packageSlug = str_slug($request->packageTitle);
        $this->packagePrice = $request->packagePrice;
        $this->packageDescription = $request->packageDescription;
        $this->packageDuration = $request->packageDuration;
        $this->packageType = $request->packageType;
        $this->packageStatus = 1;
        $this->save();
        return $this->id;
    }


    /**
     * Update Package data
     * @param type $id
     * @param type $packageUpdateArray
     * @return type
     */
    function updatePackageData($id, $packageUpdateArray) {
        return $this->where('id', $id)->update($packageUpdateArray);
    }

}
