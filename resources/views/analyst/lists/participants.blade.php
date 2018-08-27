@extends('./layouts.admin') @section('content')
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
                                <a href="{{url('/analyst/session/list')}}">Sessions</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="{{url('/analyst/session/list/participants/'.$sessionArray->id)}}">Lists</a>
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
                                                          <h4>List : {{ $listArray->listName }}</h4>
                                                      </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                    <div class="caption caption-md ">
                                                            <span class="caption-subject font-red-sunglo uppercase bold "> Participants</span>
                                                    </div>
                                                        </div>
                                                        
                                                </div>
                                                    <div class="margin-top-20"></div>
                                                    
                                                    <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="portlet-body">
                                                                    <div class="table-responsive">

                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.No</th>
                                                                                    <th> Participant Name </th>
                                                                                   
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                             @if(count($listArray->listUser) > 0)
                                                                             @foreach($listArray->listUser as $key => $listUser)
<tr id="row_{{ $listUser->id }}">
  <td>{{ $key+1 }}</td>
  <td>{{ $listUser->user->firstName.' < '.$listUser->user->email.' >' }}</td>
  
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

      <script>
var curData = {listId:'{{ $listArray->id }}'};
      </script>

@endsection