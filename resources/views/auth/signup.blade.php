@extends('./layouts.common')
@section('content')
<style>
    form{
        display: block !important;
    }
    .has-error .help-block{
        color:#ff6666 !important;
    }
    .login .content .input-icon {
        border-left: 0!important;
        
    }
</style>
<div class="content">
    <!-- BEGIN REGISTRATION FORM -->
    <form id="registerForm" class="register-form" action="" method="post">
        {{ csrf_field()}}
        <h3 class="font-white">Sign Up</h3>
        <p class="font-white"> Enter your details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">First Name</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" autocomplete="off" name="firstName" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Last Name</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" autocomplete="off" name="lastName" /> </div>
        </div>        
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Username" autocomplete="off" name="userName" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" autocomplete="off" name="email" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-group input-icon right">
                <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                </span>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" autocomplete="off" name="password"   
               style="cursor: pointer" data-placement="right"  data-toggle="popover" data-content="Password must be atleast 8 characters and maximum 14 characters, minimum one uppercase and one lowercase character, minimum one digit and one special character."  /> 
                 <i class="fa fa-question-circle" style="color:green"></i> 
            </div>

        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" autocomplete="off" name="confirmPassword" /> </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">LOB</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <select class="form-control" name="companyLOB" id="companyLOB">
                        <option value="" disabled="disabled" selected="">Select LOB</option>
                        @foreach($lobs as $LOB)
                        <option  value="{{$LOB->id}}">{{$LOB->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Company Name</label>
            <div class="input-icon">
                <i class="fa fa-building"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Company Name" autocomplete="off" name="companyName" />
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Phone Number</label>
            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Phone Number" autocomplete="off" name="phone" />
            </div>
        </div> 
        <div class="form-group">
            <label class="mt-checkbox mt-checkbox-outline font-white">
                <input type="checkbox" autocomplete="off" name="tnc" /> I agree to the
                <a href="javascript:;" class="font-white sbold">Terms of Service </a> &
                <a href="javascript:;" class="font-white sbold">Privacy Policy </a>
                <span></span>
            </label>
            <div id="register_tnc_error"> </div>
        </div>
        <div class="form-actions text-center">
            <button type="submit" id="registerButton" class="btn btn-orange"> Proceed</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<script src="{{url('/js/auth/signup.js')}}"></script>
@endsection



