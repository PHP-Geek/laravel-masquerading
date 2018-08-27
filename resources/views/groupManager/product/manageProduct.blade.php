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
                                                <div class="caption caption-md pull-right">
                                                    <a type="button" href="{{url('/group-manager/product/import')}}" class="btn yellow text-white"> Import Product</a>
                                                    <a type="button" href="{{url('/group-manager/product/add')}}" class="btn btn-orange text-white"> Add Product</a>
                                                </div>
                                            </div>
                                            <form id="searchProductForm" method="POST">
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
<script type="text/javascript" src="{{url('/js/groupManager/product/manageProduct.js')}}"></script>
@endsection
