
<?php include('include/header.php'); ?>

<style>
    .table thead tr th {
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: nowrap;
    }
    .clr-green {
        color: #417d6b !important;
    }
</style>
<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <?php include('include/header_include.php'); ?>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <!--                        <div class="page-head">
                                                    <div class="container">
                                                         
                                                        <div class="page-title">
                                                            <h1>Companies
                                                                
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>-->
                        <!-- END PAGE HEAD-->
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN PAGE BREADCRUMBS -->
                                <ul class="page-breadcrumb breadcrumb">
                                    <li>
                                        <a href="index.html">Home</a>
                                        <i class="fa fa-circle"></i>
                                    </li>
                                    <li>
                                        <span>Admin Features</span>
                                        <i class="fa fa-circle"></i>
                                    </li>
                                    <li>
                                        <span>Hierarchy Management</span>
                                        <i class="fa fa-circle"></i>
                                    </li>
                                    <li>
                                        <span>Edit/Delete Hierarchy</span>

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
                                                            <span class="caption-subject font-red-sunglo uppercase bold">Hierarchy Listing</span>
                                                            <span class="caption-helper hide">weekly stats...</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="dataTables_length pull-right" id="sample_5_length">
                                                                <div id="sample_5_filter" class="dataTables_filter"><label>Search:<input class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_5" type="search"></label></div></div></div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th> S.No </th>
                                                                        <th> User Role </th>
                                                                        <th> Customer </th>
                                                                        <th> Company </th>
                                                                        <th> Parent</th>
                                                                        <th> Division</th>
                                                                        <th> Product Line</th>
                                                                        <th> Product</th>
                                                                        <th> Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td> 1 </td>
                                                                        <td> User 1 </td>
                                                                        <td> John doe </td>
                                                                        <td> Nokia</td>
                                                                        <td> Nyuitr </td>
                                                                        <td> Bhyuji </td>
                                                                        <td> Bhyuhju</td>
                                                                        <td> Nuyvbrt</td>
                                                                        <td> <a href="#" type="button" class="btn green btn-outline"><i class="fa fa-edit"></i></a>

                                                                            <button class="btn red btn-outline mt-sweetalert swtalertt"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                                      <tr>
                                                                        <td> 2 </td>
                                                                        <td> User 2</td>
                                                                        <td> Mike </td>
                                                                        <td> Samsung</td>
                                                                        <td> Mytuhihgt </td>
                                                                        <td> Muybtv</td>
                                                                        <td> Nyfubn</td>
                                                                        <td> Nuyvbrt</td>
                                                                        <td> <a href="#" type="button" class="btn green btn-outline"><i class="fa fa-edit"></i></a>

                                                                            <button class="btn red btn-outline mt-sweetalert swtalertt"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                                     <tr>
                                                                        <td> 3 </td>
                                                                        <td> User 3 </td>
                                                                        <td> Srtyui </td>
                                                                        <td> Bhyun</td>
                                                                        <td> Vgtyhu </td>
                                                                        <td> Ftyhbu</td>
                                                                        <td> Bhyun</td>
                                                                        <td> Mhuibio</td>
                                                                        <td> <a href="#" type="button" class="btn green btn-outline"><i class="fa fa-edit"></i></a>

                                                                            <button class="btn red btn-outline mt-sweetalert swtalertt"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                                     <tr>
                                                                        <td> 4 </td>
                                                                        <td> User 4 </td>
                                                                        <td> Muutg </td>
                                                                        <td> Nhyubn</td>
                                                                        <td> Servhg </td>
                                                                        <td> Huijpj </td>
                                                                        <td> Drtjbj</td>
                                                                        <td> Mjuink</td>
                                                                        <td> <a href="#" type="button" class="btn green btn-outline"><i class="fa fa-edit"></i></a>

                                                                            <button class="btn red btn-outline mt-sweetalert swtalertt"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
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
    </div>
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title text-center clr-green"><b>Reset Password</b></h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input class="form-control" placeholder="New Password" type="password"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input class="form-control" placeholder="Confirm Password" type="password"> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $(".swtalert").on('click', function () {
            swal({
                title: "Are you sure to deactivate?",
                text: "Company will be deactivated !",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, deactivate it !",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deactivated!", "Company has been deactivated.", "success");
                        }
                    });
        });
        swal();
        $(".swtalertt").on('click', function () {
            swal({
                title: "Are you sure to delete?",
                text: "Company will be deleted !",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it !",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Company has been deleted.", "success");
                        }
                    });
        });
        swal();
    </script>
    <?php include('include/footer.php'); ?>