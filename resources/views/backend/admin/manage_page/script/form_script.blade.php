@section('scripts')

    <script>
    $(document).ready(function() {
        
        // loadTextEditor2();

        $("#button_draft2, #button_preview").unbind('click').bind('click', function () {
            var status = $(this).attr('data-status');
            if(status == ''){
                status = 'draft';
            }
            update(status);             
        });

    });

    function update(status)
    {
        
        var title = $("#title").val();
        //var content = CKEDITOR.instances['content'].getData();
        var content = $("#content").val();

        var slug = $("#slug").val();
        var uri = "{{ URL::route('admin-post-update-manage-page', "::param") }}";
        uri = uri.replace('::param', slug);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'title':title,"content":content, "status":status},
            success: function (data) {
                if(status != 'preview'){
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');  
                	location.reload();
                }
            },
            error: function(response){
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }
    
    </script>
@endsection