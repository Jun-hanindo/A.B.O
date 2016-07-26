<div id="delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                    <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;{!! Form::submit('Continue', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[data-tables=true]').on('click', '[data-button=delete]', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).data('name');
            $('#destroy').attr('action', '{{ Request::url() }}/'+id+'/delete');
            $('#delete-modal').modal('show');
            $("#name").html(name);
            e.preventDefault();
        });
    });
</script>
