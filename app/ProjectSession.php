<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Calculation;
use Auth;
use App\Helpers\Validate;
use DB;

class ProjectSession extends Model {

    protected $table = 'sessions';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;

    /**
     * foreign key for session participants
     */
    public function sessionParticipants() {
	return $this->hasMany(SessionParticipant::class, 'sessionId')->leftJoin('users', 'users.id', '=', 'session_participants.participantId')->select('session_participants.*', 'users.firstName', 'users.lastName', 'users.email');
    }

    /**
     * foreign key for the projects and session
     */
    public function project() {
	return $this->belongsTo(Project::class, 'projectId');
    }

    function lists() {
	return $this->belongsTo(Lists::class, 'sessionListId');
    }

    /**
     * project type datatable
     * @param type $request
     * @return type
     */
    function sessionDatatable($request) {
	$data = $this->leftJoin('projects', 'projects.id', '=', 'sessions.projectId')
		->leftJoin('lists', 'lists.id', '=', 'sessions.sessionListId')
		->leftJoin('users', 'users.id', '=', 'sessions.createdBy')
		->leftJoin('users AS owners', 'owners.id', '=', 'projects.projectOwner')
		->leftJoin('kit_participants','kit_participants.id','=','sessions.kitParticipantId')
		->where([['sessions.sessionStatus', '!=', '-1'], ['sessions.companyId', '=', Auth::user()->companyId]]);

//filtration for keyword
	if (isset($request->keyword) && $request->keyword != '') {
	    $data = $data->where(function($query) use ($request) {
		$query->orWhere('sessions.sessionName', 'LIKE', '%' . $request->keyword . '%');
		$query->orWhere('sessions.sessionLocation', 'LIKE', '%' . $request->keyword . '%');
	    });
	}
	if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
	    $data = $data->whereIn('projects.groupId', \Session::get('myGroups'));
	}

	//filtration for project name
	if ($request->projecId != null && $request->projecId != '') {

	    $data->where('sessions.projectId', '=', $request->projecId);
	}
	if ($request->date != null && $request->date != '') {
	    $data->where('sessions.sessionDate', '=', date('Y-m-d', strtotime($request->date)));
	}

	if (Auth::check() && in_array('analyst', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
	    $data = $data->where('projects.projectOwner', Auth::user()->id);
	}
	$datacount = $data->count();
	$dataArray = $data->select('sessions.*', DB::raw('DATE_FORMAT(sessions.sessionDate,"%m/%d/%Y") as sessionDate'), DB::raw('DATE_FORMAT(sessions.created_at,"%m/%d/%Y %h:%i %p") as sessionCreatedOn'), 'projects.projectTitle', DB::raw('CONCAT(owners.firstName," ",owners.lastName) AS ownerName'), 'users.firstName', 'users.lastName', 'lists.listName','kit_participants.kitParticipantName');
	if ($request->length == -1) {
	    $dataArray = $dataArray->get();
	} else {
	    $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
	}
	return [$datacount, $dataArray];
    }

    /**
     * save the data into session table
     * @param type $requestArr
     * @return type
     */
    function add($requestArr) {
	$validateObj = new Validate();
	if ($validateObj->validateSessionDate(date('Y-m-d H:i:s', strtotime(date('Y-m-d ', strtotime($requestArr->sessionDate)) . $requestArr->sessionStart . ':00'))) == FALSE) {
	    return [0, 'Session date and time must be after next 30 minutes from now.'];
	}
	$maxSessionNo = $this->max('sessionNo');
	$calculatObj = new Calculation();
	$this->projectId = $requestArr->projectId;
	$this->createdBy = Auth::user()->id;
	$this->companyId = Auth::user()->companyId;
	$this->sessionNo = ($maxSessionNo > 0) ? $maxSessionNo + 1 : 1000;
	$this->sessionName = $requestArr->sessionName;
	$this->sessionSlug = str_slug($requestArr->sessionName);
	$this->sessionSpeakerCount = $requestArr->sessionSpeakerCount;
	$this->sessionLength = date('H:i:00', strtotime($requestArr->sessionLength));
	$this->sessionDate = date('Y-m-d', strtotime($requestArr->sessionDate));
	$this->sessionStart = date('H:i:00', strtotime($requestArr->sessionStart));
	$this->sessionEnd = $calculatObj->addTimes($requestArr->sessionStart, $requestArr->sessionLength);
	$this->sessionListId = $requestArr->sessionListId != null ? $requestArr->sessionListId : 0;
	$this->sessionLocation = $requestArr->sessionLocation;
	$this->reportNeeded = $requestArr->sessionReportNeeded != null ? $requestArr->sessionReportNeeded : '';
	$this->templateId = $requestArr->templateId != null ? $requestArr->templateId : 0;
	$this->sessionStatus = '1';
	$this->save();
	$sessionId = $this->save();
	if ($sessionId > 0) {
	    return ['1', $sessionId];
	}
	return ['0', 'Something went wrong'];
    }

