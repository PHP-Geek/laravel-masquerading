@extends('./layouts.admin')
@section('content')
<style>
.sessionListUpdate{
    cursor:pointer !important;
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
                            <h1>Participant Lists
                                <small>Lists</small>
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
                                <span>Lists</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption caption-md">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-red-sunglo uppercase bold">Lists</span>                
                                        </div>
					    <div class="caption caption-md pull-right">
                        <a href="javascript:;" onclick="addSessionList()" class="btn btn-orange text-white"><i class="fa fa-plus-circle"></i> Add New</a>
						</div>
                        </div>
					    </form>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>  </th>
                                            <th> S.No </th>
                                            <th> List Name </th>
                                            <th> No of Participants</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($listArray) > 0)
                                        @foreach($listArray as $key => $list)
                                        <tr id="row_{{ $list->id }}"> 
                                            <td>
                                                @if($sessionArray->sessionListId == $list->id)
                                                <i class="fa fa-2x fa-check-circle font-green-jungle"></i> 
                                                @else
                                                <i title="Select List" class="fa fa-2x font-grey-silver fa-check-circle sessionListUpdate" data-value="{{ $list->id }}"></i>
                                                @endif
                                            </td>
                                            <td>{{ $key+1 }}</td>
                                            <td class="listNameLabel"> {{ $list->listName }} </td>
                                            <td> Participants - {{ $list->noOfUsers }}</td>
                                            <td>   
                                                <a class="btn blue btn-sm btn-outline editButton" onclick="editList({{ $list->id }})" href="javascript:;">Edit</a>
                                                <a class="btn blue btn-sm btn-outline editButton" onclick="participants({{ $list->id }})" href="javascript:;">Participants</a>
                                            </td>
                                           
                                        </tr>
                                        @endforeach
                                        <tr><td colspan="4" class="text-center">{{ $listArray->links() }}</td></tr>
                                        @else
                                        <tr><td colspan="4">No data</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    </div>
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
      <script>
        var curData = {sessionId:'{{ $sessionArray->id }}'};  
      </script>
<script src="{{url('/js/admin/lists/sessionList.js')}}"></script>
@endsection
