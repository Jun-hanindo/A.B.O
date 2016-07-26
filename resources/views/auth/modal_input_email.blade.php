<div class="modal fade login" id="modalInputEmail">
      <div class="modal-dialog login animated">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Input Your Email</h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <div class="box">
                    <div class="content registerBox">
                     <div class="form">
                        <form id="form-input-email">
                            <div class="form-group{{ Form::hasError('email') }} has-feedback">
                                {!! Form::text('email', null, ['id'=>'email','class' => 'form-control email', 'placeholder' => 'email']) !!}
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <input class="btn btn-default btn-register" type="button" value="Submit"  onclick="submitEmail()">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>        
          </div>
      </div>
</div>