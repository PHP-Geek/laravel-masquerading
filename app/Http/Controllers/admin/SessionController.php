<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectSession;
use App\Project;
use App\Lists;
use App\KitParticipant;
use App\User;
use App\Template;
use Auth;
use Validator;

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
     * screen to show the session lists
     */
    function index() {
        $data = [];
        return view('admin.session.index')->with($data);
    }

    /**
     * create the session for customer admin
     * @param Request $request
     * @param ProjectSession $session
     * @return type
     */
    function create(Request $request, ProjectSession $session, $type = 0) {
        $data['type'] = $type;
        if (!in_array($type, [0, 1])) {
            return redirect('/admin/session/list');
        }
        /**
         * check valid time
         */
        if (strtotime(date('Y-m-d H:i:s', strtotime($session->sessionDate . ' ' . $session->sessionStart))) < time())
            return redirect('/group-manager/session/list');
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
        $data['projects'] = Project::where('companyId', Auth::user()->companyId)->where('projectStatus', '1')->get();
        $data['templates'] = Template::where('companyId', Auth::user()->companyId)->where('templateStatus', '1')->get();

        $data['reportNeededArray'] = ['Quick', 'Transcript', 'Graphics'];
        return view('admin/session/create')->with($data);
    }

    /**
     * participants list for the session
     * @param Request $request
     * @param ProjectSession $session
     */
    function participants(Request $request, ProjectSession $session) {
        $data['sessionDetail'] = $session; //session data with all relations
        return view('admin/session/participants')->with($data);
    }

    /**
     * Create Quick Session
     * @param Request $request
     * @return type
     */
    function createQuickSession(Request $request) {

        if ($request->method() == 'POST') {
            $rules = [
                'sessionName' => 'required',
                'sessionStart' => 'required',
                'sessionEnd' => 'required',
                'sessionDate' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $projectDetail = Project::where('companyId', Auth::user()->companyId)->where('isDefault', '1')->first();
                //validate the time
                if ((strtotime(date('Y-m-d H:i:s', strtotime(date('Y-m-d ', strtotime($request->sessionDate)) . $request->sessionStart . ':00')))) < strtotime('+2 minutes')) {
                    return response()->json(['code' => '0', 'message' => 'Session time must be after 2 minutes from now!!!']);
                }
                if (count($projectDetail) > 0) {
                    $sessionDetailObj = new \App\ProjectSession();
                    //check for session name
                    if ($sessionDetailObj->validateSessionNameForProject($request->sessionName, $projectDetail->id) == FALSE) {
                        return response()->json(['code' => '0', 'message' => 'Session already exist for the project!!!']);
                    }
                    $sessionDetailObj->sessionName = $request->input('sessionName');
                    $sessionDetailObj->sessionDate = date('Y-m-d', strtotime($request->sessionDate));
                    $sessionDetailObj->sessionStart = date('H:i:00', strtotime($request->sessionStart));
                    $sessionDetailObj->sessionLength = date('H:i:00', strtotime($request->sessionEnd));
                    $calculatObj = new \App\Helpers\Calculation();
                    $sessionDetailObj->sessionEnd = $calculatObj->addTimes($request->sessionStart, $request->sessionEnd);
                    $sessionDetailObj->projectId = $projectDetail->id; 
                    $sessionDetailObj->sessionListId = $request->input('sessionListId') != null ? $request->sessionListId : 0;
                    $sessionDetailObj->kitParticipantId  = $request->input('sessionKitId') != null ? $request->sessionKitId : 0 ;
                    $sessionDetailObj->companyId = Auth::user()->companyId;
                    $sessionDetailObj->isQuickSession = 1;
                    $sessionDetailObj->sessionStatus = 1;
                    $sessionDetailObj->createdBy = Auth::user()->id;
                    $sessionDetailObj->created_at = date('Y-m-d H:i:s');
                    $sessionDetailObj->save();
                    return response()->json(['code' => '1', 'message' => 'Session create successfully']);
                }
                return response()->json(['code' => '0', 'message' => 'Something went wrong']);
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
            }
            return response()->json(['code' => '0', 'message' => 'Something went wrong']);
        }
        $data['lists'] = Lists::where('companyId', Auth::user()->companyId)->where('listStatus', '1')->get();
        $data['kitParticipants'] = KitParticipant::where('companyId', Auth::user()->companyId)->where('kitParticipantStatus', '1')->get();
        return view('admin/session/createQuickSession')->with($data);
    }

    function recordingMonitor() {

        return view('admin/session/recordingMonitor');
    }
}
