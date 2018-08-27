<?php

namespace App\Http\Middleware;

use Closure;
use App\AuthToken;
use Validator;

class ParticipantApi {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
	$rules = [
	    '_participantId' => 'required',
	    '_companyId' => 'required',
	    '_token' => 'required',
	];
	$validator = Validator::make($request->all(), $rules);
	if ($validator->fails()) {
	    return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
	}
	if ($request->_media != 'mobile') {
	    return response()->json(['code' => '-1', 'message' => 'Unautorized access']);
	}
	$authTokenObj = new AuthToken();
	$data = $authTokenObj->matchParticipantIdAndToken($request->_participantId, $request->_token);
	if (count($data) == 0) {
	    return response()->json(['code' => '-1', 'message' => 'User not found']);
	}
	return $next($request);
    }

}
