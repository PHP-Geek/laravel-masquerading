<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Validate;

class Traits extends Model {

    protected $table = 'traits';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;

    /**
     * add trait data for sessions
     * @param type $requestArr
     */
    function addTraitForSessionParticipants($request) {
        $error = '';
        $traitInsertArray = [];
        $colNames = $request->col_names;
        $validateObj = new Validate();
        foreach ($colNames as $colName) {
            $templateFieldArray = TemplateField::find($colName);
            if (count($templateFieldArray) > 0) {
                if (count($request->listUserId) > 0) {
                    foreach ($request->listUserId as $key => $listUser) {
                        $colIdName = $colName . '_' . $listUser;
                        $validateResult = $validateObj->validateTemplateFieldValue($templateFieldArray->templateValidation, $request->$colIdName, $templateFieldArray->templateFieldLabel, $key);
                        if ($validateResult == '1') {
                            $traitInsertArray[] = [
                                'templateId' => $request->templateId,
                                'templateField' => $colName,
                                'traitValue' => $request->$colIdName,
                                'sessionId' => $request->sessionId,
                                'listParticipantId' => $listUser,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $error .= $validateResult . '\n';
                        }
                    }
                }
            }
        }
        if ($error != '') {
            return $error;
        } else {
            if (count($traitInsertArray) > 0) {
                $this->insert($traitInsertArray);
                return '1';
            }
        }
        return '0';
    }

    /**
     * add the session participants
     * @param type $requestArr
     * @return type
     */
    function add($requestArr) {
        //save the trait
        $this->templateId = $requestArr->templateId;
        $this->templateField = $requestArr->templateField;
        $this->traitValue = $requestArr->traitValue;
        $this->sessionId = $requestArr->sessionId;
        $this->sessionParticipantId = $requestArr->sessionParticipantId;
        $this->status = '1';
        $this->save();
        return $this->id;
    }

    /**
     * copy traits
     * @param type $sessionId
     * @param type $newSessionId
     * @return boolean
     */
    function copyTraitsBySessionId($sessionId, $newSessionId) {
        $traitsArray = $this->where('sessionId', $sessionId)->get();
        foreach ($traitsArray as $trait) {
            $copyTask = $trait->replicate();
            $copyTask->sessionId = $newSessionId;
            $copyTask->save();
        }
        return TRUE;
    }

}
