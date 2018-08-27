<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ProjectType extends Model {

    //
    /**
     * project type datatable
     * @param type $request
     * @return type
     */
    function getProjectTypeDatatable($request) {
        $data = $this->leftJoin('users', 'users.id', '=', 'project_types.projectTypeCreatedBy')
                ->where([['project_types.projectTypeStatus', '!=', '-1'], ['project_types.companyId', '=', Auth::user()->companyId]]);
	
	  //filtration for keyword
        if (isset($request->keyword) && $request->keyword != '') {
            $data = $data->where(function($query) use ($request) {
                $query->orWhere('project_types.projectTypeName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('users.firstName', 'LIKE', '%' . $request->keyword . '%');
               
            });
        }
        $datacount = $data->count();
        $dataArray = $data->select('project_types.*', 'users.firstName', 'users.lastName');
        if ($request->length == -1) {
            $dataArray = $dataArray->get();
        } else {
            $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }

}
