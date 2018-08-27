<?php

namespace App\Http\Controllers\analyst;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectType;
use Auth;
use app\User;
use Validator;
use App\Project;



class ProjectController extends Controller
{
    
    /**
     * project datatable
     * @param Request $request
     */
    function projectDatatable(Request $request) {
        $projectObj = new Project();
        $data = $projectObj->projectDatatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * project listing
     * @return type
     */
    function lists() {
        $data['projectTypes'] = ProjectType::where('projectTypeStatus', '1')->get();
        return view('analyst/project/lists')->with($data);
    }
    
    
   
    
    
}
