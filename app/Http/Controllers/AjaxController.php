<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Group;
use Auth;
use Hash;
use App\Project;
use App\ProjectSession;
use App\ListParticipant;
use App\Lists;
use UserRole;
use App\Traits;
use App\Helpers\FileUpload;
use App\Http\Controllers\CommonController;
use App\Dictionary;
use App\Product;
use App\Hypotheses;
use Exception;
use DB;

class AjaxController extends Controller {

    /**
     * Change user Status
     * @param Request $request
     * @return type
     */
    function changeUserStatus(Request $request) {
        $rules = [
            'id' => 'required',
            'userStatus' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $superadminDetailArray = ['userStatus' => $request->userStatus];
            $userObj = new User();
            $userObj->updateUserData($request->id, $superadminDetailArray);
            return response()->json(['code' => '1', 'message' => 'Status Changed Successfully!']);
        }
        return response()->json(['code' => '0', 'message' => 'Error Changing Status!!!']);
    }

    /**
     * validate the user name for unique or email
     * @param type $request
     */
    function validateUserNameOrEmail(Request $request) {
        if ($request->get('type') == 'email') {
            $rules = [
                'email' => 'required|unique:users'
            ];
        } else {
            $rules = [
                'userName' => 'required|unique:users'
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    /**
     * validate the user name and email for update the data
     * @param Request $request
     * @return type
     */
    function validateEditUserNameOrEmail(Request $request) {
        if ($request->get('type') == 'email') {
            $rules = [
                'email' => 'required|unique:users,email,' . $request->id,
            ];
        } else {
            $rules = [
                'userName' => 'required|unique:users,userName,' . $request->id,
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    /**
     * validate company name for edit
     * @param Request $request
     * @return type
     */
    function validateEditCompanyName(Request $request) {
        $rules = [
            'companyName' => 'required|unique:companies,companyName,' . $request->id,
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    /**
     * get the user data by id
     * @param Request $request
     * @return type
     */
    function getUserById(Request $request) {
        $userObj = new User();
        return response()->json($userObj->getUserData($request->id));
    }

    /**
     * Change group status
     * @param Request $request
     * @return type
     */
    function changeGroupStatus(Request $request) {
        $rules = [
            'id' => 'required',
            'groupStatus' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $groupDetailArray = ['groupStatus' => $request->groupStatus];
            $groupObj = new Group();
            $groupObj->updateGroupData($request->id, $groupDetailArray);
            return response()->json(['code' => '1', 'message' => 'Status Changed Successfully!']);
        }
        return response()->json(['code' => '0', 'message' => 'Error Changing Status!!!']);
    }

    /**
     * Add new Brand 
     * @param Request $request
     * @return type
     */
    function addBrand(Request $request) {

        if ($request->method() == 'POST') {
            $rules = [
                'brandName' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $brand = new \App\Brand();
                $brand->brandCreatedBy = Auth::user()->id;
                $brand->brandName = $request->brandName;
                $brand->brandSlug = str_slug($request->brandName);
                $brand->brandDescription = $request->brandDescription;
                $brand->brandStatus = 1;
                $brand->created_at = date('Y-m-d h:i:s');
                $brand->save();
                if ($brand->id > 0) {
                    $brandData = ['brandName' => $request->brandName];
                    return response()->json(['code' => '1', 'message' => 'Brand Added Successfully!!!', 'data_array' => $brandData]);
                }
            } else {
                return response()->json(['code' => '-1', 'message' => 'Error Occured', 'data_array' => $validator->errors()->first()]);
            }
        }
        return response()->json(['code' => '0', 'message' => 'Error adding Brand!!!']);
    }

    /**
     * Add categories
     * @param Request $request
     * @return type
     */
    function addCategory(Request $request) {

        if ($request->method() == 'POST') {
            $rules = [
                'categoryName' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $category = new \App\Category();
                $category->categoryCreatedBy = Auth::user()->id;
                $category->companyId = Auth::user()->companyId;
                $category->categoryName = $request->categoryName;
                $category->categorySlug = str_slug($request->categoryName);
                $category->categoryStatus = 1;
                $category->created_at = date('Y-m-d h:i:s');
                $category->save();
                if ($category->id > 0) {
                    $categoryData = ['categoryName' => $request->categoryName];

                    return response()->json(['code' => '1', 'message' => 'Category Added Successfully!!!', 'data_array' => $categoryData]);
                }
            } else {
                return response()->json(['code' => '-1', 'message' => 'Error Occured', 'data_array' => $validator->errors()->first()]);
            }
        }
        return response()->json(['code' => '0', 'message' => 'Error adding Category!!!']);
    }

    /**
     * Change product status
     * @param Request $request
     * @return type
     */
    function changeProductStatus(Request $request) {
        $rules = [
            'id' => 'required',
            'productStatus' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $productDetailArray = ['productStatus' => $request->productStatus];
            $productObj = new \App\Product();
            $productObj->updateProductData($request->id, $productDetailArray);
            return response()->json(['code' => '1', 'message' => 'Status Changed Successfully!']);
        }
        return response()->json(['code' => '0', 'message' => 'Error Changing Status!!!']);
    }

    /**
     * Edit framing guide status
     * @param Request $request
     * @return type
     */
    function changeframingGuideStatus(Request $request) {
        $rules = [
            'id' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $framingGuideDetailArray = ['status' => $request->status];

            $framingGuideObj = new \App\Asset();
            $framingGuideObj->updateframingGuideData($request->id, $framingGuideDetailArray);
            return response()->json(['code' => '1', 'message' => 'Status Changed Successfully!']);
        }
        return response()->json(['code' => '0', 'message' => 'Error Changing Status!!!']);
    }

    /**
     * Search company users to add groups
     * @param Request $request
     * @return string
     */
    function searchCompanyUsers(Request $request) {
        $keyword = $request->get('term');
        $query = \App\User::where(function($query) use ($keyword) {
                    $query->orWhere('firstName', 'like', '%' . $keyword . '%');
                    $query->orWhere('lastName', 'like', '%' . $keyword . '%');
                    $query->orWhere('userName', 'like', '%' . $keyword . '%');
                    $query->orWhere('email', 'like', '%' . $keyword . '%');
                })
                ->where('companyId', Auth::user()->companyId)
                ->where('userStatus', '=', '1')
                ->select('users.*')
                ->get();
        if (count($query->toArray()) > 0) {
            $result_array = array_map(function($tag) {
                return [
                    'id' => $tag['id'],
                    'text' => $tag['firstName'] . ' ' . $tag['lastName']
                ];
            }, $query->toArray());
            return response()->json($result_array);
        } else {
            return '0';
        }
        return 'Please Enter 2 or more characters';
    }

    /**
     * Search company users to add groups
     * @param Request $request
     * @return string
     */
    function searchCompanygroupManager(Request $request) {
        $keyword = $request->get('term');
        $userObj = new User();
        $query = $userObj->searchUser($keyword, '8', Auth::user()->companyId);
        if (count($query->toArray()) > 0) {
            $result_array = array_map(function($tag) {
                return [
                    'id' => $tag['id'],
                    'text' => $tag['firstName'] . ' ' . $tag['lastName']
                ];
            }, $query->toArray());
            return response()->json($result_array);
        } else {
            return '0';
        }
        return 'Please Enter 2 or more characters';
    }

    /**
     * get trait
     * @param Request $request
     */
    function getTrait(Request $request) {
        return response()->json(\App\TemplateField::where('templateId', $request->id)->get());
    }

    /**
     * get the template form 
     * @param \App\Template $template
     */
    function getTemplateForm(\App\Template $template) {
        $data['templateFields'] = $template->templateField;
        return view('admin.demographics.partials.form')->with($data);
    }

    /**
     * search the participants by company
     * @return string
     */
    function getCompanyParticipants(Request $request) {
        $keyword = $request->get('term');
        $participantObj = new \App\Participant();
        $data = $participantObj->searchParticipants($keyword);
        if (count($data->toArray()) > 0) {
            $result_array = array_map(function($tag) {
                return [
                    'id' => $tag['id'],
                    'text' => $tag['firstName'] . ' ' . $tag['lastName']
                ];
            }, $data->toArray());
            return response()->json($result_array);
        } else {
            return '0';
        }
        return 'Please Enter 2 or more characters';
    }

    /**
     * add existing participants to the session
     * @return type
     */
    function addExistingParticipant(Request $request) {
        $rules = [
            'sessionId' => 'required',
            'participantId' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
//add to session
            $sessionParticipantObj = new \App\SessionParticipant();
            if ($sessionParticipantObj->validateSessionParticipants($request->sessionId, $request->participantId)) {
                return response()->json(['code' => '0', 'message' => 'User already exist on this session']);
            }
            $sessionParticipantObj->sessionId = $request->sessionId;
            $sessionParticipantObj->participantId = $request->participantId;
            $sessionParticipantObj->save();
            if ($sessionParticipantObj->id > 0) {
                return response()->json(['code' => '1', 'message' => 'Success']);
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * remove the user from any session
     * @param Request $request
     */
    function removeSessionUser(Request $request) {
        $rules = [
            'id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            //check for session
            $projectSessionObj = new \App\ProjectSession();
            if ($projectSessionObj->validateCompanySession(\App\SessionParticipant::find($request->id)->sessionId) == FALSE) {
                return response()->json(['code' => '0', 'message' => 'Something went wrong']);
            }
            \App\SessionParticipant::where('id', $request->id)->delete();
            return response()->json(['code' => '1', 'message' => 'Success']);
        }
    }

    /**
     * get the sessions by the project
     * @param \App\Http\Controllers\Project $project
     */
    function getSessionByProject(Project $project) {
        $projectObj = new Project();
        if ($projectObj->validateCompanyProject($project->id) == FALSE) {
            return 0;
        }
        return response()->json($project->projectSession);
    }

    /**
     * Search project by company id
     * @param Request $request
     * @return string
     */
    function searchProjects(Request $request) {
        $keyword = $request->get('term');
        $query = \App\Project::where(function($query) use ($keyword) {
                    $query->orWhere('projectTitle', 'like', '%' . $keyword . '%');
                })
                ->where('companyId', Auth::user()->companyId)
                ->where('projectStatus', '=', '1')
                ->select('projects.*');
        if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $query = $query->whereIn('projects.groupId', \Session::get('myGroups'));
        }
        if (Auth::check() && in_array('analyst', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $query = $query->where('projects.projectOwner', Auth::user()->id);
        }
        $query = $query->get();
        if (count($query->toArray()) > 0) {
            $result_array = array_map(function($tag) {
                return [
                    'id' => $tag['id'],
                    'text' => $tag['projectTitle']
                ];
            }, $query->toArray());
            return response()->json($result_array);
        } else {
            return '0';
        }
        return 'Please Enter 2 or more characters';
    }

    /**
     * add list of participants under the list
     * @param $request
     * @return $type
     */
    function addListParticipant(Request $request) {
        $rules = [
            'firstName' => 'required',
            'listId' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            //check the participant exist for the company
            $companyParticipantCount = \App\Participant::join('participant_companies', 'participant_companies.participantId', '=', 'participants.id')->where([
                        ['participant_companies.companyId', '=', Auth::user()->companyId],
                        ['participants.email', '=', $request->email]
                    ])->count();
            if ($companyParticipantCount > 0) {
                return response()->json(['code' => '0', 'message' => 'Participant already exist!!!']);
            }
            //check the participant is exist or not
            $participantArray = \App\Participant::where('email', $request->email)->first();
            if (count($participantArray) == 0) {
                $participant = new \App\Participant();
                $participantId = $participant->addParticipant($request);
            } else {
                $participantId = $participantArray->id;
            }
            if ($participantId > 0) {
                //add participant company
                $participantCompanyObj = new \App\ParticipantCompany();
                $participantCompanyObj->participantId = $participantId;
                $participantCompanyObj->companyId = Auth::user()->companyId;
                $participantCompanyObj->save();
//insert the user roles
                $listParticipantObj = new ListParticipant();
                $listParticipantId = $listParticipantObj->add($request->listId, $participantId);
                if ($listParticipantId > 0) {
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            }
        } else {
            return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * get list by list id
     * @param List $list
     */
    function getList(Lists $list) {
        return response()->json($list);
    }

    /**
     * change the list for the session
     */
    function changeSessionList(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'listId' => 'required',
                'sessionId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $sessionObj = new ProjectSession();
                if ($sessionObj->edit($request->sessionId, ['sessionListId' => $request->listId]) > 0) {
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * change the kit list for the session
     */
    function changeSessionKitList(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'kitListId' => 'required',
                'sessionId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $sessionObj = new ProjectSession();
                if ($sessionObj->edit($request->sessionId, ['kitParticipantId' => $request->kitListId]) > 0) {
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * delete list participant
     */
    function deleteListParticipant(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'listUserId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                if (ListParticipant::where('id', $request->listUserId)->delete()) {
                    Traits::where('listParticipantId', $request->listUserId)->delete();
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * add existing participant to list
     */
    function addExistingUserToList(Request $request) {
        if ($request->method() == 'POST') {
            $rules = [
                'listId' => 'required',
                'userId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $listParticipantObj = new ListParticipant();
                if ($listParticipantObj->validateParticipantAndList($request->listId, $request->userId) > 0) {
                    return response()->json(['code' => '0', 'message' => 'Participant already exist on this list']);
                }
                $listParticipantObj->listId = $request->listId;
                $listParticipantObj->participantId = $request->userId;
                $listParticipantObj->listUserStatus = '1';
                $listParticipantObj->save();
                if ($listParticipantObj->id > 0) {
                    return response()->json(['code' => '1', 'message' => 'Success']);
                }
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * search groups
     * @param Request $request
     * @return string
     */
    function searchGroups(Request $request) {
        $keyword = $request->get('term');
        $query = \App\Group::where(function($query) use ($keyword) {
                    $query->orWhere('groupName', 'like', '%' . $keyword . '%');
                })
                ->where('companyId', Auth::user()->companyId)
                ->where('groupStatus', '=', '1')
                ->select('groups.*');
//        if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
//            $query = $query->whereIn('projects.groupId', \Session::get('myGroups'));
//        }
        $query = $query->get();
        if (count($query->toArray()) > 0) {
            $result_array = array_map(function($tag) {
                return [
                    'id' => $tag['id'],
                    'text' => $tag['groupName']
                ];
            }, $query->toArray());
            return response()->json($result_array);
        } else {
            return '0';
        }
        return 'Please Enter 2 or more characters';
    }

    /**
     * save project assets
     * @param Request $request
     * @return type
     */
    function saveProjectAsset(Request $request) {
        $urlSlug = '';
        if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $urlSlug = 'group-manager';
        } else if (Auth::check() && in_array('user-admin', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $urlSlug = 'admin';
        }
        try {
            if ($request->method() == 'POST') {
                $rules = [
                    'projectId' => 'required',
                    'assetType' => 'required',
                    'fileName' => 'required'
                ];
                $validator = Validator::make($request->all(), $rules);
                if (!$validator->fails()) {
                    $assetType = $request->assetType;
                    if ($this->uploadAssetType($assetType, $request) == 'success') {
                        \Session::flash('success', 'Uploaded Successfully');
                        return redirect(url(($urlSlug != '' ? $urlSlug : '') . '/asset/import'));
                    }
                } else {
                    \Session::flash('error', $validator->errors()->all());
                    return redirect(url(($urlSlug != '' ? $urlSlug : '') . '/asset/import'));
                }
            }
            \Session::flash('error', 'Something went wrong');
            return redirect(url(($urlSlug != '' ? $urlSlug : '') . '/asset/import'));
        } catch (Exception $e) {
            \Session::flash('error', 'Something went wrong');
            return redirect(url(($urlSlug != '' ? $urlSlug : '') . '/asset/import'));
        }
    }

    /**
     * upload the asset files according to asset type
     * @param type $assetType
     * @param type $request
     * @return string
     */
    private function uploadAssetType($assetType, $request) {
        try {
            $fileUploadObj = new FileUpload();
            $response = 'error';
            $projectGuideDirectory = '';
            $mime = [];
            switch ($assetType) {
                case '1':
                    $timeStamp = time();
                    $projectGuideDirectory = public_path('uploads/assets' . '/' . Auth::user()->companyId . '/projectGuide/' . $timeStamp);
                    $mime = ['xls', 'xlsx', 'xlsxx'];
                    break;
                case '2':
                    $timeStamp = time();
                    $projectGuideDirectory = public_path('uploads/assets' . '/' . Auth::user()->companyId . '/dictionaries/' . $timeStamp);
                    $mime = ['txt'];
                    break;
                case '3':
                    $timeStamp = time();
                    $projectGuideDirectory = public_path('uploads/assets' . '/' . Auth::user()->companyId . '/products/' . $timeStamp);
                    $mime = ['xls', 'xlsx', 'csv'];
                    break;
            }
            if ($projectGuideDirectory != '') {
                $file = $request->file('fileName');
                $uploadResult = $fileUploadObj->uploadFile($file, $projectGuideDirectory, $mime);
                if ($uploadResult == '1') {
                    $uploadDataResult = $this->uploadAssetData($projectGuideDirectory . '/' . $file->getClientOriginalName(), $assetType, $request->projectId);
                    if ($uploadDataResult == 1) {
                        $response = 'success';
                    }
                }
            }
            return $response;
        } catch (Exception $e) {
            return 'error';
        }
    }

    /**
     * 
     * @param type $filePath
     * @param type $assetType
     * @param type $projectId
     * @return int
     */
    private function uploadAssetData($filePath, $assetType, $projectId) {
        try {
            $result = 0;
            $projectObj = new Project();
            if ($assetType == '1') {
                //import the excel sheet
                $commonControllerObj = new CommonController();
                $projectGuideArray = $commonControllerObj->importExcelSheets($filePath);
                if (count($projectGuideArray) > 0) {
                    //upload the project guide data to database
                    if ($projectObj->uploadProjectAssets([], $projectGuideArray, $projectId)) {
                        return 1;
                    }
                }
            } else if ($assetType == '2') {
                $lines = file($filePath);
                $dictionaryArray = array_map(function($array) {
                    return array_map('trim', $array);
                }, array_chunk($lines, 1));
                if (count($dictionaryArray) > 0) {
                    //upload the dictionary data to database
                    if ($projectObj->uploadProjectAssets($dictionaryArray, [], $projectId)) {
                        return 1;
                    }
                }
                return 1;
            } else if ($assetType == '3') {
                //import the csv product file
                $commonControllerObj = new CommonController();
                $productArray = $commonControllerObj->importCSV($filePath);
                if (count($productArray) > 0) {
                    //upload the project guide data to database
                    if ($projectObj->uploadProjectAssets([], [], $projectId, $productArray)) {
                        return 1;
                    }
                }
            }
            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * import the file only post request
     * @param Request $request
     */
    function import(Request $request) {
        $data = [];
        $data['success'] = 0;
        $errors = [];
        $data['sessionId'] = 0;
        $data['listId'] = 0;
        $data['filePath'] = '';
        if ($request->method() == 'POST') {
            if ($request->file("participantFile") != null) {
                $timestamp = time();
                $participantFile = $request->file('participantFile');
                $participantDirectory = public_path('uploads/participants/' . $timestamp);
                $fileUploadObj = new \App\Helpers\FileUpload();
                //upload the file to the specified directory
                $participantUploadResult = $fileUploadObj->uploadFile($participantFile, $participantDirectory, array('csv', 'xls', 'xlsx'));
                if ($participantUploadResult == '1') {
                    $commonControllerObj = new CommonController();
                    //extract data from the excel sheet
                    $uploadResult = $commonControllerObj->importExcelSheets($participantDirectory . '/' . $participantFile->getClientOriginalName());
                    $data['fileName'] = $participantFile->getClientOriginalName();
                    if (isset($uploadResult[0]) && count($uploadResult[0]) > 0) {
                        $keys = array_keys($uploadResult[0][0]);
                        foreach ($uploadResult[0] as $key => $row) {
                            $records = array_values($row);
                            //email validation 
                            if (!filter_var($records[2], FILTER_VALIDATE_EMAIL)) {
                                $errors[] = 'Invalid email in row ' . ($key + 1);
                            }
                            //phone number validation
                            if (!filter_var($records[3], FILTER_VALIDATE_INT) || strlen($records[3]) < 8 || strlen($records[3]) > 15) {
                                $errors[] = 'Invalid contact number in row ' . ($key + 1);
                            }
                        }
                        //check for trait template existence and fields under it
                        if ($keys > 5) {
                            if ($keys[5] != 'Template') {
                                $errors[] = '6th column must be "Template" in the sheet';
                            } else {
                                $templateName = $uploadResult[0][0]['Template'];
                                $templateArray = \App\Template::where('templateTitle', $templateName)->first();
                                //check for template
                                if (count($templateArray) > 0) {
                                    //check for the template are same in each row
                                    $templateUniqueArray = array_unique(array_column($uploadResult[0], 'Template'));
                                    if (count($templateUniqueArray) > 1) {
                                        $errors[] = 'Templates should be same for each row';
                                    }
                                    //check for session
                                    $sessionData = ProjectSession::where('id', $request->sessionId)->first();
                                    if ($sessionData->templateId != $templateArray->id) {
                                        $errors[] = 'Invalid template for session ' . $sessionData->sessionName;
                                    }
                                    //get the columns
                                    $templateColumnArray = $templateArray->templateField;
                                    $templateColumns = array_column($templateColumnArray->toArray(), 'templateFieldLabel');
                                    $templateFieldArray = [];
                                    foreach ($templateColumnArray as $tkey => $columns) {
                                        $templateFieldArray[$columns['templateFieldLabel']] = $columns['templateValidation'];
                                    }
                                    //get the template columns from excel sheet
                                    $templateInputColumns = array_slice($keys, 6);
                                    foreach ($templateInputColumns as $key1 => $inputColumn) {
                                        //check the column exist in the sheet? 
                                        if (!in_array($inputColumn, $templateColumns)) {
                                            $errors[] = 'Field "' . $inputColumn . '" does not exist in the template';
                                        } else {
                                            if ($templateFieldArray[$inputColumn] > 0) {
                                                //check for each record validation
                                                $validateObj = new \App\Helpers\Validate();
                                                $result = $validateObj->validateTemplateFieldData($inputColumn, $templateFieldArray[$inputColumn], $uploadResult[0]);
                                                if (count($result) > 0) {
                                                    foreach ($result as $err) {
                                                        $errors[] = $err;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $errors[] = $templateName . ' not found!!!';
                                }
//                                dd($templateColumns);
                            }
                        }
//                        dd($keys);
                        $data['error'] = $errors;
                        if (count($errors) == 0) {
                            $data['success'] = 1;
                        }
                        $data['sessionId'] = $request->sessionId;
                        $data['listId'] = $request->listId;
                        $data['filePath'] = $participantDirectory . '/' . $participantFile->getClientOriginalName();
                    }
                } else {
                    $data['error'] = ['Something went wrong with data in file!!!'];
                }
                if ($errors != '') {
                    $data['errors'] = $errors;
                }
            } else {
                $data['error'] = ['Something wrong with file uploaded!!!'];
            }
            $urlSlug = '';
            if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
                return view('groupManager.lists.import')->with($data);
            } else if (Auth::check() && in_array('user-admin', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
                return view('admin.lists.import')->with($data);
            }
        }
        return redirect('/home');
    }

    /**
     * save the participant from file
     * @param Request $request
     */
    function saveParticipantData(Request $request) {
        $urlSlug = '';
        if (Auth::check() && in_array('group-manager', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $urlSlug = 'group-manager';
        } else if (Auth::check() && in_array('user-admin', array_column(Auth::user()->userRole->toArray(), 'roleSlug'))) {
            $urlSlug = 'admin';
        }
        if ($request->method() == 'POST') {
            $rules['listId'] = 'required';
            $rules['sessionId'] = 'required';
            $rules['filePath'] = 'required';
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                if (is_file($request->filePath)) {
                    $commonControllerObj = new CommonController();
                    //extract data from the excel sheet
                    $uploadResult = $commonControllerObj->importExcelSheets($request->filePath);
                    if (isset($uploadResult[0]) && count($uploadResult[0]) > 0) {
                        $keys = array_keys($uploadResult[0][0]);
                        foreach ($uploadResult[0] as $key => $row) {
                            $records = array_values($row);
                            //validate existing participant
                            $validateEmail = \App\Participant::where('email', $records[2])->first();
                            if (count($validateEmail) > 0) {
                                $participantId = $validateEmail->id;
                            } else {
                                $participantObj = new \App\Participant();
                                $participantObj->firstName = $records[0];
                                $participantObj->lastName = $records[1];
                                $participantObj->email = $records[2];
                                $participantObj->phone = $records[3];
                                $participantObj->password = Hash::make(md5('123456'));
                                $participantObj->passcode = $records[4] != '' ? $records[4] : mt_rand(0000, 9999);
                                $participantObj->participantStatus = '1';
                                $participantObj->save();
                                $participantId = $participantObj->id;
                            }
                            if ($participantId > 0) {
                                //validate exiting participant for the company
                                $validateCompanyParticipant = \App\ParticipantCompany::where('participantId', $participantId)->where('companyId', Auth::user()->id)->count();
                                if ($validateCompanyParticipant == 0) {
                                    $participantCompanyObj = new \App\ParticipantCompany();
                                    $participantCompanyObj->participantId = $participantId;
                                    $participantCompanyObj->companyId = Auth::user()->id;
                                    $participantCompanyObj->save();
                                }
                                //save the participant into lists
                                $listParticipantObj = new \App\ListParticipant();
                                $listParticipantId = $listParticipantObj->add($request->listId, $participantId);
                                //add traits value for session and each participant
                                if ($listParticipantId > 0) {
                                    $traitInsertArray = [];
                                    $templateName = $uploadResult[0][0]['Template'];
                                    $templateArray = \App\Template::where('templateTitle', $templateName)->first();
                                    if (count($templateArray) > 0) {
                                        //get the template columns from excel sheet
                                        $templateInputColumns = array_slice($keys, 6);
                                        foreach ($templateInputColumns as $inputColumn) {
                                            //append the array for the traits
                                            $templateFieldArray = \App\TemplateField::where('templateId', $templateArray->id)->where('templateFieldLabel', $inputColumn)->first();
                                            $traitInsertArray[] = [
                                                'templateId' => $templateArray->id,
                                                'templateField' => $templateFieldArray->id,
                                                'traitValue' => $row[$inputColumn],
                                                'sessionId' => $request->sessionId,
                                                'listParticipantId' => $listParticipantId,
                                                'status' => '1'
                                            ];
                                        }
                                    }
                                    //save the traits to the database with session
                                    if (count($traitInsertArray) > 0) {
                                        Traits::insert($traitInsertArray);
                                    }
                                }
                            }
                        }
                        if ($participantId > 0) {
                            \Session::flash('success', 'Participants Uploaded Successfully');
                            return redirect('/' . $urlSlug . '/session/list/participant/' . $request->listId . '/' . $request->sessionId);
                        }
                    } else {
                        \Session::flash('error', 'Error in file');
                        return redirect('/' . $urlSlug . '/session/list/participant/' . $request->listId . '/' . $request->sessionId);
                    }
                }
            }
            \Session::flash('error', 'Something went wrong');
            return redirect('/' . $urlSlug . '/list/participant/' . $request->listId . '/' . $request->sessionId);
        }
    }

    /**
     * save the list details
     * @param $request
     */
    public function saveList(Request $request) {
        if ($request->method() == 'POST') {
            $rules['listName'] = 'required';
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                if ($request->listId != null && $request->listId > 0) {
                    $listObj = Lists::find($request->listId);
                } else {
                    if (Lists::where('listName', $request->listName)->where('companyId', Auth::user()->companyId)->count() > 0) {
                        return response()->json(['code' => '0', 'message' => 'List name already exist']);
                    }
                    $listObj = new Lists();
                    $listObj->listCreatedBy = Auth::user()->id;
                    $listObj->companyId = Auth::user()->companyId;
                    $listObj->listStatus = '1';
                }
                $listObj->listName = $request->listName;
                $listObj->listSlug = str_slug($request->listName);
                $listObj->save(); //save the list
                if ($listObj->id > 0) {
                    return response()->json(['code' => '1', 'message' => 'Success', 'dataArray' => ['id' => $listObj->id, 'name' => $listObj->listName]]);
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong']);
    }

    /**
     * save the participant kit lists
     * @param Request $request
     */
    function saveParticipantKit(Request $request) {
        if ($request->method() == 'POST') {
            $rules['kitParticipantName'] = 'required';
            $rules['kitParticipantPrefix'] = 'required';
            $rules['noOfDevices'] = 'required';
            $rules['speakerGap'] = 'required';
            $rules['microphone'] = 'required';
            $rules['onset'] = 'required';
            $rules['decay'] = 'required';
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                //check the particpant kit is already exist
                $kitParticipantObj = new \App\KitParticipant();
                if (!$kitParticipantObj->validateKitParticipantName($request->kitParticipantName)) {
                    return response()->json(['code' => '0', 'message' => 'Kit Participant List already exist']);
                }
                //save the kit participants
                $kitParticipantId = $kitParticipantObj->addKitParticipant($request);
                if ($kitParticipantId > 0) {
                    $participantObj = new \App\Participant();
                    $kitParticipantParticipants = [];
//		    insert participants
                    for ($i = 0; $i < $request->noOfDevices; $i++) {
                        $participantId = $participantObj->addData(
                                array(
                                    'firstName' => $request->kitParticipantPrefix,
                                    'lastName' => $i,
                                    'email' => $request->kitParticipantPrefix . '@gmail.com',
                                    'phone' => 1234567890,
                                    'contactMessage' => '',
                                    'participantStatus' => 1,
                                    'passCode' => isset($requet->passCode) ? $request->passCode : mt_rand(0000, 9999),
                                    'created_at' => date("Y-m-d H:i:s"),
                                )
                        );
                        $kitParticipantParticipants[] = ['participantId' => $participantId, 'kitParticipantId' => $kitParticipantId, 'status' => '1'];
                    }
                    if ($kitParticipantParticipants > 0) {
                        \App\KitParticipantParticipant::insert($kitParticipantParticipants);
                    }
                    return response()->json(['code' => '1', 'message' => 'Successful']);
                }
            } else {
                return response()->json(['code' => '0', 'message' => $validator->errors()->first()]);
            }
        }
        return response()->json(['code' => '0', 'message' => 'Something went wrong!!!']);
    }

    /**
     * save the define devices
     * @param $request
     */
    function saveDefineDevices() {
        return view('admin/session/defineDevices');
    }

    /**
     * save the set parameter devices
     * @param $request
     */
    function saveSetParameterDevice() {
        return view('admin/session/setParameterDevice');
    }

}
