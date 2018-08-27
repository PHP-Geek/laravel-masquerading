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
                                <a href="{{url('/customers')}}">Customers</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Change Password</span>
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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Change Password</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <form id="changePasswordForm" action="" method="post">
                                                            {{csrf_field()}}
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <div class="input-group input-icon right">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-lock"></i>
                                                                        </span>
                                                                        <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="New Password" autocomplete="off"/>
                                                                        <i class="fa fa-question-circle" style="color:green;cursor: pointer" data-placement="left" data-toggle="popover" data-content="Password must be atleast 8 characters and maximum 14 characters, minimum one uppercase and one lowercase character, minimum one digit and one special character."></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Confirm Password</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-lock"></i>
                                                                        </span>
                                                                        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" class="form-control" autocomplete="off"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <button type="submit"  class="btn btn-orange" id="changePasswordButton">Submit</button>
                                                                    <a href="{{url('/customers')}}" type="button" class="btn default">Cancel</a>
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
<script type="text/javascript" src="{{url('/js/superadmin/customer/changePassword.js')}}"></script>
@endsection

