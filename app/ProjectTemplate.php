<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class ProjectTemplate extends Model {
    
    
    
    
      /**
     * foreign key for user with project owner
     * @return type
     */
    function owner() {
        return $this->belongsTo(User::class, 'projectOwner');
    }

    /**
     * add the project template data
     * @param type $request
     */
    function add($request) {
//add the data to table in project table
        $this->companyId = Auth::user()->companyId;
        $this->projectTypeId = $request->projectTypeId;
        $this->groupId = $request->groupId;
        $this->projectTitle = $request->projectTitle;
        $this->projectSlug = str_slug($request->projectTitle);
        $this->templateCreatedBy = Auth::user()->id;
        $this->projectDescription = $request->projectDescription;
        $this->projectSessionCount = $request->projectSessionCount;
        $this->projectOwner = $request->projectOwner;
        $this->projectClient = $request->projectClient;
        $this->save();
        $projectTemplateId = $this->id;
        if ($projectTemplateId > 0) {
            return $projectTemplateId;
        }
        return '0';
    }

    /**
     * project templates datatable
     * @param type $request
     */
    function datatable($request) {
        $data = $this->leftJoin('project_types', 'project_templates.projectTypeId', '=', 'project_types.id')
                ->leftJoin('groups', 'groups.id', '=', 'project_templates.groupId')
                ->leftJoin('users AS owners', 'owners.id', '=', 'project_templates.projectOwner')
                ->leftJoin('users', 'users.id', '=', 'project_templates.templateCreatedBy')
                ->where([
            ['project_templates.status', '!=', '-1'],
            ['project_templates.companyId', '=', Auth::user()->companyId]
        ]);
        $data = $data->select('project_templates.*', 'users.firstName', 'users.lastName', 'owners.firstName AS ownerFirstName', 'owners.lastName AS ownerLastName', 'groups.groupName', 'project_types.projectTypeName', DB::raw('DATE_FORMAT(project_templates.created_at,"%m/%d/%Y %h:%i %p") as projectCreatedOn'));

//filtration for keyword
        if (isset($request->keyword) && $request->keyword != '') {
            $data = $data->where(function($query) use ($request) {
                $query->orWhere('project_templates.projectTitle', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('project_types.projectTypeName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('groups.groupName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('project_templates.projectSessionCount', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('project_templates.projectClient', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('owners.firstName', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        
         if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $data = $data->whereIn('groups.id', \Session::get('myGroups'));
        }
        $datacount = $data->count();
        if ($request->length == -1) {
            $dataArray = $data->get();
        } else {
            $dataArray = $data->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }
       /**
     * update the project template by id
     * @param type $id
     * @param type $requestArr
     * @return type
     */
    function editbyId($id, $requestArr) {
        if ($this->where('id', $id)->update($requestArr) == 1) {
            return $id;
        }
        return 0;
    }

}
