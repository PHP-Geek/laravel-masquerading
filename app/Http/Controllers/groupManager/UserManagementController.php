<?php

namespace App\Http\Controllers\groupManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Auth;
use App\User;
use App\Group;
use App\Http\Controllers\CommonController;
use Validator;
use App\Activity;
use Hash;

class UserManagementController extends Controller {

    /**
     * Add Group
     * @param Request $request
     * @param Group $id
     * @return type
     */
    function addGroup(Request $request, Group $group) {
        $data = [];
        if (count($group) > 0) {
            $data['groupDetail'] = $group;
        }
        if ($request->method() == 'POST') {
            $rules = [
                'groupName' => 'required',
                'groupDescription' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $editFlag = 0;
                if (count($group) > 0 && $group->id > 0) {
                    $addGroupObj = $group;
                    $editFlag = 1;
                } else {
                    $addGroupObj = new \App\Group();
                }
                $addGroupObj->groupName = $request->groupName;
                $addGroupObj->groupSlug = str_slug($request->groupName);
                $addGroupObj->groupDescription = $request->groupDescription;
                $addGroupObj->groupParentId = $request->groupParentId;
                $addGroupObj->groupManagerId = $request->groupManagerId;
                $addGroupObj->groupCreatedBy = Auth::user()->id;
                $addGroupObj->groupLastUpdatedBy = Auth::user()->id;
                $addGroupObj->companyId = Auth::user()->companyId;
                $addGroupObj->groupUpdatedOn = date('Y-m-d h:i:s');
                $addGroupObj->save();
                if ($addGroupObj->id > 0) {
                    if ($editFlag == 0) {
                        //add new group id to current session
                        \Session::push('myGroups', $addGroupObj->id);
                    }
                    \App\GroupUser::where('groupId', $addGroupObj->id)->delete();
                    if (isset($request->userId) && count($request->userId) > 0) {
                        foreach ($request->userId as $userId) {
                            $addGroupUserObj = new \App\GroupUser();
                            $addGroupUserObj->groupId = $addGroupObj->id;
                            $addGroupUserObj->userId = $userId;
                            $addGroupUserObj->save();
                        }
                    }
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        if (count($group) > 0 && $group->id > 0) {
            $groupObj = new Group();
            $data['groupName'] = Group::whereNotIn('id', $groupObj->getChildsById($group->id))->get();
        } else {
            $data['groupName'] = Group::where('groupStatus', '1')->whereIn('groups.id', \Session::get('myGroups'))->get();
        }
        $userObj = new User();
        $data['groupManagers'] = $userObj->getGroupManagers();
        return view('groupManager/userManagement/addGroup')->with($data);
    }

    /**
     * group listing
     * @return type
     */
    function groups() {
        return view('groupManager/userManagement/viewGroup');
    }

    /**
     * get the user datatable
     * @param Request $request
     */
    function groupDatatable(Request $request) {
        $groupObj = new Group();
        $data = $groupObj->getGroupDatatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * show the group hierarchy
     * @param Group $group
     */
    function groupHierarchy(Group $group) {
        $data['groupDetails'] = $group;
        return view('groupManager/userManagement/groupHierarchy')->with($data);
    }

    /**
     * get the group users
     * @param Group $group
     * @return type
     */
    function getGroupUser(Group $group) {
        $data = [];
        $groupUserObj = new \App\GroupUser();
        $groupUsers = $groupUserObj->getGroupUsersByGroupId($group->id);
        if (count($groupUsers) > 0) {
            $data = $groupUsers;
        }
        return response()->json($data);
    }

}
