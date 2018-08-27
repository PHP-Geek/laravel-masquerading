@extends('./layouts.admin')
@section('content')
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><a href="{{url('/admin/session/list')}}">Sessions</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>{{isset($sessionDetail)?'Edit':'Create'}}</span>
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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Session Details</span>
                                                </div>
                                                <div class="caption caption-md pull-right">
                                                    @if(!isset($sessionDetail) || count($sessionDetail) == 0)
                                                    <a class="btn btn-default mt-sweetalert swtalert">Save As Template</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" id="createSessionForm" action="" method="post">
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project</label>
                                                                    <select class="form-control" name="projectId" id="projectId">
                                                                        <option value="" selected="selected" disabled="disabled">Select Project</option>
                                                                        @foreach($projects as $project)
                                                                        <option {{(isset($sessionDetail->projectId) && $project->id == $sessionDetail->projectId) ? 'selected="selected"':''}} value="{{$project->id}}">{{$project->projectTitle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Number of speakers</label>
                                                                    <input type="text" class="form-control" placeholder="Number of speakers" name="sessionSpeakerCount" id="sessionSpeakerCount" value="{{isset($sessionDetail->sessionSpeakerCount)?$sessionDetail->sessionSpeakerCount:''}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Session Title</label>
                                                                    <input type="text" class="form-control" placeholder="Session Title" name="sessionName" id="sessionName" value="{{isset($sessionDetail->sessionName)?$sessionDetail->sessionName:''}}{{$type=='1'?' Copy':''}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input type="text" class="form-control" placeholder="Session Date" name="sessionDate" id="sessionDate" value="{{isset($sessionDetail->sessionDate)?date('m/d/Y',strtotime($sessionDetail->sessionDate)):''}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Start Time (24 hour format))</label>
                                                                    <input type="text" class="form-control" placeholder="Start Time" name="sessionStart" id="sessionStart" value="{{isset($sessionDetail->sessionStart)?date('H:i',strtotime($sessionDetail->sessionStart)):''}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Location</label>
                                                                    <input type="text" class="form-control" placeholder="Location" name="sessionLocation" id="sessionLocation" value="{{isset($sessionDetail->sessionLocation)?$sessionDetail->sessionLocation:''}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Session Length</label>
                                                                    <input type="text" class="form-control" placeholder="Session Length" name="sessionLength" id="sessionLength" value="{{isset($sessionDetail->sessionLength)?date('H:i',strtotime($sessionDetail->sessionLength)):''}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Report Needed</label>
                                                                    <select class="form-control" name="sessionReportNeeded" id="sessionReportNeeded">
                                                                        <option value="" selected="selected" disabled="disabled">Report Needed</option>
                                                                        @foreach($reportNeededArray as $reportNeeded)
                                                                        <option {{(isset($sessionDetail->reportNeeded) && $sessionDetail->reportNeeded == $reportNeeded)?'selected="selected"':''}} value="{{$reportNeeded}}">{{$reportNeeded}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Participant List &nbsp &nbsp<div class="caption caption-md pull-right">
                                                                            <a href="javascript:;" onclick="addSessionList()"><i class="fa fa-plus-circle"></i> Add New</a>
                                                                        </div></label>
                                                                    <select class="form-control" name="sessionListId" id="sessionListId">
                                                                        <option value="" selected="selected" disabled="disabled">Select List</option>
                                                                        @foreach($lists as $list)
                                                                        <option {{(isset($sessionDetail->sessionListId) && $list->id == $sessionDetail->sessionListId) ? 'selected="selected"':''}} value="{{$list->id}}">{{$list->listName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Trait Template</label>
                                                                    <select class="form-control" name="templateId" id="templateId">
                                                                        <option value="" selected="selected" disabled="disabled">Select Template</option>
                                                                        @foreach($templates as $template)
                                                                        <option {{(isset($sessionDetail->templateId) && $template->id == $sessionDetail->templateId) ? 'selected="selected"':''}} value="{{$template->id}}">{{$template->templateTitle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-actions">
                                                                    <button type="submit" class="btn yellow-gold">Submit</button>
                                                                    <button id="cancelBtn" type="button" class="btn default">Cancel</button>
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
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<div id="addNewListModal" class="modal fade" role="dialog">
    <div class="modal-dialog">      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New List</h4>
            </div>
            <form id="addListForm" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="listId" id="listId"/>
                                <input type="text" name="listName" id="listName" class="form-control" placeholder="List Name"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-orange text-white">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="{{url('/js/admin/sessions/create.js')}}"></script>

@endsection