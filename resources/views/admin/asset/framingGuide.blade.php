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
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Project Management</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Create and Modify Framing Guide</span>

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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Framing Guide</span>
                                                </div>
                                            </div>
                                            <form method="post" enctype="multipart/form-data" action="{{url('/admin/upload-file')}}" role="form">
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
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 margin-bottom-20">
                                                        <span class="btn green-jungle fileinput-button">
                                                            <i class="fa fa-plus"></i>
                                                            <span> Upload File</span>
                                                            <input type="file" name="files[]" multiple=""> 
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-4 margin-bottom-20">
                                                        <input type="submit" class="btn btn-orange" value="UPLOAD"/>
                                                    </div>

                                                </div>
                                            </form>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="framingGuideListing">
<!--							<thead>
                                                            <tr>
                                                                <th> S.No </th>
                                                                <th> File Name </th>
                                                                <th> Date/ Time</th>
                                                                <th> Status</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>-->

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
<script type="text/javascript" src="{{url('/js/admin/asset/framingGuide.js')}}"></script>
@endsection