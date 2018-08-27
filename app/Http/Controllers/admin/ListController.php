<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Lists;
use App\KitParticipant;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;
use App\ProjectSession;
use App\Http\Controllers\CommonController;
use Hash;

class ListController extends Controller {

    public function __construct() {
        
    }

    /**
     * show all lists and make select for the session
     */
    public function sessionList(ProjectSession $session) {
        if (count($session) > 0 && $session->companyId != Auth::user()->companyId) {
            return redirect(url('/admin/session/list'));
        }
        $data['sessionArray'] = $session;
        $data['listArray'] = Lists::leftJoin('list_participants', 'list_participants.listId', '=', 'lists.id')
                        ->where([
                            ['listStatus', '=', '1'],
                            ['companyId', '=', Auth::user()->companyId],
                        ])
                        ->select('lists.*', DB::raw('COUNT(list_participants.id) AS noOfUsers'))->groupBy('lists.id')->paginate(10);
        return view('admin.lists.sessionList')->with($data);
    }

    /**
     * create the new list
     * @param request
     * @return type
     */
    public function participants(Lists $list, ProjectSession $session) {
        $data['listArray'] = $list;
        $data['sessionArray'] = $session;
        return view('admin/lists.participants')->with($data);
    }

    /**
     * return the kit participant data
     * @param Request $request
     * @return type
     */
    public function kitParticipantDatatable(Request $request) {
        $kitParticipantObj = new \App\KitParticipant();
        $data = $kitParticipantObj->getKitParticipantDatatable($request);
        return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }

    /**
     * kit participant list, add
     * @param Request $request
     * @return type
     */
    public function kitParticipant(Request $request) {
        $data = [];
        return view('admin.lists.kitParticipant')->with($data);
    }

    /**
     * show all kit list  and make select for the session
     */
    public function kitList(ProjectSession $session) {
        if (count($session) > 0 && $session->companyId != Auth::user()->companyId) {
            return redirect(url('/admin/session/list'));
        }
        $data['sessionArray'] = $session;
        $data['kitListArray'] = KitParticipant::leftJoin('kit_participant_participants', 'kit_participant_participants.kitParticipantId', '=', 'kit_participants.id')
                        ->where([
                            ['kitParticipantStatus', '=', '1'],
                            ['companyId', '=', Auth::user()->companyId],
                        ])
                        ->select('kit_participants.*', DB::raw('COUNT( kit_participant_participants.id) AS noOfUsers'))->groupBy('kit_participants.id')->paginate(10);
        return view('admin.lists.kitList')->with($data);
    }

    /**
     * create the new list
     * @param request
     * @return type
     */
    public function kitListParticipants(KitParticipant $list, ProjectSession $session) {
        $data['kitListArray'] = $list;
        $data['sessionArray'] = $session;
        return view('admin/lists/kitListParticipants')->with($data);
    }

}
