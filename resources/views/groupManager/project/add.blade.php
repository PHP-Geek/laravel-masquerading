@extends('./layouts.admin')
@section('content') 
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><a href="{{url('/group-manager/project/list')}}">Projects</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                @if(isset($projectDetail) && count($projectDetail) > 0)
                                <span>Edit : {{$projectDetail->projectTitle}}</span>
                                @else
                                <span>Add</span>
                                @endif
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <form role="form" id="createProjectForm" action="" method="post" enctype="multipart/form-data">
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption caption-md">
                                                        <i class="icon-bar-chart font-dark hide"></i>
                                                        <span class="caption-subject font-red-sunglo uppercase bold">Project Details</span>
                                                    </div>
                                                    <div class="caption caption-md pull-right">
                                                        @if(isset($projectDetail) && count($projectDetail) == 0)
                                                        <button type="button" id="saveTemplate" class="btn btn-orange text-white saveDataBtn" data-value="0"><i class="fa fa-plus-circle"></i> Save as Template
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project Type </label>
                                                                    <select class="form-control" name="projectTypeId" id="projectTypeId">
                                                                        <option selected="selected" disabled="disabled" value="">Select project type</option>
                                                                        @foreach($projectTypes as $projectType)
                                                                        <option value="{{$projectType->id}}" {{isset($projectDetail) && $projectDetail->projectTypeId == $projectType->id ?'selected="selected"':''}} {{(old('projectTypeId') == $projectType->id) ? 'selected="selected"':''}}>{{$projectType->projectTypeName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Group</label>
                                                                    <select class="form-control" id="groupId" name="groupId">
                                                                        <option selected="selected" disabled="disabled" value="">Select group</option>
                                                                        @foreach($groups as $group)
                                                                        <option value="{{$group->id}}" {{isset($projectDetail) && $projectDetail->groupId == $group->id ?'selected="selected"':''}} {{old('groupId') == $group->id ? 'selected="selected"':''}}>{{$group->groupName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project manager</label>
                                                                    <select class="form-control" id="projectOwner" name="projectOwner">
                                                                        <option selected="selected" disabled="disabled" value="">Select project manager</option>
                                                                        @foreach($analysts as $analyst)
                                                                        <option value="{{$analyst->id}}" {{isset($projectDetail) && $projectDetail->projectOwner == $analyst->id ?'selected="selected"':''}} {{old('projectOwner') == $analyst->id ? 'selected="selected"':''}}>{{$analyst->email}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Number of Sessions</label>
                                                                    <input type="number" class="form-control" placeholder="Number of Sessions" id="projectSessionCount" name="projectSessionCount" value="{{old('projectSessionCount')!=''?old('projectSessionCount'):(isset($projectDetail->projectSessionCount)?$projectDetail->projectSessionCount:'')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project title</label>
                                                                    <input type="text" class="form-control" placeholder="Project title" name="projectTitle" id="projectTitle" value="{{old('projectTitle')!=''?old('projectTitle'):(isset($projectDetail->projectTitle)?$projectDetail->projectTitle:'')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="projectDescription" name="projectDescription" class="form-control" placeholder="Description here">{{old('projectDescription')!=''?old('projectDescription'):(isset($projectDetail->projectDescription)?$projectDetail->projectDescription:'')}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!isset($projectDetail) || $projectDetail->id == 0)
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Dictionary (.txt) max 5 MB</label>
                                                                    <input type="file" name="dictionary" id="dictionary"/>  
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Project Guide (Excel file) max 5 MB</label>
                                                                    <input type="file" name="projectGuideFile" id="projectGuideFile"/>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group margin-top-10">
                                                                    <label>Products (csv) max 5 MB</label>
                                                                    <input type="file" name="productFile" id="productFile"/>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-sm-12 margin-top-10">
                                                                <button type="submit" id="submitBtn" class="saveDataBtn btn btn-orange" data-value="1">{{(isset($projectDetail) && count($projectDetail) > 0)?'Update':'Create'}} Project</button>
                                                                <button id="cancelBtn" type="button" class="btn default">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
</div>
<script>
<?php if (\Session::has('success')) { ?>
        swal
                ({title: '', text: 'Successful', type: 'success'}, function () {
                    window.location.href = base_url + '/group-manager/project/list';
                });
<?php }
?>
<?php if (\Session::has('error')) { ?>
        swal('', "<?php echo \Session::get('error'); ?>", 'error');
    <?php
}
?>
</script>
<script src="{{url('/js/groupManager/projects/add.js')}}"></script>
@endsection
