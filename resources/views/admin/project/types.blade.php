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
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Project Types
                                <small>Project type listing</small>
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
                                <span>Project Types</span>
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
                                            <span class="caption-subject font-red-sunglo uppercase bold">Project Types</span>
                                        </div>
                                        <div class="caption caption-md pull-right ">
                                            <a type="button" href="{{url('/admin/project-type/add')}}" class="btn btn-orange text-white"><i class="fa fa-plus-circle"></i> Add Project Type </a>
                                        </div>
                                    </div>

				    <div class="portlet-body">
					<div class="row">
					    <div class="col-sm-12">
						<form id="searchProjectForm">
						    <div class="row">
							<div class="col-xs-12 col-sm-2 col-md-6"></div>
							<div class="col-xs-12 col-sm-5 col-md-4 text-right">
							    <input type="text" placeholder="Search" id="keyword" class="form-control"/>
							</div>
							<div class="col-xs-12 col-sm-5 col-md-2">
							    <button id="searchBtn" type="button" class="btn green-jungle">Apply</button>
							    <button id="resetBtn" type="button" class="btn red-haze">Reset</button>
							</div>
						    </div>                                                            
						</form>
					    </div>
					</div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="projectTypeDatatable">
                                            </table>
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
    </div>
</div>
<script type="text/javascript" src="{{url('/js/admin/projects/types.js')}}"></script>
@endsection

