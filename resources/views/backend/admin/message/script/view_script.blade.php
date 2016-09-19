@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();

        $('#button_reply').on('click', function(){
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
        	$('#reply-message').show();
        	$('#button_reply').hide();
        	$('#button_send').show();
        });

        $('#button_send').on('click', function(){
        	sendReplyMessage();
        });

    });

    function sendReplyMessage()
    {

        $.ajax({
            url: "{{ route('admin-post-reply-message') }}",
            type: "POST",
            dataType: 'json',
            data: $('#form-reply').serialize(),
            success: function (response) {
            	var data = response.data;
            	var html = '<div class="box-footer">'
                    +'<div class="date text-right">'+data.date+'</div>'
                    +'<label for="reply_by" class="col-sm-3 control-label">'+data.reply_by_label+'</label>'
                    +'<div class="col-sm-9">'
                        +'<div class="form-control no-border nopadding">: '+data.user_name+'</div>'
                    +'</div>'
                    +'<label for="message" class="col-sm-3 control-label">'+data.message_label+'</label>'
                    +'<div class="col-sm-9">'
                        +'<div class="form-control no-border nopadding">: '+data.message+'</div>'
                    +'</div>'
                +'</div>';


                $(".list-reply").append(html);
	        	
	        	$('#reply-message').hide();
	        	$('#button_reply').show();
	        	$('#button_send').hide();
	        	$('#message').val('');
            },
            error: function(response){
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.form-group.'+key).addClass('has-error');
                    });
                } else {
                    $('.error').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }
    
    </script>
@endsection