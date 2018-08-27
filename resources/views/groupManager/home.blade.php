@extends('./layouts.admin')
@section('content')
<style>
    .table thead tr th {
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: nowrap;
    }
</style>
<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <div class="page-head">
                            <div class="container">
                                <!-- BEGIN PAGE TITLE -->
                                <div class="page-title">
                                    <h1>Dashboard
                                        <small>dashboard & statistics</small>
                                    </h1>
                                </div>
                            </div>
                        </div>
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
                                        <span>Dashboard</span>
                                    </li>
                                </ul>
                                <!-- END PAGE BREADCRUMBS -->
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <div class="mt-content-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-green-jungle">
                                                                <span data-counter="counterup" data-value="78">0</span>
                                                            </h3>
                                                            <small>SESSIONS</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-pie-chart"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 76%;" class="progress-bar progress-bar-success green-jungle">
                                                                <span class="sr-only">76% progress</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> progress </div>
                                                            <div class="status-number"> 76% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-red-haze">
                                                                <span data-counter="counterup" data-value="1349">0</span>
                                                            </h3>
                                                            <small>WORD COUNT</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-like"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                                                <span class="sr-only">85% change</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> change </div>
                                                            <div class="status-number"> 85% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-yellow-gold">
                                                                <span data-counter="counterup" data-value="567"></span>
                                                            </h3>
                                                            <small>HOURS RECORDED</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-basket"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success yellow-gold">
                                                                <span class="sr-only">45% grow</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> grow </div>
                                                            <div class="status-number"> 45% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-dark">
                                                                <span data-counter="counterup" data-value="276"></span>
                                                            </h3>
                                                            <small>NEW USERS</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 57%;" class="progress-bar progress-bar-success bg-dark">
                                                                <span class="sr-only">56% change</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> change </div>
                                                            <div class="status-number"> 57% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-yellow-haze">
                                                                <span data-counter="counterup" data-value="567"></span>
                                                            </h3>
                                                            <small>HOURS RECORDED</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-basket"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success yellow-haze">
                                                                <span class="sr-only">45% grow</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> grow </div>
                                                            <div class="status-number"> 45% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-green-sharp">
                                                                <span data-counter="counterup" data-value="78">0</span>
                                                            </h3>
                                                            <small>SESSIONS</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-pie-chart"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                                                <span class="sr-only">76% progress</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> progress </div>
                                                            <div class="status-number"> 76% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-green-seagreen">
                                                                <span data-counter="counterup" data-value="567"></span>
                                                            </h3>
                                                            <small>NEW USERS</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-basket"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success green-seagreen">
                                                                <span class="sr-only">45% grow</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> grow </div>
                                                            <div class="status-number"> 45% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="dashboard-stat2 ">
                                                    <div class="display">
                                                        <div class="number">
                                                            <h3 class="font-yellow">
                                                                <span data-counter="counterup" data-value="276"></span>
                                                            </h3>
                                                            <small>SESSIONS</small>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="icon-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-info">
                                                        <div class="progress">
                                                            <span style="width: 57%;" class="progress-bar progress-bar-success yellow">
                                                                <span class="sr-only">56% change</span>
                                                            </span>
                                                        </div>
                                                        <div class="status">
                                                            <div class="status-title"> change </div>
                                                            <div class="status-number"> 57% </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption font-red-sunglo">
                                                    <span class="caption-subject bold uppercase"> Groups</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Name Of Group</th>
                                                                <th>Parent Group </th>
                                                                <th>Created By</th>
                                                                <th class="text-center">Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Group 1</td>
                                                                <td>Vadi 1</td>
                                                                <td>John doe </td>
                                                                <td>
                                                                    <div class="text-center">
                                                                        <span id="status1" class="statusList label bg-green-jungle" onclick="groupStatus(1)" data-value="0">
                                                                            Active 
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a onclick="groupHierarchy(1)" href="javascript:;" class="btn green-jungle  btn-outline btn-sm">
                                                                        <i class="fa fa-eye"> View Group Hierarchy </i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="edit(1)" class="btn yellow-gold btn-outline btn-sm">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Group 2</td>
                                                                <td>Vadi 2</td>
                                                                <td>Johnny </td>
                                                                <td>
                                                                    <div class="text-center">
                                                                        <span id="status5" class="statusList label label-danger" onclick="groupStatus(5)" data-value="1"> 
                                                                            Inactive 
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a onclick="groupHierarchy(1)" href="javascript:;" class="btn green-jungle  btn-outline btn-sm">
                                                                        <i class="fa fa-eye"> View Group Hierarchy </i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="edit(1)" class="btn yellow-gold btn-outline btn-sm">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Group 3</td>
                                                                <td>Vadi 3</td>
                                                                <td>Matalock </td>
                                                                <td>
                                                                    <div class="text-center">
                                                                        <span id="status5" class="statusList label label-danger" onclick="groupStatus(5)" data-value="1"> 
                                                                            Inactive 
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a onclick="groupHierarchy(1)" href="javascript:;" class="btn green-jungle btn-outline btn-sm">
                                                                        <i class="fa fa-eye"> View Group Hierarchy </i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="edit(1)" class="btn yellow-gold  btn-outline btn-sm">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Group 4</td>
                                                                <td>Vadi 4</td>
                                                                <td>Jeff </td>
                                                                <td>
                                                                    <div class="text-center">
                                                                        <span id="status1" class="statusList label bg-green-jungle" onclick="groupStatus(1)" data-value="0">
                                                                            Active 
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a onclick="groupHierarchy(1)" href="javascript:;" class="btn btn-sm green-jungle btn-outline">
                                                                        <i class="fa fa-eye"> View Group Hierarchy </i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="edit(1)" class="btn btn-sm yellow-gold btn-outline">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PAGE CONTENT INNER -->
                                    </div>
                                </div>
                            </div>
                            <!-- END QUICK SIDEBAR -->
                        </div>
                        <!-- END CONTAINER -->
                    </div>
                </div>
            </div>
        </div> 
      </div>
  
<!---<script src="{{ url('js/superadmin/home.js') }}"></script>--->
@endsection