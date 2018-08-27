<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\ParticipantCompany;
use App\ListParticipant;
use App\Helpers\Packages;
use Auth;
use App\AuthToken;

class ApiController extends Controller {

    /**
     * Participant login
     * @param Request $request
     * @return type
     */
    function particiantLogin(Request $request) {

	$packageObj = new Packages;
	$token = $packageObj->generateRandomString();
	$participantObj = new Participant();
	$authTokenObj = new AuthToken();
	$data = $participantObj->getParticipantByEmailAndPasscode($request->email, $request->passCode);
	if (count($data) > 0) {
	    $participantCompanyArray = $data->participantCompany;
	    $companyId = array_column($participantCompanyArray->toArray(), 'companyId');
	    if (in_array($request->companyId, $companyId)) {
		AuthToken::where('participantId', $data->id)->delete();
		$authTokenObj->participantId = $data->id;
		$authTokenObj->userId = 0;
		$authTokenObj->_token = $token;
		$authTokenObj->created_at = date('Y-m-d h:i:s');
		$authTokenObj->save();
		if ($authTokenObj->id > 0) {
		    $data['token'] = $token;
		    $data['tokenId'] = $authTokenObj->id;
		    return response()->json(['code' => "1", 'message' => 'User login successfully', 'data' => $data]);
		}
	    }
	} else {

	    return response()->json(['code' => "0", 'message' => 'Invalid Email or Password', 'data' => array()]);
	}
	return response()->json(['code' => "0", 'message' => 'Something went Wrong', 'data' => array()]);
    }

    /**
     * get sessions
     * @param Request $request
     * @return type
     */
    function getSession(Request $request) {
	$listParticipantObj = new ListParticipant();
	$listParticipantArray = $listParticipantObj->getListByParticipantId($request->_participantId, $request->_companyId);
	return response()->json(['code' => "1", 'message' => 'Session get successfully', 'data' => $listParticipantArray]);
    }

}
