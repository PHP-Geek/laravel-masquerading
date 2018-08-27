@extends('./layouts.common')
@section('content')
<style>
    .has-error .help-block{
        color:#ff7f7f !important;
    }
   
    
</style>
<div class="content">
    <div class="margin-top-30"> 
        <div class="">
            <div class="text-center">
                <h3><i class="fa fa-lock fa-2x font-white"></i></h3>
                <h3 class="text-center font-white sbold">Recover Password</h3>


                <div class="panel-body">
                    <form id="forgotPasswordForm" role="form"  class="form" method="post" action="">
			{{csrf_field()}}
                        <div class="form-group">
			    <div class="input-group input-icon right">
				<span class="input-group-addon">
				    <i class="fa fa-lock"></i>
				</span>
                                
                               <input id="newPassword" name="newPassword" placeholder="New Password" class="form-control font-dark placeholder-no-fix"  type="password"><i class="fa fa-question-circle" style="color:green;cursor: pointer;" data-placement="left" data-toggle="popover" data-content="Password must be atleast 8 characters and maximum 14 characters, minimum one uppercase and one lowercase character, minimum one digit and one special character."></i> 
                            </div>
                        </div>
			<div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon border-left-none"><i class="fa fa-lock color-blue"></i></span>
                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control"  type="password">
                            </div>
                        </div>
                        <div class="form-group">
			    <button type="submit" id="registerButton" class="btn green btn-block"> Proceed</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/auth/recover.js') }}"></script>
@endsection
