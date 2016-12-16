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
        modal_loader();
        var title = $("#title").val();
        //var content = CKEDITOR.instances['content'].getData();
        var desktop_content = $("#desktop_content").val();
        var responsive_content = $("#responsive_content").val();

        var slug = $("#slug").val();
        var uri = "{{ URL::route('admin-post-update-manage-page', "::param") }}";
        uri = uri.replace('::param', slug);
        var newwindow = window.open('', '_blank');
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'title':title,"desktop_content":desktop_content,"responsive_content":responsive_content, "status":status},
            success: function (data) {
                        HoldOn.close();
                if(status != 'preview'){
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');  
                	location.reload();
                }else{
                    var url = "{{ URL::to('support/::slug?preview=true') }}";
                    url = url.replace('::slug', slug);
                    newwindow.location = url;
                    return false;
                }
            },
            error: function(response){
                        HoldOn.close();
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