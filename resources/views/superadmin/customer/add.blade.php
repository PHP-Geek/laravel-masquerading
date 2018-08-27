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
				<span>VaDi Admin</span>
				<i class="fa fa-circle"></i>
			    </li>
			    <li>
				<span>Add</span>

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
						    <span class="caption-subject font-red-sunglo uppercase bold">Customers</span>
						    <span class="caption-helper hide">weekly stats...</span>
						</div>

					    </div>
					    <div class="portlet-body form">
						<form role="form" id="addCustomerForm" name="addCustomerForm" method="post">
						    {{csrf_field()}}
						    <div class="form-body">
							<div class="row">
							    <div class="col-md-6">
								<div class="form-group">
								    <label>First Name </label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-user"></i>
									</span>
									<input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName"> </div>
								</div>
							    </div>
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Last Name</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-user"></i>
									</span>
									<input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName"> </div>
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
									<input type="text" class="form-control" placeholder="Email" name="email" id="email" > </div>
								</div>
							    </div>
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Phone</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-phone"></i>
									</span>
									<input type="text" class="form-control" placeholder="phone" name="phone" id="contactNo"> </div>
								</div>
							    </div>
							</div>
							<div class="row">
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Username</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-user"></i>
									</span>
									<input type="text" class="form-control" placeholder="Username" name="userName" id="userName"> 
								    </div>
								</div>
							    </div>
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Company Name</label>
								    <div class="input-group input-icon right">
									<span class="input-group-addon">
									    <i class="fa fa-lock"></i>
									</span>
									<input class="form-control placeholder-no-fix" type="text" autocomplete="off" id="companyName" placeholder="Company Name"  name="companyName"/>      
								    </div>
								</div>
							    </div>
							</div>
							<div class="row">
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Password</label>
								    <div class="input-group input-icon right">
									<span class="input-group-addon">
									    <i class="fa fa-lock"></i>
									</span>
									<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" autocomplete="off" name="password" id="password"/>      
									<i class="fa fa-question-circle" style="color:green;cursor: pointer" data-placement="left" data-toggle="popover" data-content="Password must be atleast 8 characters and maximum 14 characters, minimum one uppercase and one lowercase character, minimum one digit and one special character."></i>   
								    </div>
								</div>
							    </div>
							    <div class="col-md-6">
								<div class="form-group">
								    <label>Confirm Password</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-lock"></i>
									</span>
									<input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword"> </div>
								</div>
							    </div>
							</div>
							<div class="row">
							   <div class="col-md-6">
								<div class="form-group">
								    <label>Package</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-check"></i>
									</span>
									<select class="form-control" name="packageId" id="packageId">
									    <option value="" disabled="disabled" selected="">Select Package</option>
									    @foreach($packages as $package)
									    <option  value="{{$package->id}}">{{$package->packageTitle}}</option>
									    @endforeach
									</select>
								    </div>
								</div>
							    </div>
							    <div class="col-md-6">
								<div class="form-group">
								    <label>LOB</label>
								    <div class="input-group">
									<span class="input-group-addon">
									    <i class="fa fa-check"></i>
									</span>
									<select class="form-control" name="companyLOB" id="companyLOB">
									    <option value="" disabled="disabled" selected="">Select LOB</option>
									    @foreach($lobs as $LOB)
									    <option  value="{{$LOB->id}}">{{$LOB->title}}</option>
									    @endforeach
									</select>
								    </div>
								</div>
							    </div>
							    <div class="">
								<button type="submit" id="addCustomerBtn" class="btn btn-orange">Submit</button>
								<a  href="{{url('/customers')}}" class="btn default">Cancel</a>
							    </div>
							    <div class="margin-bottom-10"></div>
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
</div>
<script src="{{ url('js/superadmin/customer/add.js')}}"></script>
@endsection