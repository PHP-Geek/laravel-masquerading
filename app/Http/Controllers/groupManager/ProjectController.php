<?php

namespace App\Http\Controllers\groupManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectType;
use Auth;
use app\User;
use Validator;
use App\Group;
use App\Project;
use App\GroupUser;
use App\Activity;
use App\ProjectTemplate;
use App\ProjectSession;

class ProjectController extends Controller {

    /**
     * project type datatable
     * @param Request $request
     */
    function typeDatatables(Request $request) {
        $projectTypeObj = new ProjectType();
        $data = $projectTypeObj->getProjectTypeDatatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * listing of project types
     * @return type
     */
    function types() {
        $data = array();
        return view('groupManager/project/types');
    }

    /**
     * add/edit the project type data
     * @param Request $request
     * @param ProjectType $projectTypeData
     */
    function addType(Request $request, ProjectType $projectTypeData) {
        $data = [];
        $data['projectTypeData'] = $projectTypeData;
        if ($request->method() == 'POST') {
            $rules = ['projectTypeName' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                if (isset($projectTypeData) && $projectTypeData->id > 0) {
                    $projectTypeObj = $projectTypeData;
                    $title = 'Added Project Type';
                    $description = $request->projectTypeName . ' added by ' . Auth::user()->firstName . ' ' . Auth::user()->lastName;
                } else {
                    $projectTypeObj = new ProjectType();
                    $projectTypeObj->companyId = Auth::user()->companyId;
                    $projectTypeObj->projectTypeCreatedBy = Auth::user()->id;
                    $title = 'Updated Project Type';
                    $description = $request->projectTypeName . ' has been updated by ' . Auth::user()->firstName . ' ' . Auth::user()->lastName;
                }
                $projectTypeObj->projectTypeName = $request->projectTypeName;
                $projectTypeObj->noOfSpeakers = ($request->noOfSpeakers != '') ? $request->noOfSpeakers : '-1';
                $projectTypeObj->projectTypeStatus = '1';
                $projectTypeObj->save();


                if ($projectTypeObj->id > 0) {
                    return response()->json(['code' => '1', 'message' => 'Successful']);
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        return view('groupManager/project/addType')->with($data);
    }

    /**
     * change the project type status
     * @param Request $request
     */
    function changeProjectTypeStatus(Request $request) {
        if ($request->method() == 'POST') {
            $rules = ['id' => 'required', 'projectTypeStatus' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $projectTypeObj = ProjectType::find($request->id);
                $projectTypeObj->projectTypeStatus = $request->projectTypeStatus;
                $projectTypeObj->save();
                if ($projectTypeObj->id > 0) {
                    return response()->json(['code' => '1', 'message' => 'Successful']);
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->all()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
    }

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
        return view('groupManager/project/lists');
    }

    /**
     * create the project based on the company
     * @param Request $request
     * @param \App\Http\Controllers\groupmanager\Project $project
     * @return type
     */
    function add(Request $request, Project $project) {
        $data = [];
        if ($project->id > 0) {
            $data['projectDetail'] = $project;
        }
        if ($request->method() == 'POST') {
            $rules = [
                'projectTypeId' => 'required',
                'groupId' => 'required',
                'projectOwner' => 'required',
                'projectTitle' => 'required',
                'projectSessionCount' => 'required',
                'projectDescription' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {

                $projectObj = new Project();

                $projectTitleValidate = '';
                if ($project->id > 0) {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle, $project->id);
                } else {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle);
                }
                if ($projectTitleValidate == false) {
                    \Session::flash('error', 'Project name already exist!!');
                    return redirect(url(($project->id > 0) ? '/group-manager/project/edit/' . $project->id : '/group-manager/project/add'))->withInput();
                }
                if ($project->id > 0) {
                    $response = $projectObj->editbyId($project->id, [
                        'projectTypeId' => $request->projectTypeId,
                        'groupId' => $request->groupId,
                        'projectTitle' => $request->projectTitle,
                        'projectSlug' => str_slug($request->ptojectTitle),
                        'projectDescription' => $request->projectDescription,
                        'projectSessionCount' => $request->projectSessionCount,
                        'projectOwner' => $request->projectOwner,
                    ]);
                    if ($response > 0) {
                        \Session::flash('success', 'Success');
                        return redirect(url('/group-manager/project/edit/' . $project->id));
                    }
                } else {
                    //add the project
                    $response = $projectObj->add($request);
                    if ($response > 0) {
                        \Session::flash('success', 'Success');
                        return redirect(url('/group-manager/project/add'));
                    }
                }
            } else {
                \Session::flash('error', $validator->errors()->all()[0]);
                return redirect(url(($project->id > 0) ? '/group-manager/project/edit/' . $project->id : '/group-manager/project/add'))->withInput();
            }
            \Session::flash('error', 'Something went wrong!!!');
            return redirect(url(($project->id > 0) ? '/group-manager/project/edit/' . $project->id : '/group-manager/project/add'))->withInput();
        }
        $data['projectTypes'] = ProjectType::where('projectTypeStatus', '1')->get();
        $data['groups'] = Group::where('groupStatus', '1')->whereIn('groups.id', \Session::get('myGroups'))->get();

        //get groups 
        // $groupObj= new GroupUser();
        //$data['groups']= $groupObj->getGroupByRoleId();
        //get analyst
        $userObj = new User();
        $data['analysts'] = $userObj->getAnalyst();

        return view('groupManager/project/add')->with($data);
    }

    /**
     * copy project based on project id
     * @param Project $project
     * @return type
     */
    function copy(Request $request, Project $project) {
        $data = [];
        if ($project->id > 0) {
            $data['projectDetail'] = $project;
        }

        if ($request->method() == 'POST') {
            $rules = [
                'projectTypeId' => 'required',
                'groupId' => 'required',
                'projectOwner' => 'required',
                'projectTitle' => 'required',
                'projectSessionCount' => 'required',
                'projectDescription' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $projectObj = new Project();
                $projectTitleValidate = '';
                if ($project->id > 0) {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle, $project->id);
                } else {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle);
                }
                if ($projectTitleValidate == false) {
                    return response()->json(['code' => '0', 'message' => 'Project name already exist!!!']);
                }
                //add the project
                $response = $projectObj->add($request);
                if ($response > 0) {
                    Project::where('id', $project->id)->update(['projectIsCopied' => '1']);
                    $sessionObj = new ProjectSession();
                    $sessionObj->copySessionData($project->projectSession, $response);
                    $dictionaryObj = new \App\Dictionary();
                    $dictionaryObj->copyDictionariesByProjectId($project->id, $response);
                    $productObj = new \App\Product();
                    $productObj->copyByProjectId($project->id, $response);
                    $hypothesesObj = new \App\Hypotheses();
                    $hypothesesObj->copyByProjectId($project->id, $response);
                    return response()->json(['code' => '1', 'message' => 'Project is copied successfully!!!']);
                }
            }
        }
        $data['projectTypes'] = ProjectType::where('projectTypeStatus', '1')->get();
        $data['groups'] = \App\Group::where('groupStatus', '1')->get();

        //get analyst
        $userObj = new User();
        $data['analysts'] = $userObj->getAnalyst();
        return view('groupManager/project/copy')->with($data);
    }

    /**
     * project datatable
     * @param Request $request
     */
    function templateDatatable(Request $request) {
        $projectTemplateObj = new ProjectTemplate();
        $data = $projectTemplateObj->datatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * project listing
     * @return type
     */
    function templates() {
        return view('groupManager/project/templates');
    }

    /**
     * create project template
     * @param Request $request
     * @return type
     */
    function createTemplate(Request $request, ProjectTemplate $projectTemplate, Project $project, $type = '') {
        $data = [];
        if ($projectTemplate->id > 0) {
            $data['projectTemplateDetail'] = $projectTemplate;
        }

        if ($request->method() == 'POST') {
            $rules = [
                'projectTypeId' => 'required',
                'groupId' => 'required',
                'projectOwner' => 'required',
                'projectTitle' => 'required',
                'projectSessionCount' => 'required',
                'projectDescription' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $projectTemplateObj = new ProjectTemplate();
                $projectObj = new Project();
                $projectTitleValidate = '';
                if ($project->id > 0) {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle, $project->id);
                } else {
                    $projectTitleValidate = $projectObj->validateProjectTitle($request->projectTitle);
                }
                if ($projectTitleValidate == false) {
                    return response()->json(['code' => '0', 'message' => 'Project name already in use']);
                }
                //use
                if ($projectTemplate->id > 0 && $type > 0) {
                    $response = $projectObj->add($request);
                    if ($response > 0) {
                        return response()->json(['code' => '1', 'message' => 'Success']);
                    }
                }
                //Edit Template
                if ($type == '') {
                    if ($projectTemplate->id > 0) {
                        $response = $projectTemplateObj->editbyId($projectTemplate->id, [
                            'projectTypeId' => $request->projectTypeId,
                            'groupId' => $request->groupId,
                            'projectTitle' => $request->projectTitle,
                            'projectSlug' => str_slug($request->ptojectTitle),
                            'projectDescription' => $request->projectDescription,
                            'projectSessionCount' => $request->projectSessionCount,
                            'projectOwner' => $request->projectOwner,
                        ]);
                        if ($response > 0) {
                            return response()->json(['code' => '1', 'message' => 'Template edited successfully']);
                        }
                    } else {
                        //save the project template
                        $response = $projectTemplateObj->add($request);
                        if ($response > 0) {
                            return response()->json(['code' => '1', 'message' => 'Template created successfully']);
                        }
                    }
                }
            } else {
                $message = $validator->errors()->all();
                return response()->json(['code' => '0', 'message' => implode(",\n", $message)]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        $data['projectTypes'] = ProjectType::where('projectTypeStatus', '1')->get();
        $data['groups'] = Group::where('groupStatus', '1')->whereIn('groups.id', \Session::get('myGroups'))->get();

        //get analyst
        $userObj = new User();
        $data['analysts'] = $userObj->getAnalyst();
        return view('groupManager/project/createTemplate')->with($data);
    }

    /**
     * Delete project template
     * @param ProjectTemplate $projectTemplate
     * @return type
     */
    function deleteTemplate(ProjectTemplate $projectTemplate) {
        $projectTemplate->delete();
        return response()->json(['code' => '1', 'message' => 'Templated deleted']);
    }

    function requestDeliverables() {
        return view('groupManager/project/requestDeliverables');
    }

    function auditTrail() {
        return view('groupManager/project/auditTrail');
    }

}
