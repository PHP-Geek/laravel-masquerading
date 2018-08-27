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
                                        <a href="{{url('/home')}}">Home</a>
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
                                                            <h3 class="font-blue-sharp">
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
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
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
                                                            <h3 class="font-purple-soft">
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
                                                            <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
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
                                                            <h3 class="font-blue-sharp">
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
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
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
                                                            <h3 class="font-blue-sharp">
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
                                                            <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
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
                                                            <h3 class="font-purple-soft">
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
                                                            <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
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

                                    
                                        <div class="page-content-inner">
                                            <div class="mt-content-body">
                                                <div class="row">
                                                 <div class="col-md-12 col-sm-12">
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart font-dark hide"></i>
                                                            <span class=" font-red-sunglo caption-subject uppercase bold">UPCOMING Session</span>
                                                            <span class="caption-helper hide">weekly stats...</span>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="portlet-body">

                                                        <div class="table-responsive">
                                                            
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th> S.No </th>
                                                                        <th> Session </th>
                                                                        <th> When </th>
                                                                        <th> Location </th>
                                                                        <th> Group </th>
                                                                        <th> Client </th>
                                                                        <th> Owner</th>
                                                                        <th> Reports needed</th>
                                                                       
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td> 1 </td>
                                                                        <td> Test Session </td>
                                                                        <td> 2018-08-10 <br> 06:00 AM <br> 1 Hours </td>
                                                                        <td> Grand Rapids </td>
                                                                        <td> Toddler moms</td>
                                                                        <td> Lotika S</td>
                                                                        <td> Ack</td>
                                                                        <td> Transcript - <span class="clr-green"><b> Completed</b> </span></td>
                                                                       
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 2 </td>
                                                                        <td> Galaxies </td>
                                                                        <td> 2018-08-8 <br> 02:00 AM <br> 2 Hours </td>
                                                                        <td> Texas Roadhouse </td>
                                                                        <td> Acolytes </td>
                                                                        <td> Mitura</td>
                                                                        <td> Mike </td>
                                                                        <td> Transcript - <span class="clr-green"><b> Completed</b> </span></td>
                                                                      
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 3 </td>
                                                                        <td> Geckos </td>
                                                                        <td> 2018-08-4 <br> 07:00 PM <br> 3 Hours </td>
                                                                        <td> Deloitte </td>
                                                                        <td> Goal Blusters</td>
                                                                        <td> Orioles</td>
                                                                        <td> Jedi</td>
                                                                        <td> Transcript - <span class="clr-green"><b> Completed</b> </span></td>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 4 </td>
                                                                        <td> Outlaws </td>
                                                                        <td> 2018-07-6 <br> 02:00 AM <br> 1 Hours </td>
                                                                        <td> Grand Rapids </td>
                                                                        <td> Wolves</td>
                                                                        <td> Crocs</td>
                                                                        <td> Dalmations</td>
                                                                        <td> Transcript - <span class="clr-green"><b> Completed</b> </span></td>
                                                                       
                                                                    </tr>                                                                             </tbody>
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
        </div>
@endsection
