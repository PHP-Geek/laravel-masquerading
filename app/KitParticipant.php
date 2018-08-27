<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class KitParticipant extends Model {
    
    protected $table = 'kit_participants';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * relation with list_users table
     */
    public function kitParticipantParticipant(){
        return $this->hasMany(KitParticipantParticipant::class,'kitParticipantId');
    }
    
    /**
     * validate the kit participant name for unique name for the company
     * @param type $kitParticipantName
     * @return boolean
     */
    function validateKitParticipantName($kitParticipantName) {
        if ($this->where('kitParticipantName', $kitParticipantName)->where('companyId', Auth::user()->companyId)->count() > 0) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * add the kit participant
     * @param type $requestArr
     * @return type
     */
    function addKitParticipant($requestArr) {
        $this->companyId = Auth::user()->companyId;
        $this->kitParticipantName = $requestArr->kitParticipantName;
        $this->kitParticipantSlug = str_slug($requestArr->kitParticipantName);
        $this->kitParticipantPrefix = $requestArr->kitParticipantPrefix;
        $this->noOfDevices = $requestArr->noOfDevices;
        $this->speakerGap = $requestArr->speakerGap;
        $this->microphone = $requestArr->microphone;
        $this->onset = $requestArr->onset;
        $this->decay = $requestArr->decay;
        $this->kitParticipantStatus = '1';
        $this->save();
        return $this->id;
    }

    /**
     * kit participant datatable to show the kit participants
     * @param type $request
     * @return type
     */
    function getKitParticipantDatatable($request) {
        $data = $this
                ->where([
            ['companyId', '=', Auth::user()->companyId],
            ['kitParticipantStatus', '!=', '-1']
        ]);
        $datacount = $data->count();
        $dataArray = $data->orderBy('created_at')->select('kit_participants.*');
        if ($request->length == -1) {
            $dataArray = $dataArray->get();
        } else {
            $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }

}
