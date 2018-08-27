@extends('./layouts.admin')
@section('content')   
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url("/home")}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Import Assets</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption font-red-sunglo">
<!--                                                                            <i class="icon-settings font-red-sunglo"></i>-->
                                                    <span class="caption-subject font-red-sunglo bold uppercase"> Import Assets</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    <form id="assetForm" method="post" action="{{url("group-manager/asset/save")}}" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Project</label>
                                                                    <select class="form-control" id="projectId" name="projectId">
                                                                        @foreach($projects as $project)
                                                                        <option value="{{$project->id}}">{{$project->projectTitle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Asset Type</label>
                                                                    <select class="form-control" id="assetType" name="assetType">
                                                                        <option value="">Asset Type</option>
                                                                        <option value="1">Project Guide</option>
                                                                        <option value="2">Dictionary</option>
                                                                        <option value="3">Products</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row hidden" id="browseFile">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Upload <span id="uploadLabel"></span></label>
                                                                    <input type="file" name="fileName" id="fileName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            {{csrf_field()}}
                                                            <button type="submit" class="btn blue btn-orange">Import</button>
                                                        </div>
                                                    </form>
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
<script>
<?php if (\Session::has('success')) { ?>
    swal
            ({title: '', text: 'Successful', type: 'success'}, function () {
                window.location.href = base_url + '/group-manager/project/list';
            });
<?php }
?>
<?php if (\Session::has('error')) { ?>
    swal('', "<?php echo \Session::get('error'); ?>", 'error');
<?php
}
?>
</script>
<script src="{{url("/js/groupManager/asset/import.js")}}"></script>
@endsection