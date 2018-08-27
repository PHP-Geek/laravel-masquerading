<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Asset;
use DB;
use App\Http\Controllers\CommonController;
use App\Helpers\FileUpload;

class Project extends Model {

    /**
     * foreign key to sessoins table with project Id
     * @return type
     */
    function projectSession() {
        return $this->hasMany(ProjectSession::class, 'projectId');
    }

    /**
     * foreign key for user with project owner
     * @return type
     */
    function owner() {
        return $this->belongsTo(User::class, 'projectOwner');
    }

    /**
     * get the foreign key for asset framing guides
     * @return type
     */
    function assetFramingGuide() {
        return $this->hasMany(Asset::class, 'projectId')->where('assetType', '1');
    }

    /**
     * get the foreign key for asset framing guides
     * @return type
     */
    function assetDictionary() {
        return $this->hasMany(Asset::class, 'projectId')->where('assetType', '2');
    }

    /**
     * add the project data
     * @param type $request
     */
    function add($request) {
        try {
            $dictionaryArray = [];
            $projectGuideArray = [];
            $productArray = [];
            $commonControllerObj = new CommonController();
            $fileUploadObj = new FileUpload();
            $dictionaryPath = "";
            $projectGuidePath = "";
            $productPath = "";

            //validate the dictionary file
            if ($request->file('dictionary') != null) {
                $timeStamp = time();
                $dictionaryFile = $request->file('dictionary');
                $dictionaryDirectory = public_path('uploads/assets/' . Auth::user()->companyId . '/dictionaries/' . $timeStamp);
                $dictionaryUploadResult = $fileUploadObj->uploadFile($dictionaryFile, $dictionaryDirectory, array('txt'));
                if ($dictionaryUploadResult == '1') {
                    $lines = file($dictionaryDirectory . '/' . $dictionaryFile->getClientOriginalName());
                    $dictionaryPath = $timeStamp . '/' . $dictionaryFile->getClientOriginalName();
                    $dictionaryArray = array_map(function($array) {
                        return array_map('trim', $array);
                    }, array_chunk($lines, 1));
                } else {
                    return 'Error uploading the dictionary file';
                }
            }
            //validate the project guide file
            if ($request->file('projectGuideFile') != null) {
                $timeStamp1 = time();
                $projectGuideFile = $request->file('projectGuideFile');
                $projectGuideDirectory = public_path('uploads/assets' . '/' . Auth::user()->companyId . '/projectGuide/' . $timeStamp1);
                $projectGuideUploadResult = $fileUploadObj->uploadFile($projectGuideFile, $projectGuideDirectory, array('xls', 'xlsx', 'xlsxx'));
//                dd($projectGuideFile);
                if ($projectGuideUploadResult == '1') {
                    $importResult = $commonControllerObj->importExcelSheets($projectGuideDirectory . '/' . $projectGuideFile->getClientOriginalName());
                    $projectGuidePath = $timeStamp1 . '/' . $projectGuideFile->getClientOriginalName();
                    if (count($importResult) > 0) {
                        $projectGuideArray = $importResult;
                    } else {
                        return 'Error uploading the project guide file';
                    }
                } else {
                    return 'Error uploading the project guide file';
                }
            }
            //validate the product file
            if ($request->file('productFile') != null) {
                $productTimestamp = time();
                $productFile = $request->file('productFile');
                $productDirectory = public_path('uploads/assets' . '/' . Auth::user()->companyId . '/products/' . $productTimestamp);
                $productUploadResult = $fileUploadObj->uploadFile($request->file('productFile'), $productDirectory, ['csv']);
                if ($productUploadResult == '1') {
                    //import the csv file
                    $productArray = $commonControllerObj->importCSV($productDirectory . '/' . $productFile->getClientOriginalName());
                    $productPath = $productTimestamp . '/' . $productFile->getClientOriginalName();
                } else {
                    return 'Error in uploading product file';
                }
            }
//add the data to table in project table
            $this->companyId = Auth::user()->companyId;
            $this->projectTypeId = $request->projectTypeId;
            $this->groupId = $request->groupId;
            $this->projectTitle = $request->projectTitle;
            $this->projectSlug = str_slug($request->projectTitle);
            $this->projectCreatedBy = Auth::user()->id;
            $this->projectDescription = $request->projectDescription;
            $this->projectSessionCount = $request->projectSessionCount;
            $this->projectOwner = $request->projectOwner;
            $this->dictionaryPath = $dictionaryPath;
            $this->projectGuidePath = $projectGuidePath;
            $this->productPath = $productPath;
            $this->projectClient = '';
            $this->save();
            $projectId = $this->id;
            if ($projectId > 0) {
                $this->uploadProjectAssets($dictionaryArray, $projectGuideArray, $projectId, $productArray);
                return $projectId;
            }
            return '0';
        } catch (Exception $e) {
            return 'Something went wrong';
        }
    }

    /**
     * uplaod the project assets
     * @param type $dictionaryArray
     * @param type $projectGuideArray
     * @return boolean
     */
    function uploadProjectAssets($dictionaryArray = [], $projectGuideArray = [], $projectId = 0, $productArray = []) {
        if (count($dictionaryArray) > 0) {
            //add the dictionary file data into database
            $dictionaryObj = new Dictionary();
            $dictionaryObj->addDictionaryFromFile($dictionaryArray, $projectId);
        }
        //add the project guide into database
        if (count($projectGuideArray) > 0) {
            $productObj = new Product();
            $productObj->uploadData($projectGuideArray[0], $projectId);
            $hypothesesObj = new Hypotheses();
            $hypothesesObj->uploadData($projectGuideArray[1], $projectId);
        }
        //add the product data into database
        if (count($productArray) > 0) {
            $productObj = new Product();
            $productObj->uploadData($productArray, $projectId);
        }
        return TRUE;
    }

