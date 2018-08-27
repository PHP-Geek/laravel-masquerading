<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Participant extends Model {

    /**
     * add the participant
     * @param type $request
     * @return type
     */
    function addParticipant($request) {

	$this->firstName = $request->firstName;
	$this->lastName = isset($request->lastName) ? $request->lastName : '';
	$this->email = $request->email;
	$this->phone = $request->phone;
	$this->contactMessage = $request->contactMessage;
	$this->participantStatus = 1;
	$this->passCode = isset($requet->passCode) ? $request->passCode : mt_rand(0000, 9999);
	$this->save();
	return $this->id;
    }

    /**
     * search participants by keyword and current company
     * @param type $keyword
     * @return type
     */
    function searchParticipants($keyword) {
	return $this->join('participant_companies', 'participant_companies.participantId', '=', 'participants.id')->where(function($query) use ($keyword) {
			    $query->orWhere('firstName', 'like', '%' . $keyword . '%');
			    $query->orWhere('lastName', 'like', '%' . $keyword . '%');
			    $query->orWhere('email', 'like', '%' . $keyword . '%');
			})
			->where('participantStatus', '=', '1')
			->where('participant_companies.companyId', Auth::user()->companyId)
			->select('participants.*')
			->get();
    }

    function participantCompany() {
	return $this->hasMany(ParticipantCompany::class, 'participantId');
    }

    /**
     * get participant data as per the email and passcode
     * @param type $email
     * @param type $passCode
     * @return type
     */
    function getParticipantByEmailAndPasscode($email, $passCode) {
	return $this->where('email', $email)
			->where('passCode', $passCode)->first();
    }
    
    function addData($requestArr){
	return $this->insertGetId($requestArr);
    }

}
