@extends('./layouts.admin')
@section('content') 
<style>
    .statusList{
        cursor: pointer !important;
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
			<ul class="page-breadcrumb breadcrumb">
			    <li>
				<a href="{{url('/home')}}">Home</a>
				<i class="fa fa-circle"></i>
			    </li>
			    <li>
				<span>Groups</span>
			    </li>
			</ul>
			<div class="page-content-inner">
			    <div class="mt-content-body">
				<div class="row">
				    <div class="col-md-12 col-sm-12">
					<div class="portlet light ">
					    <div class="portlet-title">
						<div class="caption font-red-sunglo">
						    <span class="caption-subject bold uppercase"> Groups</span>
						</div>
						<div class="caption caption-md pull-right">
                                                    <a href="javascript:;" onclick="addGroup()" class="btn btn-orange text-white"><i class="fa fa-plus-circle"></i> Add New</a>
						</div>
					    </div>
					    <form id="searcGroupForm" method="POST">
						    <div class="row">
							<div class="col-md-12 col-sm-12">
							    <div class="dataTables_length pull-right margin-top-20" id="sample_5_length" style="max-width: 300px;">
								<div id="sample_5_filter" class="dataTables_filter input-group">
								    <input type="text" name="keyword" id="keyword" class="form-control" style="height: 34px" placeholder="Search">
								    <span class="input-group-btn">
									<button class="btn btn-default" type="button" id="searchBtn">
									    <span class="glyphicon glyphicon-search"></span>
									</button>
									<button class="btn yellow-gold" type="button" id="resetBtn">
									    <span class="fa fa-refresh"></span>
									</button>
								    </span>
								</div>
							    </div>
							</div>

						    </div>
						</form>
					    <div class="portlet-body">
						<div class="table-responsive" >
						    <table class="table table-bordered" id="groupDatatable">
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
<script src="{{url('/js/groupManager/userManagement/viewGroup.js')}}"></script>
@endsection

