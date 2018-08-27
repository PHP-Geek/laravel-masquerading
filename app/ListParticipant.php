<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ListParticipant extends Model {

    /**
     * foriegn key to users
     */
    function participant() {
	return $this->belongsTo(Participant::class, 'participantId');
    }

    /**
     * add users on lists
     * @param $listId, $userId
     * @return $type
     */
    function add($listId, $participantId) {
	$this->listId = $listId;
	$this->participantId = $participantId;
	$this->listUserStatus = '1';
	$this->save();
	return $this->id;
    }

    /**
     * validate the list id and user id for existing data or not
     */
    function validateParticipantAndList($listId, $participantId) {
	return $this->where([
		    ['listId', '=', $listId],
		    ['participantId', '=', $participantId],
		    ['listUserStatus', '!=', '-1']
		])->count();
    }

    /**
     * Get list participant data by participant id
     * @param type $participantId
     * @return type
     */
    function getListByParticipantId($participantId, $companyId) {
	return $this->join('lists', 'lists.id', '=', 'list_participants.listId')
			->join('sessions', 'sessions.sessionListId', '=', 'lists.id')
			->join('projects', 'projects.id', '=', 'sessions.projectId')
			->where('list_participants.id', $participantId)
			->where('sessions.companyId', $companyId)
			->where(DB::raw('concat(sessions.sessionDate," ",sessions.sessionStart)'),'>',date("Y-m-d H:i:00"))
			->select('sessions.*', 'projects.projectTitle')
			->get();
    }

}
