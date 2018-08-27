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
                                <span><a href="{{url('/admin/projects')}}">Projects</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                               
                                <span>Copy</span>
                               
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Project Copy</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" id="copyProjectForm" action="" method="post" >
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project Type </label>
                                                                    <select class="form-control" name="projectTypeId" id="projectTypeId">
                                                                        <option selected="selected" disabled="disabled" value="">Select project type</option>
                                                                        @foreach($projectTypes as $projectType)
                                                                        <option value="{{$projectType->id}}" {{isset($projectDetail) && $projectDetail->projectTypeId == $projectType->id ?'selected="selected"':''}} >{{$projectType->projectTypeName}}</option>
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
                                                                        <option value="{{$group->id}}" {{isset($projectDetail) && $projectDetail->groupId == $group->id ?'selected="selected"':''}} >{{$group->groupName}}</option>
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
                                                                        <option value="{{$analyst->id}}" {{isset($projectDetail) && $projectDetail->projectOwner == $analyst->id ?'selected="selected"':''}} >{{$analyst->email}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Client</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Client" id="projectClient" name="projectClient" value="{{(isset($projectDetail->projectClient)?$projectDetail->projectClient:'')}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project title</label>
                                                                    <input type="text" class="form-control" placeholder="Project title" name="projectTitle" id="projectTitle" value="{{(isset($projectDetail->projectTitle)?$projectDetail->projectTitle:'')}} copy">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Number of Sessions</label>
                                                                    <input type="number" class="form-control" placeholder="Number of Sessions" id="projectSessionCount" name="projectSessionCount" value="{{(isset($projectDetail->projectSessionCount)?$projectDetail->projectSessionCount:'')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="projectDescription" name="projectDescription" class="form-control" placeholder="Description here">{{(isset($projectDetail->projectDescription)?$projectDetail->projectDescription:'')}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12 margin-top-10">
                                                                <button type="submit" id="submitBtn" class="btn btn-orange"> Submit</button>
                                                                <button id="cancelBtn" type="button" class="btn default">Cancel</button>
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
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
</div>

<script src="{{url('/js/admin/projects/copy.js')}}"></script>
@endsection
