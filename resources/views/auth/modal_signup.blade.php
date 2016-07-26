<!-- Modal LOGIN -->
<div class="modal fade login" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog login animated" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Welcome!</h4>
      <h5 class="modal-title tetle-head-footer" id="myModalLabel">Login to your account to start</h5>
    </div>
    <div class="modal-body">
        <div class="error"></div>
        <form id = "form-login">
            <div class="form-group{{ Form::hasError('email') }} has-feedback text">
                {!! Form::text('email', null, ['id'=>'email','class' => 'form-control email', 'placeholder' => 'Email']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group{{ Form::hasError('email') }} has-feedback text">
                {!! Form::password('password', ['id'=>'password','class' => 'form-control password', 'placeholder' => 'Password']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <input class="btn btn-danger btn-block" type="button" value="LOGIN" onclick="loginAjax()">
        </form>

        <form id="form-signup" style="display:none">
            <div class="form-group{{ Form::hasError('username') }} has-feedback text">
                {!! Form::text('username', null, ['id'=>'username','class' => 'form-control username block-space', 'placeholder' => 'Username','pattern'=>'[a-zA-Z0-9!@#$%^*_|]{6,25}']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group{{ Form::hasError('email') }} has-feedback text">
                {!! Form::text('email', null, ['id'=>'email','class' => 'form-control email', 'placeholder' => 'Email']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group{{ Form::hasError('password') }} has-feedback text">
                {!! Form::password('password', ['id'=>'password','class' => 'form-control password', 'placeholder' => 'Password']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group{{ Form::hasError('password') }} has-feedback text">
                {!! Form::password('password_confirmation', ['id'=>'password_confirmation','class' => 'form-control password', 'placeholder' => 'Retype Password']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="col-md-12">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('term') !!}
                        <span class="sign-text">By signing up, I agree to iLive <a href="" class="tos"> Terms of Service</a> <span class="sign-text">and</span> <a href="" class="tos">Privacy Policy</a></span>
                    </label>
                </div>
            </div>
            <input class="btn btn-danger btn-block" type="button" value="Create account"  onclick="signUpAjax()">
        </form>

    </div>
    <div class="divider-new">Sign In with</div>
    <div class="modal-footer">
        <a class="btn-sm fb-bg rectangle waves-effect waves-light" href="javascript:void(0)" onclick="loginFB()"><i class="fa fa-facebook"> </i></a>
        <a class="btn-sm tw-bg rectangle waves-effect waves-light" href="{{ route('redirect-socialmedia','twitter') }}"><i class="fa fa-twitter"> </i></a>
        <a class="btn-sm gplus-bg rectangle waves-effect waves-light" href="javascript:void(0)" id="google_login_1"><i class="fa fa-google-plus"> </i></a>
        <span class="sign-in sign-in-footer">Or sign up with <a href="javascript: showRegisterForm();"> your email address</a></span></br>
        <span class="sign-in register-footer" style="display:none">Already have an account?</span><a  href="javascript: showLoginForm();" class="register-footer" style="display:none"> Login</a></br>
        <span class="sign-in">Forgot password?</span><a href="javascript: showFormResetPassword();"> Reset Password</a>
    </div>
  </div>
</div>
</div>
@include("auth.script.modal_signup_script")