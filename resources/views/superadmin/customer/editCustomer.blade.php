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
                                <span><a href="{{url('/customers')}}">Customers</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><a href="{{url('/customer/view/'.$user->id)}}">View</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Edit</span>

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
                                                    <span class="caption-subject font-red-sunglo uppercase bold">VaDi Admin Details</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form role="form" id="editCustomerForm" method="post" action="">
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Company</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-home"></i>
                                                                        </span>
                                                                        <input type="text" name="companyName" id="companyName" value="{{$user->company->companyName}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>First Name </label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" value="{{ $user->firstName }}"> </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" value="{{ $user->lastName }}"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{ $user->email}}"> </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Phone</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-phone"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" value="{{ $user->phone}}"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <button type="submit" id="addSuperadminBtn" class="btn blue btn-green">Submit</button>
                                                            <a href="{{url('/customer/view/'.$user->id)}}" type="button" class="btn default">Cancel</a>
                                                        </div>
                                                        <div class="margin-bottom-10"></div>
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
</div>
<script>
    var userId = '{{$user->id}}';
    var companyId= '{{$user->company->id}}';
</script>
<script src="{{ url('js/superadmin/customer/editCustomer.js') }}"></script>
@endsection
