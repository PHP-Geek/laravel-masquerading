<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model {

    /**
     * framing guide datatables
     * @param type $request
     * @return type
     */
    function getframingGuideDatatable($request) {
        $data = $this->where([
            ['assets.status', '!=', '-1']
        ]);

        $datacount = $data->count();
        $dataArray = $data->select('assets.*', DB::raw('DATE_FORMAT(created_at, "%m-%d-%Y %h:%i %p") as dateTime'));
        if ($request->length == -1) {
            $dataArray = $dataArray->get();
        } else {
            $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }

    /**
     * Update framing guide
     * @param type $id
     * @param type $editFramingGuideArray
     * @return type
     */
    function updateframingGuideData($id, $editFramingGuideArray) {
        return $this->where('id', $id)->update($editFramingGuideArray);
    }

    /**
     * add the assets
     * @param type $request
     * @param type $projectId
     * @return type
     */
    function add($request, $projectId) {
        $this->projectId = $projectId;
        $this->companyId = Auth::user()->companyId;
        $this->fileName = $request['fileName'];
        $this->fileOriginalName = $request['fileOriginalName'];
        $this->createdBy = Auth::user()->id;
        $this->assetType = $request['assetType'];
        $this->status = '1';
        $this->save();
        return $this->id;
    }

}
