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
                                        <span>session Management</span>
                                        <i class="fa fa-circle"></i>
                                    </li>
                                    <li>
                                        <span>Monitor Session</span>

                                    </li>

                                </ul>
                                <!-- END PAGE BREADCRUMBS -->
                                <!-- BEGIN PAGE CONTENT INNER -->

                                <div class="page-content-inner">
                                    <div class="mt-content-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption font-red-sunglo">
<!--                                                                            <i class="icon-settings font-red-sunglo"></i>-->
                                                            <span class="caption-subject bold uppercase"> Monitor Session</span>
                                                        </div>
                                                        <div class="caption caption-md pull-right">
                                                            <span class="caption-subject bold uppercase clr-yellow">Need More Clarification</span>
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
                                                                        <th> Device </th>
                                                                        <th> Participant </th>
                                                                        <th> Mic </th>
                                                                        <th> S /Rec </th>
                                                                        <th> S /Sent </th>
                                                                        <th> S / Ack </th>
                                                                        <th> Gap </th>
                                                                        <th> Attack </th>
                                                                        <th> Decay</th>
                                                                        <th> S / Time </th>
                                                                        <th> E / Time </th>
                                                                        <th> Action</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td> 1 </td>
                                                                        <td> 1002 </td>
                                                                        <td> Washington, G  </td>
                                                                        <td> BT </td>
                                                                        <td> 152 </td>
                                                                        <td> 152 </td>
                                                                        <td> 151 </td>
                                                                        <td> 1.2 </td>
                                                                        <td> 1.0 </td>
                                                                        <td> 2.0 </td>
                                                                        <td> 11:20 </td>
                                                                        <td> 04:20 </td>
                                                                        <td>   
                                                                            <a type="button" class="btn blue btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="VIEW IN-PROGRESS TRANSCRIPT">V-IN-PT</a>
                                                                            <a class="btn purple btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="CURRENT IN-PROGRESS TRANSCRIPT">C-IN-PT</a>
                                                                            <!--<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start / Stop"><i class="fa fa-play"></i></a>

                                                                            <a class="btn green-jungle btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Parameter"><i class="fa fa-mobile"></i></a>
                                                                            <a class="btn yellow btn-outline" href="Create_session.php" data-toggle="tooltip" data-placement="top" title="" data-original-title="Draft Transcript">DT</a>-->
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 2 </td>
                                                                        <td> 1008 </td>
                                                                        <td> John, G  </td>
                                                                        <td> FT </td>
                                                                        <td> 131 </td>
                                                                        <td> 176 </td>
                                                                        <td> 189 </td>
                                                                        <td> 2.2 </td>
                                                                        <td> 4.0 </td>
                                                                        <td>6.0 </td>
                                                                        <td> 10:11 </td>
                                                                        <td> 12:30 </td>
                                                                        <td>   
                                                                            <a type="button" class="btn blue btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="VIEW IN-PROGRESS TRANSCRIPT">V-IN-PT</a>
                                                                            <a class="btn purple btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="CURRENT IN-PROGRESS TRANSCRIPT">C-IN-PT</a>
                                                                            <!--<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start / Stop"><i class="fa fa-play"></i></a>

                                                                            <a class="btn green-jungle btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Parameter"><i class="fa fa-mobile"></i></a>
                                                                            <a class="btn yellow btn-outline" href="Create_session.php" data-toggle="tooltip" data-placement="top" title="" data-original-title="Draft Transcript">DT</a>-->
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 3 </td>
                                                                        <td> 1004 </td>
                                                                        <td> Mike, G  </td>
                                                                        <td> DT </td>
                                                                        <td> 176 </td>
                                                                        <td> 987 </td>
                                                                        <td> 654 </td>
                                                                        <td> 3.2 </td>
                                                                        <td> 5.0 </td>
                                                                        <td> 8.0 </td>
                                                                        <td> 11:20 </td>
                                                                        <td> 02:00 </td>
                                                                        <td>   
                                                                            <a type="button" class="btn blue btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="VIEW IN-PROGRESS TRANSCRIPT">V-IN-PT</a>
                                                                            <a class="btn purple btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="CURRENT IN-PROGRESS TRANSCRIPT">C-IN-PT</a>
                                                                            <!--<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start / Stop"><i class="fa fa-play"></i></a>

                                                                            <a class="btn green-jungle btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Parameter"><i class="fa fa-mobile"></i></a>
                                                                            <a class="btn yellow btn-outline" href="Create_session.php" data-toggle="tooltip" data-placement="top" title="" data-original-title="Draft Transcript">DT</a>-->
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 4 </td>
                                                                        <td> 1003 </td>
                                                                        <td> Doer, G  </td>
                                                                        <td> PT </td>
                                                                        <td> 122 </td>
                                                                        <td> 562 </td>
                                                                        <td> 241 </td>
                                                                        <td> 6.2 </td>
                                                                        <td> 8.0 </td>
                                                                        <td> 2.0 </td>
                                                                        <td> 12:40 </td>
                                                                        <td> 01:10 </td>
                                                                        <td>   
                                                                            <a type="button" class="btn blue btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="VIEW IN-PROGRESS TRANSCRIPT">V-IN-PT</a>
                                                                            <a class="btn purple btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="CURRENT IN-PROGRESS TRANSCRIPT">C-IN-PT</a>
                                                                            <!--<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start / Stop"><i class="fa fa-play"></i></a>

                                                                            <a class="btn green-jungle btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Parameter"><i class="fa fa-mobile"></i></a>
                                                                            <a class="btn yellow btn-outline" href="Create_session.php" data-toggle="tooltip" data-placement="top" title="" data-original-title="Draft Transcript">DT</a>-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-actions">
                                                                                                            <button type="submit" class="btn blue btn-green">Add Device</button>
                                                                                                            <button type="button" class="btn default">Next</button>-->
                                                </div>
                                                </form>
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
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title text-center clr-green"><b>Group Hierarchy</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="box text-center">
                            <h5> Company Name <i class="fa fa-edit clr-blue"></i></h5>
                            <h5> Company Admin <i class="fa fa-edit clr-blue"></i></h5>
                        </div>

                    </div>
                </div>
                <div class="margin-top-5"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box text-center">
                            <h5> Group Name <i class="fa fa-edit clr-blue"></i></h5>
                            <h5> Group Admin <i class="fa fa-edit clr-blue"></i></h5>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="box text-center">
                            <h5> Group Name <i class="fa fa-edit clr-blue"></i></h5>
                            <h5> Group Admin <i class="fa fa-edit clr-blue"></i></h5>
                        </div>

                    </div>
                </div>
                <div class="margin-top-5"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box text-center">
                            <h5> Sub Group Name <i class="fa fa-edit clr-blue"></i></h5>
                            <h5> Group Admin <i class="fa fa-edit clr-blue"></i></h5>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="box text-center">
                            <h5> Sub Group Name <i class="fa fa-edit clr-blue"></i></h5>
                            <h5> Group Admin <i class="fa fa-edit clr-blue"></i></h5>
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
@endsection