@extends('./layouts.common')
@section('content')
<style>
    .has-error .help-block{
        color:#ff7f7f !important;
    }
</style>
<div class="content">
    <div class=" margin-top-30"> 
        <div class="">
            <div class="text-center">
                <h3><i class="fa fa-lock fa-2x font-white"></i></h3>
                <h3 class="text-center font-white sbold">Forgot Password?</h3>

                <p class="font-white">You can reset your password here.</p>
                <div class="panel-body">
                    <form id="forgotPasswordForm" role="form"  class="form" method="post" action="">
			{{csrf_field()}}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope color-blue"></i></span>
                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                            </div>
                        </div>
                        <div class="form-group">
			    <button type="submit" id="registerButton" class="btn btn-orange btn-block"> Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/auth/forgotPassword.js') }}"></script>
@endsection