    /**
     * update the session detail by id
     * @param type $id
     * @param type $requestArr
     */
    function editById($id, $requestArr) {
	$validateObj = new Validate();
	if ($validateObj->validateSessionDate(date('Y-m-d H:i:s', strtotime(date('Y-m-d ', strtotime($requestArr->sessionDate)) . $requestArr->sessionStart . ':00'))) == FALSE) {
	    return [0, 'Session date and time must be after next 30 minutes from now.'];
	}
	$calculatObj = new Calculation();
	if ($this->where('id', $id)->update([
		    'projectId' => $requestArr->projectId,
		    'sessionName' => $requestArr->sessionName,
		    'sessionSlug' => str_slug($requestArr->sessionName),
		    'sessionSpeakerCount' => $requestArr->sessionSpeakerCount,
		    'sessionLength' => date('H:i:00', strtotime($requestArr->sessionLength)),
		    'sessionDate' => date('Y-m-d', strtotime($requestArr->sessionDate)),
		    'sessionStart' => date('H:i:00', strtotime($requestArr->sessionStart)),
		    'sessionEnd' => $calculatObj->addTimes($requestArr->sessionStart, $requestArr->sessionLength),
		    'sessionListId' => $requestArr->sessionListId != null ? $requestArr->sessionListId : '0',
		    'sessionLocation' => $requestArr->sessionLocation,
		    'templateId' => $requestArr->templateId != null ? $requestArr->templateId : '0',
		    'reportNeeded' => $requestArr->sessionReportNeeded
		]) > 0) {
	    return ['1', $id];
	}
	return ['0', 'Something went wrong'];
    }

    /**
     * validate current company session
     * @param \App\Request $request
     */
    function validateCompanySession($sessionId) {
	if ($this->where('id', $sessionId)->where('companyId', Auth::user()->id)->count() > 0) {
	    return FALSE;
	}
	return TRUE;
    }

    /**
     * 
     * @param type $sessionName
     * @param type $projectId
     * @return boolean
     */
    function validateSessionNameForProject($sessionName, $projectId) {
	if ($this->where([
		    ['sessionName', '=', $sessionName],
		    ['projectId', '=', $projectId],
		    ['companyId', '=', Auth::user()->companyId]
		])->count() > 0) {
	    return FALSE;
	}
	return TRUE;
    }

    /**
     * validate the session comes under the company project or not
     * @param type $sessionId
     * @param type $projectId
     * @return boolean
     */
    function validateProjectSession($sessionId, $projectId) {
	if ($this->where([
		    ['id', '=', $sessionId],
		    ['projectId', '=', $projectId],
		    ['companyId', '=', Auth::user()->companyId]
		])->count() > 0) {
	    return TRUE;
	}
	return FALSE;
    }

    /**
     * edit the session data
     */
    function edit($id, $updateArray) {
	return $this->where('id', $id)->update($updateArray);
    }

    /**
     * copy session data into another project
     * @param type $sessionArray
     * @param type $projectid
     * @return string
     */
    function copySessionData($sessionArray, $projectid) {
	$traitObj = new Traits();
	foreach ($sessionArray as $session) {
	    $maxSessionNo = $this->max('sessionNo');
	    $insertArray = [
		'projectId' => $projectid,
		'sessionName' => $session->sessionName . ' Copy',
		'companyId' => $session->companyId,
		'sessionSlug' => str_slug($session->sessionName . ' Copy'),
		'sessionSpeakerCount' => $session->sessionSpeakerCount,
		'sessionLength' => $session->sessionLength,
		'sessionDate' => $session->sessionDate,
		'sessionStart' => $session->sessionStart,
		'sessionEnd' => $session->sessionEnd,
		'sessionListId' => $session->sessionListId,
		'sessionLocation' => $session->sessionLocation,
		'templateId' => $session->templateId,
		'reportNeeded' => $session->sessionReportNeeded,
		'sessionStatus' => $session->sessionStatus,
		'createdBy' => Auth::user()->id,
		'sessionNo' => $maxSessionNo + 1
	    ];
	    $projectSessionId = $this->insertGetId($insertArray);
	    $traitObj->copyTraitsBySessionId($session->id, $projectSessionId);
	}

	return TRUE;

//        if ($this->addGroup($insertArray) > 0) {
//            return TRUE;
//        }
//        return FALSE;
    }

    /**
     * insert data in bulk
     * @param type $insetArray
     * @return type
     */
    function addGroup($insetArray) {
	return $this->insert($insetArray);
    }

}