    /**
     * update the project by id
     * @param type $id
     * @param type $requestArr
     * @return type
     */
    function editbyId($id, $requestArr) {
        if ($this->where('id', $id)->update($requestArr) == 1) {
            return $id;
        }
        return 0;
    }

    /**
     * upload the assets
     * @param type $fileName
     * @param type $companyId
     * @return string
     */
    function uploadAssets($fileName, $companyId, $dir) {
        $timeStamp = time();
        $image_directory = public_path('uploads/assets/' . $companyId . '/' . $dir . '/' . $timeStamp);
        if (!is_dir($image_directory)) {
            mkdir($image_directory, 0777, TRUE);
        }
        if ($fileName->move($image_directory, $fileName->getClientOriginalName())) {
            return ['code' => '1', 'data' => [$timeStamp, $fileName->getClientOriginalName()]];
        }
        return ['code' => '0', 'data' => 'Error'];
    }

    /**
     * project datatable
     * @param type $request
     */
    function projectDatatable($request) {
        $data = $this->leftJoin('project_types', 'projects.projectTypeId', '=', 'project_types.id')
                ->leftJoin('groups', 'groups.id', '=', 'projects.groupId')
                ->leftJoin('users AS owners', 'owners.id', '=', 'projects.projectOwner')
                ->leftJoin('users', 'users.id', '=', 'projects.projectCreatedBy')
                ->where([
            ['projects.projectStatus', '!=', '-1'],
            ['projects.companyId', '=', Auth::user()->companyId]
        ]);
        $data = $data->select('projects.*', 'users.firstName', 'users.lastName', 'owners.firstName AS ownerFirstName', 'owners.lastName AS ownerLastName', 'groups.groupName', 'project_types.projectTypeName', 'projectIsCopied', DB::raw('DATE_FORMAT(projects.created_at,"%m/%d/%Y %h:%i %p") as projectCreatedOn'));

        //filter by group name
        if ($request->groupId != null && $request->groupId != '') {

            $data->where('projects.groupId', '=', $request->groupId);
        }

//filter by project type
        if (isset($request->projectTypeId) && $request->projectTypeId != '') {
            $data = $data->where('projects.projectTypeId', $request->projectTypeId);
        }


//filtration for keyword
        if (isset($request->keyword) && $request->keyword != '') {
            $data = $data->where(function($query) use ($request) {
                $query->orWhere('projects.projectTitle', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('project_types.projectTypeName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('groups.groupName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('projects.projectSessionCount', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('owners.firstName', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $data = $data->whereIn('groups.id', \Session::get('myGroups'));
        }
        //analyst project get
        if (Auth::check() && in_array('analyst', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $data = $data->where('projects.projectOwner', Auth::user()->id);
        }

        $datacount = $data->count();
//        $dataArray = $data->select('projects.*', 'users.firstName', 'users.lastName', 'owners.firstName AS ownerFirstName', 'owners.lastName AS ownerLastName', 'groups.groupName', 'project_types.projectTypeName', DB::raw('DATE_FORMAT(projects.created_at,"%m/%d/%Y %h:%i %p") as projectCreatedOn'));
        if ($request->length == -1) {
            $dataArray = $data->get();
        } else {
            $dataArray = $data->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }

    /**
     * validate the project title for the company that project title must be unique for the company
     * @param type $projectTitle
     * @param type $id
     * @return boolean
     */
    function validateProjectTitle($projectTitle, $id = 0) {
        switch ($id) {
            case 0:
                $data = $this
                        ->where([
                            ['projectTitle', '=', $projectTitle],
                            ['companyId', '=', Auth::user()->companyId]
                        ])
                        ->count();
                break;
            default:
                $data = $this
                        ->where([
                            ['projectTitle', '=', $projectTitle],
                            ['companyId', '=', Auth::user()->companyId],
                            ['projects.id', '!=', $id],
                        ])
                        ->count();
                break;
        }
        if ($data == 0) {
            return true;
        }
        return false;
    }

    /**
     * validate the project for current company
     * @param type $projectId
     */
    function validateCompanyProject($projectId) {
        if ($this->where('companyId', Auth::user()->companyId)->where('id', $projectId)->count() == 0) {
            return FALSE;
        }
        return TRUE;
    }

    /*     * add quick project
     * 
     * @param type $request
     * @param type $companyId
     */

    function addQuickProject($request, $companyId, $groupId, $userId) {

        $this->companyId = $companyId;
        $this->groupId = $groupId;
        $this->projectTypeId = $request->projectTypeId != null ? $request->projectTypeId : 0;

        $this->projectTitle = $request->projectTitle != null ? $request->projectTitle : 'Unassigned';
        $this->projectSlug = str_slug($request->projectTitle != null ? $request->projectTitle : 'Unassigned');
        $this->projectCreatedBy = 0;
        $this->projectDescription = $request->projectDescription != null ? $request->projectDescription : 'null';
        $this->projectSessionCount = 10;
        $this->projectOwner = $userId; 

        $this->projectClient = '';
        $this->isDefault = '1';
        $this->save();
        return $this->id;
    }

}
