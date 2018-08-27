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
                <!-- BEGIN CONTENT BODY -->
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
                                <span>Customers</span>
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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Customers</span>
                                                </div>
						<div class="form-actions pull-right">
						    <a type="button" href="{{url('/customer/add')}}" class="btn btn-orange pull-right text-white"> Add New</a>
						</div>
                                            </div>

                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <form id="customerListingForm">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-4"></div>
                                                                <div class="col-xs-8 col-sm-4 col-md-4 col-lg-4">
                                                                    <input type="text" placeholder="Search" id="keyword" class="form-control"/>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                                                    <select name="status" id="status" class="form-control">
                                                                        <option selected="selected" disabled="disabled">All</option>
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                        <option value="-1">Banned</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                                                                    <button id="applyBtn" type="button" class="btn green-jungle">Apply</button>
                                                                    <button id="resetBtn" type="button" class="btn red-haze">Reset</button>
                                                                </div>
                                                            </div>                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="margin-top-10"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="customerListingDatatable"></table>
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
<script type="text/javascript" src="{{url('/js/superadmin/customer/customerListing.js')}}"></script>
@endsection
