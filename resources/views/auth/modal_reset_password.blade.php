<div class="modal fade login" id="modalResetPassword">
      <div class="modal-dialog login animated">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                    <form id="form-reset-password">
                        <div class="form-group{{ Form::hasError('email') }} has-feedback text">
                            {!! Form::text('email', null, ['id'=>'email','class' => 'form-control email', 'placeholder' => 'email']) !!}
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <input class="btn btn-danger btn-block" type="button" value="Submit"  onclick="submitResetPassword()">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>        
          </div>
      </div>
</div>
