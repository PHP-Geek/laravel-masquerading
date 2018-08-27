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
					 
					    <div class="portlet-body">
						<div class="row">
						    <div class="col-sm-12">
							<form id="searcGroupForm">
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
<script src="{{url('/js/admin/userManagement/viewGroup.js')}}"></script>
@endsection

