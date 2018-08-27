<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model {

    function matchParticipantIdAndToken($participantId, $token) {
	return $this->where('participantId', $participantId)
			->where('_token', $token)->first();
    }

}
