<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantCompany extends Model
{
   public function participant() {
        return $this->belongsTo(Participant::class, 'participantId');
    }
}
