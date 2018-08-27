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
                                <small>Project Templates</small>
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
                                <span>Project Templates</span>
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
                                            <span class="caption-subject font-red-sunglo uppercase bold">Project Template</span>                </div>
					    <div class="caption caption-md pull-right">
                                                    <a href="javascript:;" onclick="addProjectTemplate()" class="btn default btn-green text-white"><i class="fa fa-plus-circle"></i> Add New</a>
						</div>
                                    </div>
				      <form id="searchProjectForm" method="POST">
						<div class="row">
						    <div class="col-md-12 col-sm-12">
							<div class="dataTables_length pull-right margin-top-20" id="sample_5_length" style="max-width: 300px;">
							    <div id="sample_5_filter" class="dataTables_filter input-group">
								<input type="text" name="keyword" id="keyword" class="form-control" style="height: 34px" placeholder="Search">
								<span class="input-group-btn">
								    <button class="btn btn-default" type="button" id="searchBtn">
									<span class="glyphicon glyphicon-search"></span>
								    </button>
								    <button class="btn green-jungle" type="button" id="resetBtn">
									<span class="fa fa-refresh"></span>
								    </button>
								</span>
							    </div>
							</div>
						    </div>

						</div>
					    </form>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="projectTemplateDatatable">
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
<script src="{{url('/js/groupManager/projects/templates.js')}}"></script>
@endsection
