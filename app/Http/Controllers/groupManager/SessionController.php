<?php

namespace App\Http\Controllers\groupManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectSession;
use App\Project;
use App\Lists;
use App\User;
use Auth;
use Validator;
use App\Template;

class SessionController extends Controller {

    /**
     * session datatable
     */
    function datatable(Request $request) {
        $sessionObj = new ProjectSession();
        $data = $sessionObj->sessionDatatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * listing of the session under group manager
     * @return type
     */
    function index() {
        $data = [];
        return view('groupManager/session/index')->with($data);
    }

    /**
     * create the session for customer groupManager
     * @param Request $request
     * @param ProjectSession $session
     * @return type
     */
    function create(Request $request, ProjectSession $session, $type = 0) {
        $data['type'] = $type;
        if (!in_array($type, [0, 1])) {
            return redirect('/group-manager/session/list');
        }

        /**
         * check valid time
         */
        if ($type == 0) {
            if (count($session) > 0 && $session->id > 0) {
                if (strtotime(date('Y-m-d H:i:s', strtotime($session->sessionDate . ' ' . $session->sessionStart))) < time())
                    return redirect('/group-manager/session/list');
            }
        }

        if (count($session) > 0) {
            $data['sessionDetail'] = $session;
        }
        if ($request->method() == 'POST') {
            $rules = [
                'projectId' => 'required',
                'sessionSpeakerCount' => 'required',
                'sessionLength' => 'required',
                'sessionDate' => 'required',
                'sessionStart' => 'required',
                'sessionLocation' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                //get the project data and check for sessions
                $projectDetail = Project::find($request->projectId);
                $projectSessionCount = ProjectSession::where('projectId', $request->projectId)->count();
                if (count($projectDetail) > 0) {
                    //check the number of speakers under the project/session
                    //save session data
                    $projectSessionObj = new ProjectSession();
                    if (count($session) > 0 && $session->id > 0 && $type == 0) {

                        $sessionResult = $projectSessionObj->editById($session->id, $request);
                    } else {
                        //check number of sessions under the project
                        if ($projectDetail->projectSessionCount <= $projectSessionCount) {
                            return response()->json(['code' => '0', 'message' => 'Session limit exceeded for the project!!!']);
                        }
                        //check for session name
                        if ($projectSessionObj->validateSessionNameForProject($request->sessionName, $request->projectId) == FALSE) {
                            return response()->json(['code' => '0', 'message' => 'Session already exist for the project!!!']);
                        }
                        $sessionResult = $projectSessionObj->add($request);
                    }
                    if ($sessionResult[0] == 1) {
                        if ($sessionResult[1] > 0) {
                            if ($type == '1') {
                                $traitObj = new \App\Traits();
                                $traitObj->copyTraitsBySessionId($sessionResult[1], $sessionResult);
                            }
                            return response()->json(['code' => '1', 'message' => 'Success']);
                        }
                    } else {
                        return response()->json(['code' => '0', 'message' => $sessionResult[1]]);
                    }
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        $data['lists'] = Lists::where('companyId', Auth::user()->companyId)->where('listStatus', '1')->get();
        $data['projects'] = Project::where('companyId', Auth::user()->companyId)->where('projectStatus', '1')->whereIn('projects.groupId', \Session::get('myGroups'))->select('projects.*')->get();
        $data['templates'] = Template::where('companyId', Auth::user()->companyId)->where('templateStatus', '1')->get();
        $data['reportNeededArray'] = ['Quick', 'Transcript', 'Graphics'];
        return view('groupManager.session.create')->with($data);
    }

    function defineDevices() {
        return view('groupManager/session/defineDevices');
    }

    function createQuickSession() {
        return view('groupManager/session/createQuickSession');
    }

    function recordingMonitor() {

        return view('groupManager/session/recordingMonitor');
    }

    function setParameterDevice() {
        return view('groupManager/session/setParameterDevice');
    }

}
