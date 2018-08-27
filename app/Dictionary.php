<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model {

    public $timestamps = TRUE;

    /**
     * add dictionary data from file
     * @param type $requestArr
     * @param type $projectId
     * @return boolean
     */
    public function addDictionaryFromFile($requestArr, $projectId) {
        $insertArray = [];
        foreach ($requestArr as $request) {
            $slicedData = explode(':', $request[0]);
            $insertArray[] = [
                'projectId' => $projectId,
                'word' => trim($slicedData[0]),
                'category' => trim($slicedData[1]),
                'status' => '1'
            ];
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
    function copyDictionariesByProjectId($projectId, $newProjectId) {
        $dictionaryArray = $this->where('projectId', $projectId)->get();
        foreach ($dictionaryArray as $dictionary) {
            $copyTask = $dictionary->replicate();
            $copyTask->projectId = $newProjectId;
            $copyTask->save();
        }
        return TRUE;
    }

}
