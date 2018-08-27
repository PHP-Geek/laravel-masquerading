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
                                <span><a href="{{url("/group-manager/products")}}">Product</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                        </ul>
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Import File</span>
                                                </div>
                                            </div>
                                            <form method="post" enctype="multipart/form-data" action="{{url('/admin/product/import')}}" role="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <?php if (\Session::has('error') != null) { ?>
                                                            <div id="message" class="alert alert-danger alert-dismissable">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <?php
                                                                echo \Session::get('error');
                                                                \Session::forget('error');
                                                                ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (\Session::has('success') != null) { ?>
                                                            <div id="message" class="alert alert-success alert-dismissable">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <?php
                                                                echo \Session::get('success');
                                                                \Session::forget('success');
                                                                ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                {{csrf_field()}}
                                                <div class="row"><div class="col-md-6 col-sm-6">
                                                        <div class="caption caption-md ">
                                                            <span class="btn green-jungle fileinput-button">
                                                                <i class="fa fa-plus"></i>
                                                                <span> Add files... </span>
                                                                <input type="file" name="files[]" multiple="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4"> <div class ='padding-tb-10'></div>
                                                        <input type="submit" class="btn btn-orange text-capitalize" value="UPLOAD"/>
                                                    </div>
                                                </div>
                                            </form>
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
@endsection