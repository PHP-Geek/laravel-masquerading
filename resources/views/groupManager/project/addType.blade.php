@extends('./layouts.admin')
@section('content') 
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <!--                        <div class="page-head">
                                            <div class="container">
                                                 BEGIN PAGE TITLE 
                                                <div class="page-title">
                                                    <h1>Dashboard
                                                        <small>dashboard & statistics</small>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>-->
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
                                <span><a href="{{url('/group-manager/project/project-types')}}">Project Types</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Add</span>
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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Project Type Details</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" id="addProjectTypeForm" action="" method="post">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-offset-2 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Project Type </label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" placeholder="Project Type" id="projectTypeName" name="projectTypeName" value="{{ $projectTypeData!=null ? $projectTypeData->projectTypeName:'' }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>No of Speakers (leave blank if not specified)</label>
                                                                            <input type="text" name="noOfSpeakers" id="noOfSpeakers" class="form-control" placeholder="No of speakers" value="{{ $projectTypeData !=null ? $projectTypeData->noOfSpeakers:'' }}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-orange">Create Project Type</button>
                                                                    <button type="button" id="cancelButton" class="btn default">Cancel</button>
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
                </div>
            </div>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<script type="text/javascript" src="{{url('/js/groupManager/projects/addType.js')}}"></script>
@endsection

