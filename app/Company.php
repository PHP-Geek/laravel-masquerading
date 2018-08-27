<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    //
    /**
     * foriegn key with users
     */
    public function users() {
	$this->hasMany(User::class);
    }

    /**
     * add company details
     * @param type $request
     * @return type
     */
    function addCompany($request) {
	$this->companyName = $request->companyName;
	$this->companySlug = str_slug($request->companyName);
	$this->companyLOB = $request->companyLOB;
	$this->companyStatus = '0';
	$this->save();
	return $this->id;
    }

    /**
     * update the company
     * @param type $id
     * @param type $updateArray
     */
    function updateCompany($id, $updateArray) {
	return $this->where('id', $id)->update($updateArray);
    }

}
