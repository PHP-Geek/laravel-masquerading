<?php

namespace App\Http\Controllers\groupManager;

use App\Http\Controllers\Controller;
use App\Lists;
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
	    return redirect(url('/group-manager/session/list'));
	}
	$data['sessionArray'] = $session;
	$data['listArray'] = Lists::leftJoin('list_participants', 'list_participants.listId', '=', 'lists.id')
			->where([
			    ['listStatus', '=', '1'],
			    ['companyId', '=', Auth::user()->companyId],
			])
			->select('lists.*', DB::raw('COUNT(list_participants.id) AS noOfUsers'))->groupBy('lists.id')->paginate(10);
	return view('groupManager.lists.sessionList')->with($data);
    }

    /**
     * create the new list
     * @param request
     * @return type
     */
    public function participants(Lists $list, ProjectSession $session) {
	$data['listArray'] = $list;
	$data['sessionArray'] = $session;
	return view('groupManager.lists.participants')->with($data);
    }



}
