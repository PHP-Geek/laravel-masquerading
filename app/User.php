<?php

namespace App;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use DB;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
	'password', 'remember_token',
    ];

    /**
     * foreign key with user role
     */
    public function userRole() {
	return $this->hasMany(UserRole::class, 'userId')->join('roles', 'roles.id', '=', 'user_roles.roleId')->select('roles.*', 'user_roles.userId');
    }

    /**
     * return the foreign key from companies
     * @return type
     */
    function company() {
	return $this->belongsTo(Company::class, 'companyId');
    }

    /**
     * return the foreign key from companies
     * @return type
     */
    function profile() {
	return $this->hasOne(Profile::class, 'userId');
    }

    function groupUser() {
	return $this->hasOne(GroupUser::class, 'userId');
    }

    /**
     * return the foreign key from companies
     * @return type
     */
    function userPackage() {
	return $this->hasOne(UserPackage::class, 'userId')->join('packages', 'packages.id', '=', 'user_packages.packageId')->where('user_packages.userPackageStatus', '1')->select('packages.*', 'user_packages.packageInit', 'user_packages.packageExpire');
    }

    /**
     * foreign key from users table for project owner
     * @return type
     */
    function projectOwner() {
	return $this->hasOne(Project::class, 'projectOwner');
    }

    /**
     * foreign key from users table for project template owner
     * @return type
     */
    function projectTemplateOwner() {
	return $this->hasOne(ProjectTemplate::class, 'projectOwner');
    }

    /**
     * Insert superadmin data
     * @param type $request
     * @return type
     */
    function addSuperadmin($request) {
	$this->userName = $request->userName;
	$this->firstName = $request->firstName;
	$this->lastName = $request->lastName;
	$this->email = $request->email;
	$this->phone = $request->contactNo;
	$this->password = Hash::make(md5($request->password));
	$this->userStatus = 1;
	$this->save();
	return $this->id;
    }

    /**
     * add users by the admin for the company staff
     * @param type $request
     */
    function addUser($request) {
	$this->userName = isset($request->userName) ? $request->userName : $request->email;
	$this->firstName = $request->firstName;
	$this->lastName = isset($request->lastName) ? $request->lastName : '';
	$this->email = $request->email;
	$this->phone = $request->phone;
	$this->password = Hash::make(md5(isset($request->password) ? $request->password : 'Vadi2Vadi#'));
	$this->companyId = Auth::user()->companyId;
	$this->userStatus = 1;
	$this->activated = 1;
	$this->save();
	return $this->id;
    }

    /**
     * Get superadmin data
     * @param type $request
     * @return type
     */
    function getSuperadminDatatable($request) {
	$data = $this->join('profiles', 'profiles.userId', '=', 'users.id')
		->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->where([
	    ['user_roles.roleId', '=', '1'],
	    ['users.id', '!=', Auth::user()->id],
	    ['users.userStatus', '!=', '-1']
	]);
	//filtration for keyword
	if (isset($request->keyword) && $request->keyword != '') {
	    $data = $data->where(function($query) use ($request) {
		$query->orWhere('users.firstName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.lastName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.email', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.userName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.phone', 'LIKE', '%' . $request->keyword . '%');
	    });
	}
	$datacount = $data->count();
	$dataArray = $data->select('users.*', 'profiles.extraProperty1', 'profiles.extraProperty2');
	if ($request->length == -1) {
	    $dataArray = $dataArray->get();
	} else {
	    $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
	}
	return [$datacount, $dataArray];
    }

    /**
     * get new customers datatable
     * @param type $request
     * @return type
     */
    function getNewCustomerDatable($request) {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->leftJoin('user_packages', 'user_packages.userId', '=', 'users.id')
		->leftJoin('packages', 'packages.id', '=', 'user_packages.packageId')
		->join('companies', 'companies.id', '=', 'users.companyId')
		->join('LOBs', 'LOBs.id', '=', 'companies.companyLOB')
		->where([
	    ['user_roles.roleId', '=', '3'],
	    ['users.userStatus', '=', '0'],
	    ['users.activated', '=', '0'],
	    ['user_packages.userPackageStatus', '!=', '-1'],
	    ['companies.companyStatus', '=', '0']
	]);

	//filter by group name
	if ($request->createdAt != null && $request->createdAt != '') {

	    $data->whereBetween('users.created_at', [date('Y-m-d 00:00:00', strtotime($request->createdAt)), date('Y-m-d 23:59:59', strtotime($request->createdAt))]);
	}

	//filtration for keyword
	if (isset($request->keyword) && $request->keyword != '') {
	    $data = $data->where(function($query) use ($request) {
		$query->orWhere('users.firstName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.lastName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.email', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.phone', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('companies.companyName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('LOBs.title', 'LIKE', '%' . $request->keyword . '%');
	    });
	}
	$datacount = $data->count();
	$dataArray = $data->select('users.*', DB::raw('DATE_FORMAT(users.created_at,"%m/%d/%Y %h:%i %p") as createdAt'), 'packages.packageTitle', 'packages.id AS packageId', 'companies.companyName', 'LOBs.title');
	if ($request->length == -1) {
	    $dataArray = $dataArray->get();
	} else {
	    $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
	}
	return [$datacount, $dataArray];
    }

    /**
     * get approved customer or deactivated customers
     * @param type $request
     * @return type
     */
    function getApprovedCustomers($request) {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->leftJoin('user_packages', 'user_packages.userId', '=', 'users.id')
		->leftJoin('packages', 'packages.id', '=', 'user_packages.packageId')
		->join('companies', 'companies.id', '=', 'users.companyId')
		->join('LOBs', 'LOBs.id', '=', 'companies.companyLOB')
		->where([
	    ['user_roles.roleId', '=', '3'],
	    ['users.activated', '=', '1'],
	    ['companies.companyStatus', '=', '1']
	]);
	//filration the user status for active/inactive and banned users
	if (isset($request->status) && $request->status != '') {
	    $data = $data->where('users.userStatus', $request->status);
	}
	//filtration for keyword
	if (isset($request->keyword) && $request->keyword != '') {
	    $data = $data->where(function($query) use ($request) {
		$query->orWhere('users.firstName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.lastName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.email', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('companies.companyName', 'LIKE', '%' . $request->keyword . '%');
	    });
	}
	$datacount = $data->count();
	$dataArray = $data->select('users.*', 'packages.packageTitle', 'packages.id AS packageId', 'companies.companyName', 'LOBs.title');
	if ($request->length == -1) {
	    $dataArray = $dataArray->get();
	} else {
	    $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
	}
	return [$datacount, $dataArray];
    }

    /**
     * get company user data
     * @param type $companyId
     * @param type $request
     */
    function getCompanyUsers($companyId, $request) {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->join('roles', 'roles.id', '=', 'user_roles.roleId')
		->join('companies', 'companies.id', '=', 'users.companyId')
		->where([
	    ['user_roles.roleId', '>', '3'],
	    ['users.activated', '=', '1'],
	    ['users.companyId', '=', $companyId],
	    ['companies.companyStatus', '=', '1']
	]);
	//filtration the user status for active/inactive and banned users
	if (isset($request->roleId) && $request->roleId != '') {
	    $data = $data->where('user_roles.roleId', $request->roleId);
	}
	//filtration for keyword
	if (isset($request->keyword) && $request->keyword != '') {
	    $data = $data->where(function($query) use ($request) {
		$query->orWhere('users.firstName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.lastName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.email', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('users.phone', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('companies.companyName', 'LIKE', '%' . $request->keyword . '%');
	    });
	}
	$datacount = $data->count();
	$dataArray = $data->select('users.*', DB::raw('DATE_FORMAT(users.created_at,"%d/%m/%Y %h:%i %p") AS userCreated'), 'roles.roleName');
	if ($request->length == -1) {
	    $dataArray = $dataArray->get();
	} else {
	    $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
	}
	return [$datacount, $dataArray];
    }

    /**
     * update user data 
     * @param type $id
     * @param type $userUpdateArray
     * @return type
     */
    function updateUserData($id, $userUpdateArray) {
	return $this->where('id', $id)->update($userUpdateArray);
    }

    /**
     * add the user admin
     * @param type $request
     * @param type $companyId
     */
    function addUserAdmin($request, $companyId = 0) {
	$this->userName = $request->userName;
	$this->firstName = $request->firstName;
	$this->lastName = $request->lastName;
	$this->email = $request->email;
	$this->phone = $request->phone;
	$this->companyId = $companyId;
	$this->userStatus = '0';
	$this->isCompanyOwner = '1';
	$this->ipAddress = \Request::ip();
	$this->userAgent = \Request::header('user-agent');
	$this->password = Hash::make(md5($request->password));
	$this->save();
	return $this->id; //return the user admin id
    }

    /**
     * get user data with or without id
     * @param type $id
     * @return type
     */
    function getUserData($id = '') {
	$data = $this->leftJoin('profiles', 'profiles.userId', '=', 'users.id')
		->join('user_roles', 'user_roles.userId', '=', 'users.id');
	if ($id != '') {
	    $data = $data->where('users.id', $id);
	}
	$data = $data->select('users.*', 'profiles.extraProperty1', 'profiles.extraProperty2', 'profiles.dateOfBirth', 'profiles.address', 'profiles.address1', 'profiles.state', 'profiles.country_id', 'profiles.city', 'profiles.pinCode')->first();
	return $data;
    }

    /**
     * get the new customers 
     * @param type $id
     */
    function getNewCustomers($id = '') {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->leftJoin('user_packages', 'user_packages.userId', '=', 'users.id')
		->leftJoin('packages', 'packages.id', '=', 'user_packages.packageId')
		->join('companies', 'companies.id', '=', 'users.companyId')
		->where([
	    ['user_roles.roleId', '=', '3'],
	    ['users.userStatus', '=', '0'],
	    ['users.activated', '=', '0'],
	    ['user_packages.userPackageStatus', '!=', '-1'],
	    ['companies.companyStatus', '=', '0']
	]);
	if ($id != '') {
	    $data = $data->where('users.id', $id);
	}
	$dataArray = $data->select('users.*', 'packages.packageTitle', 'packages.id AS packageId', 'companies.companyName')->first();
	return $dataArray;
    }

    /**
     * get the user detail by user name
     * @param type $userName
     */
    function getUserByUserName($userName) {
	return $this->where('userName', $userName)->first();
    }

    /**
     * get the user detail by user name
     * @param type $userName
     */
    function getUserByEmail($email) {
	return $this->where('email', $email)->first();
    }

    function countNewCustomer() {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->leftJoin('user_packages', 'user_packages.userId', '=', 'users.id')
		->leftJoin('packages', 'packages.id', '=', 'user_packages.packageId')
		->join('companies', 'companies.id', '=', 'users.companyId')
		->where([
	    ['user_roles.roleId', '=', '3'],
	    ['users.userStatus', '=', '0'],
	    ['users.activated', '=', '0'],
	    ['user_packages.userPackageStatus', '!=', '-1'],
	    ['companies.companyStatus', '=', '0']
	]);
	$datacount = $data->count();
	return $datacount;
    }

    /**
     * get analyts
     * @return type
     */
    function getAnalyst() {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->join('roles', 'roles.id', '=', 'user_roles.roleId')
		->where([
	    ['user_roles.roleId', '=', '4'],
	    ['users.companyId', Auth::user()->companyId],
	]);
	$data = $data->select('users.id', 'users.email')->get();
	return $data;
    }

    

    /**
     * search user by keyword and role id and so on
     * @param type $keyword
     * @param type $roleId
     * @return type
     * @authoer Bharti <bharti.php@erginous.com>
     */
    function searchUser($keyword = '', $roleId = '', $companyId = '') {
	$data = $this->join('user_roles', 'users.id', '=', 'user_roles.userId');
	if ($keyword != '') {
	    $data = $data->where(function($query) use ($keyword) {
		$query->orWhere('firstName', 'like', '%' . $keyword . '%');
		$query->orWhere('lastName', 'like', '%' . $keyword . '%');
		$query->orWhere('userName', 'like', '%' . $keyword . '%');
		$query->orWhere('email', 'like', '%' . $keyword . '%');
	    });
	}
	if ($companyId != '') {
	    $data = $data->where('users.companyId', $companyId);
	}
	if ($roleId != '') {
	    $data = $data->where('roleId', $roleId);
	}
	return $data->where('userRoleStatus', '=', '1')
			->select('users.*')
			->get();
    }

    /**
     * get the group managers
     */
    function getGroupManagers() {
	$data = $this->join('user_roles', 'user_roles.userId', '=', 'users.id')
		->join('groups', 'groups.groupManagerId', '=', 'users.id');
	//get those group managers assigned to particular groups or subgroups
	if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
	    $data = $data->whereIn('groups.id', \Session::get('myGroups'));
	}
	$data = $data->where('user_roles.roleId', '8')->where('users.companyId', Auth::user()->companyId)->select('users.*')->groupBy('users.id')->get();
	return $data;
    }

}
