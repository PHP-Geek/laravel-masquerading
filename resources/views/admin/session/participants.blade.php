@extends('./layouts.admin')
@section('content') 
<style>
    .sweet-alert{
        z-index: 10055 !important;
    }
</style>
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
                                <span>Participants : {{$sessionDetail->project->projectTitle}}</span>
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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Participant List</span>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn green" data-toggle="modal" href="#import-list">Import</button>
                                                </div>
                                                <div class="col-sm-6 text-right" id="showBtns">
                                                    @if($sessionDetail->sessionSpeakerCount > count($sessionDetail->sessionParticipants))
                                                    <div class="btn-group">
                                                        <button class="btn green dropdown-toggle" data-toggle="dropdown">Add Participant
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:;" data-toggle="modal" data-target="#newParticipantModal"> New </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" data-toggle="modal" data-target="#existingParticipantModal"> Existing </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th> S.No </th>
                                                                <th> First Name </th>
                                                                <th> Last Name</th>
                                                                <th> Email</th>
                                                                <th> Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(count($sessionDetail->sessionParticipants) > 0)
                                                            @foreach($sessionDetail->sessionParticipants as $key => $participant)
                                                            <tr id="{{$participant->id}}">
                                                                <td>{{$key + 1}}</td>
                                                                <td>{{$participant->firstName}}</td>
                                                                <td>{{$participant->lastName}}</td>
                                                                <td>{{$participant->email}}</td>
                                                                <td>
                                                                    <a class="btn btn-sm red" onclick="deleteParticipant({{$participant->id}})"><i class="fa fa-times"></i> Remove</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr><td colspan="5">No Participants</td></tr>                                                            
                                                            @endif
                                                        </tbody>
                                                    </table>
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
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>

<!-- Modal -->
<div id="newParticipantModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Participant</h4>
            </div>
            <form action="" id="addParticipantForm" method="post">
                {{csrf_field()}}
                <input type="hidden" name="sessionId" value="{{$sessionDetail->id}}"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name </label>
                                <input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" autocomplete="off" value=""> </div>
                        </div>                                                                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name </label>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" autocomplete="off" value=""> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email" autocomplete="off" value=""> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" autocomplete="off" value=""> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username </label>
                                <input type="text" class="form-control" placeholder="Username" name="userName" id="userName" autocomplete="off" value=""> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Extra property 1 </label>
                                <input type="text" class="form-control" placeholder="Extra Property 1" name="extraProperty1" id="extraProperty1" autocomplete="off" value=""> </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn yellow-gold">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Modal -->
<div id="existingParticipantModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Exiting Participant</h4>
            </div>
            <form action="" id="addExistingParticipantForm" method="post">
                {{csrf_field()}}
                <input type="hidden" name="sessionId" value="{{$sessionDetail->id}}"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Search User </label>
                                <select type="text" class="form-control" name="participantId" id="participantId"></select> </div>
                        </div>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn yellow-gold">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    var data = {sessionId:'{{$sessionDetail->id}}'};</script>
<script src="{{url('/js/admin/sessions/participants.js')}}"></script>
@endsection