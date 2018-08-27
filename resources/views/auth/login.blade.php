@extends('./layouts.common')
@section('content')
<style>
    .has-error .help-block{
        color:#ff7f7f !important;
    }
    .login .content .input-icon {
        border-left: 0!important;
    }
</style>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form " id="user_login_form" action="" method="post">
        {{csrf_field()}}
        <h3 class="form-title sbold font-white text-center">Login to your account</h3>
        <div id="error" class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span></span>
        </div>
        <div id="success" class="alert alert-success display-hide">
            <span>Login Succcessful. Redirecting...</span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon border-left">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username/Email" id="user_login" name="user_login" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon border-left">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="user_login_password" id="user_login_password" /> </div>
        </div>
        <div class="form-actions">
            <label class="rememberme mt-checkbox mt-checkbox-outline">
                <input type="checkbox" id="remember" name="remember" value="1" /><h4 class="font-white margin-top-0 sbold">Remember me</h4>
                <span></span>
            </label>
            <button type="submit" class="btn btn-orange pull-right"> Login </button>
        </div>
        <div class="forget-password">
            <h4><a class="font-white sbold"  href="{{url('/forgot-password')}}">Forgot Password?</a></h4>

            <p class="font-white"> no worries, click
                <a href="{{url('/forgot-password')}}" id="forget-password" class="font-white sbold"> here </a> to reset your password. </p>
        </div>
        <div class="create-account">
            <p class="font-white"> Don't have an account yet ?&nbsp;
                <a href="{{url('/signup')}}" id="register-btn btn-orange" class="font-white sbold"> Create an account </a>
            </p>
        </div>
    </form>


</div>
<script src="{{ url('assets/global/plugins/md5.min.js') }}"></script>
<script src="{{ url('assets/global/plugins/base64.min.js') }}"></script>
<script src="{{ url('js/auth/login.js') }}"></script>
@endsection