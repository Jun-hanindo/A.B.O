<div class="modal fade login" id="modalChangePassword">
      <div class="modal-dialog login animated">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change New Password</h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <form id="form-change-password">
                    @if(session()->get('codereset') && session()->get('useridreset'))
                      {!! Form::hidden('user_id', session()->get('useridreset')) !!}
                      {!! Form::hidden('code', session()->get('codereset')) !!}
                    @endif
                    <div class="form-group{{ Form::hasError('password') }} has-feedback text">
                        {!! Form::password('password', ['id'=>'password','class' => 'form-control password', 'placeholder' => 'New Password']) !!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group{{ Form::hasError('password') }} has-feedback text">
                        {!! Form::password('password_confirmation', ['id'=>'password_confirmation','class' => 'form-control password', 'placeholder' => 'Retype New Password']) !!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <input class="btn btn-default btn-block" type="button" value="Submit"  onclick="submitChangePassword()">
                </form>
            </div>
            <div class="modal-footer">
            </div>        
          </div>
      </div>
</div>