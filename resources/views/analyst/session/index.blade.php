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
                            <h1>Dashboard
                                <small>Projects</small>
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
                                <span>Sessions</span>
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
                                            <span class="caption-subject font-red-sunglo uppercase bold">Sessions</span>                </div>
                                        <div class="caption caption-md pull-right">
                                           
                                        </div>
                                    </div>
				    <div class="row">
					<div class="col-sm-12">
					    <form id="searchProjectForm" class="margin-bottom-20 margin-top-20">
						<div class="row">
						    
						    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
							&nbsp;
						    </div>
						    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
							<select class="form-control" id="projectName" name="projectName" ></select>

						    </div>
						    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
							<input type="text" placeholder="Date" id="date" name="date" class="form-control"/>
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
                                            <table class="table table-bordered" id="sessionDatatable">
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
<script src="{{url('/js/analyst/sessions/index.js')}}"></script>
@endsection
