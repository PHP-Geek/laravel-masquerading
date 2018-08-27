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
                                <span>Session</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Create Quick Session</span>

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
                                                <div class="caption caption-md ">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold ">Create Quick Session</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" id="createSessionForm" action="" method="post">
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Session Name </label>
                                                                    <input type="text" class="form-control" placeholder="Session Name" id="sessionName" name="sessionName">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Session Date</label>
       
                                                                        <input type="text" class="form-control" id="sessionDate" name="sessionDate">
                                               
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Session Start Time</label>
                                                                    <div class="input-group" id="defaultrange">
                                                                        <input type="text" class="form-control" id="sessionStart" name="sessionStart">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn default date-range-toggle" type="button">
                                                                                <i class="fa fa-clock-o"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Duration</label>
                                                                    <div class="input-group" id="defaultrange">
                                                                        <input type="text" class="form-control" id="sessionEnd" name="sessionEnd">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn default date-range-toggle" type="button">
                                                                                <i class="fa fa-clock-o"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                   
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="portlet-title">
                                                                        <div class="caption caption-md">
                                                                            <h4 class="caption-subject font-blue bold">OR</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="portlet-title">
                                                                        <div class="caption caption-md">
                                                                            <span class="caption-subject font-green bold">Session Participants</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <div class="row">
                                                           <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Select from know user lists (such as kit lists)</label>
                                                                     <select class="form-control" name="sessionKitId" id="sessionKitId">
                                                                         <option value="" selected="selected" >Select Kit  Lists</option>
                                                                           @foreach($kitParticipants as $kitParticipant)
                                                                        <option  value="{{$kitParticipant->id}}">{{$kitParticipant->kitParticipantName}}</option>
                                                                        @endforeach
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Select from  Customer's existing list of users</label>
                                                                    <select class="form-control" name="sessionListId" id="sessionListId">
                                                                        <option value="" selected="selected" >Select List</option>
                                                                        @foreach($lists as $list)
                                                                        <option  value="{{$list->id}}">{{$list->listName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="col-md-4">
                                                                
                                                            </div> 

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="form-actions margin-top-23 text-center">
                                                                        <button type="submit" class="btn blue-madison text-white text-center">Create</button>

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
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/js/admin/sessions/createQuickSession.js')}}"></script>
@endsection
