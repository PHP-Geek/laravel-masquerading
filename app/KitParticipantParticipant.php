<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitParticipantParticipant extends Model
{
    
     protected $table = 'kit_participant_participants';
     
     
    /**
     * foriegn key to users
     */
    function participant() {
	return $this->belongsTo(Participant::class, 'participantId');
    }

    function addData($request) {

	$this->participantId = '';
	$this->kitParticipantId = '';
	$this->status = 1;
	$this->save();
    }
}
