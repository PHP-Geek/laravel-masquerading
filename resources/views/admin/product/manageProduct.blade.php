@extends('./layouts.admin')
@section('content')
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Products</span>
                            </li></ul>
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Manage Products</span>
                                                    <span class="caption-helper hide">weekly stats...</span>
                                                </div>
                                                
                                            </div>

					    <div class="portlet-body">
						<div class="row">
						    <div class="col-sm-12">
							<form id="searchProductForm">
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
                                                    <table class="table table-bordered" id='productListing'>
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
<script type="text/javascript" src="{{url('/js/admin/product/manageProduct.js')}}"></script>
@endsection
