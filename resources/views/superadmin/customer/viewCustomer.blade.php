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
                                <span><a href="{{url('/customers')}}">Customers</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span> View Customer</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->

                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6">
                                                        <h3 class="panel-title pull-left"><strong>Admin Details</strong></h3>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <span class="pull-right">
                                                            <a href="javascript:;" onclick="editCustomer()">
                                                                <i class="fa fa-edit yellow-gold"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class=" col-md-12 col-lg-12"> 
                                                        <table class="table table-user-information">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Company Name:</td>
                                                                    <td>{{$user->company->companyName}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>First Name:</td>
                                                                    <td>{{$user->firstName}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Last Name:</td>
                                                                    <td>{{$user->lastName}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Role:</td>
                                                                    <td>{{$user->userRole[0]->roleName}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile Number</td>
                                                                    <td>{{$user->phone}}</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><strong>Package Details</strong></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class=" col-md-12 col-lg-12 "> 
                                                        <table class="table table-user-information">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Package:</td>
                                                                    <td>{{$user->userPackage->packageTitle.' - $'.$user->userPackage->packagePrice}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Start Plan Date:</td>
                                                                    <td class="text-success"><strong>{{date('m/d/Y',strtotime($user->userPackage->packageInit))}}</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>End Plan Date:</td>
                                                                    <td class="text-danger"><strong>{{date('m/d/Y',strtotime($user->userPackage->packageExpire))}}</strong></td>
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
<script>
    function editCustomer() {
        window.location.href = base_url + '/customer/edit/{{$user->id}}';
    }
</script>
@endsection