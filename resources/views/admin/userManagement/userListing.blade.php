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
                                <span>Users</span>
                            </li>

                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption font-red-sunglo">
<!--                                                                            <i class="icon-settings font-red-sunglo"></i>-->
                                                    <span class="caption-subject bold uppercase"> Users</span>
                                                </div>
                                                <div class="caption caption-md pull-right ">
						    <a type="button" href="{{url('/admin/user/import')}}" class="btn bg-yellow text-white"> Import User</a>
                                                    <a type="button" href="{{url('admin/user/add')}}" class="btn btn-orange text-white"><i class="fa fa-user-plus"></i> New User</a>
                                                </div>
                                            </div>
					 
					    <div class="row">
						<div class="col-sm-12">
						    <form id="searchUserForm" class="margin-bottom-20 margin-top-20">
							<div class="row">

							    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								&nbsp;
							    </div>
							    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
								<select class="form-control" id="roleName" name="roleName" >
								      <option value="" disabled="disabled" selected="selected">Select role</option>
                                                                        @foreach($userRoleArray as $role)
                                                                        <option  value="{{$role->id}}">{{$role->roleName}}</option>       
                                                                        @endforeach
								</select>
							    </div>
							    <div class="col-xs-8 col-sm-3 col-md-3 col-lg-2">
								<input type="text" placeholder="Search" id="keyword" class="form-control"/>
							    </div>
							    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
								<button id="searchBtn" type="button" class="btn green-jungle pull-left">Apply</button>
								<button id="resetBtn" type="button" class="btn red-haze pull-right">Reset</button>
							    </div>
							</div>                                                            
						    </form>
						</div>
					    </div>
					    <div class="portlet-body">
						<div class="table-responsive">
                                                    <table class="table table-bordered" id="userListingDatatable">
                                                    </table>
                                                </div>
                                            </div>
                                            </form>
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
<script src="{{url('/js/admin/userManagement/userListing.js')}}"></script>
@endsection