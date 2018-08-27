<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Hypotheses extends Model {

    /**
     * upload the hypothses data to desired table
     * @param type $hypothsesData
     */
    function uploadData($hypothsesData = [], $projectId = 0) {
        $insertArray = [];
        if (count($hypothsesData) > 0) {
            foreach ($hypothsesData as $row) {
                $_Values = array_values($row);
                $insertArray[] = [
                    'projectId' => $projectId,
                    'companyId' => Auth::user()->id,
                    'kids' => $_Values[0],
                    'hypotheses' => $_Values[1],
                    'hypothsesDNH' => $_Values[2],
                    'comment' => $_Values[3],
                    'hypothsesStatus' => '1'
                ];
            }
        }
        if ($this->insert($insertArray) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * copy dictionary data by any project id
     * @param type $projectId
     */
    function copyByProjectId($projectId, $newProjectId) {
        $hypothsesArray = $this->where('projectId', $projectId)->get();
        foreach ($hypothsesArray as $hypotheses) {
            $copyTask = $hypotheses->replicate();
            $copyTask->projectId = $newProjectId;
            $copyTask->save();
        }
        return TRUE;
    }

}
