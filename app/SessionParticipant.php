<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionParticipant extends Model {

    public $timestamps = TRUE;

    /**
     * insert data in bulk
     * @param type $requestArr
     * @return boolean
     */
    function add($requestArr) {
        if ($this->insert($requestArr) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * validate the session participants
     * @param type $sessionId
     * @param type $participantId
     */
    function validateSessionParticipants($sessionId, $participantId) {
        if ($this->where('participantId', $participantId)->where('sessionId', $sessionId)->count() > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
