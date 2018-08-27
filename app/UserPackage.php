<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model {

    public $timestamps = true;

    /**
     * foreign key for users
     */
    function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * save the user package
     * @param type $request
     * @param type $array [0=>userId,1=>userId]
     */
    function add($requestArr) {
        return $this->insertGetId($requestArr);
    }

    /**
     * update user package by user id
     * @param type $userId
     * @param type $updateArray
     */
    function updateDataById($id, $updateArray = []) {
        return $this->where('id', $id)->update($updateArray);
    }

    /**
     * get the queued package by the user id
     * @param type $userId
     */
    function getQueuedPackageByUserId($userId) {
        return $this->join('packages', 'packages.id', '=', 'user_packages.packageId')
                        ->where([
                            ['userId', '=', $userId],
                            ['userPackageStatus', '=', '0']
                        ])->select('user_packages.*','packages.packageTitle','packageSlug','packages.packagePrice')->first();
    }

}
