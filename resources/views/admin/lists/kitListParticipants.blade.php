@extends('./layouts.admin') @section('content')
<style>
    .padding-top-23{
        padding-top:23px !important;
    }
</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Participants
                                <small></small>
                            </h1>
                        </div>
                    </div>
                </div>
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
                                <a href="{{url('/admin/session/list')}}">Sessions</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="{{url('/admin/session/list/kit-list/'.$sessionArray->id)}}">kit Lists</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>create</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                        <div class="page-content-inner">
                            <div class="mt-content-body"> 
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h4>List : {{ $kitListArray->kitParticipantName }}</h4>
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="portlet-body">
                                                                <div class="table-responsive">

                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>S.No</th>
                                                                                <th> Participant Name </th>
                                                                                <th>Email</th>
                                                                                <th>Pass Code</th>
                                                                                <th> Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if(count($kitListArray->kitParticipantParticipant) > 0)
                                                                            @foreach($kitListArray->kitParticipantParticipant as $key => $listParticipant)									                                                                             <tr id="row_{{ $listParticipant->id }}">
                                                                                <td>{{ $key+1 }}</td>
                                                                                <td>{{ $listParticipant->participant->firstName.' '.$listParticipant->partcipant_lastName }}</td>
                                                                                <td>{{ $listParticipant->participant->email}}</td>
                                                                                <td>{{ $listParticipant->participant->passCode }}</td>
                                                                                <td><a href="javascript:;" onclick="deleteParticipant(this)" data-value="{{ $listParticipant->id }}"><i class="fa fa-trash text-danger"><i></a></td>  
                                                                                                </tr>
                                                                                                @endforeach
                                                                                                @else
                                                                                                <tr>
                                                                                                    <td colspan="3">No Data</td>
                                                                                                </tr>
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
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                </div>
                                                                                                <!-- END QUICK SIDEBAR -->
                                                                                                </div>
                                                                                                <!-- END CONTAINER -->
                                                                                                </div>
                                                                                                <div id="addExistingUserModal" class="modal fade" role="dialog">
                                                                                                    <div class="modal-dialog">      
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                <h4 class="modal-title">Add New List</h4>
                                                                                                            </div>
                                                                                                            <form id="addExistingListForm" method="POST" action="">
                                                                                                                {{ csrf_field() }}
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <select id="userId" name="userId" class="form-control"></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                    <button id="addExistingUserButton" type="button" class="btn btn-orange text-white">Submit</button>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="importParticipantModal" class="modal fade" role="dialog">
                                                                                                    <div class="modal-dialog">      
                                                                                                        <!-- Modal content-->
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                <h4 class="modal-title">Import Participants</h4>
                                                                                                            </div>
                                                                                                            <form id="importParticipantForm" method="POST" action="{{url('/admin/session/list/import')}}" enctype="multipart/form-data">
                                                                                                                {{ csrf_field() }}
                                                                                                                <input type="hidden" name="sessionId" value="{{$sessionArray->id}}"/>
                                                                                                                <input type="hidden" name="listId" value="{{$kitListArray->id}}"/>
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <label>Upload file (excel sheet) max 5 MB</label>                                                                                                                                <input type="file" name="participantFile" id="participantFile"/>                               </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                    <button id="addExistingUserButton" type="submit" class="btn btn-orange text-white">Submit</button>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>

                                                                                                <script>
<?php if (\Session::has('success')) { ?>
                                                                                                        swal('', "<?php echo \Session::get('success'); ?>", 'success');
<?php }
?>
<?php if (\Session::has('error')) { ?>
                                                                                                        swal('', "<?php echo \Session::get('error'); ?>", 'error');
    <?php
}
?>
                                                                                                </script>
                                                                                                <script>
                                                                                                    var curData = {listId: '{{ $kitListArray->id }}'};
                                                                                                </script>
                                                                                                <script src="{{url('/js/admin/lists/kitListParticipants.js')}}"></script>
                                                                                                @endsection