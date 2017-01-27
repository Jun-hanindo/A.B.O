@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();

        $('.image').change(function(){
            var name = $(this).attr('data-name');
            $("#div-preview_"+name).show();
            preview(this,$(this).data('type'),name);
        });

        $('.delete-visa_banner_image_mobile, .delete-visa_banner_image').on('click', function () {
            $('#delete-modal2').modal('show');
            var name = $(this).attr('data-name');
            var value = $(this).attr('data-value');
            var title = $(this).attr('data-title');

            $('#delete-modal2 .continue-delete').attr('data-name', name);
            $('#delete-modal2 .continue-delete').attr('data-value', value);
            $('#delete-modal2 #name').html(title);
        });

        $('#delete-modal2').on('click', '.continue-delete', function () {
            var name = $(this).attr('data-name');
            var value = $(this).attr('data-value');
            var uri = "{{ URL::route('admin-delete-setting-image', "::param") }}";
            uri = uri.replace('::param', name);
            modal_loader();
            $.ajax({
                url: uri,
                type: "DELETE",
                dataType: 'json',
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    
                    $('#'+name).val('');
                    $('#div-preview_'+name+' img').attr('src', '');
                    $('.delete-'+name).remove();
                    HoldOn.close();

                },
                error: function(response){
                    HoldOn.close();
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

    });

    function hideShowField(driver){
        
        if(driver == 'smtp'){
            $('#div_mail_host').show();
            $('#div_mail_port').show();
            $('#div_mail_username').show();
            $('#div_mail_password').show();
            $('#div_mail_encryption').show();
            //$('#div_mail_name').show();
            $('#div_mail_domain').hide();
            $('#div_mail_secret').hide();
            $('#div_mail_key').hide();
            $('#div_mail_region').hide();
        }else if(driver == 'mailgun'){
            $('#div_mail_host').show();
            $('#div_mail_port').show();
            $('#div_mail_username').show();
            $('#div_mail_password').show();
            $('#div_mail_encryption').show();
            //$('#div_mail_name').show();
            $('#div_mail_domain').show();
            $('#div_mail_secret').show();
            $('#div_mail_key').hide();
            $('#div_mail_region').hide();
        }else if(driver == 'mandrill'){
            $('#div_mail_host').show();
            $('#div_mail_port').show();
            $('#div_mail_username').show();
            $('#div_mail_password').show();
            $('#div_mail_encryption').show();
            //$('#div_mail_name').hide();
            $('#div_mail_domain').hide();
            $('#div_mail_secret').show();
            $('#div_mail_key').hide();
            $('#div_mail_region').hide();
        }else if(driver == 'ses'){
            $('#div_mail_host').show();
            $('#div_mail_port').show();
            $('#div_mail_username').show();
            $('#div_mail_password').show();
            $('#div_mail_encryption').show();
            //$('#div_mail_name').show();
            $('#div_mail_domain').hide();
            $('#div_mail_secret').show();
            $('#div_mail_key').show();
            $('#div_mail_region').show();
        }else if(driver == 'sparkpost'){
            $('#div_mail_host').show();
            $('#div_mail_port').show();
            $('#div_mail_username').show();
            $('#div_mail_password').show();
            $('#div_mail_encryption').show();
            //$('#div_mail_name').show();
            $('#div_mail_domain').hide();
            $('#div_mail_secret').show();
            $('#div_mail_key').hide();
            $('#div_mail_region').hide();
        }else{
            $('#div_mail_host').hide();
            $('#div_mail_port').hide();
            $('#div_mail_username').hide();
            $('#div_mail_password').hide();
            $('#div_mail_encryption').hide();
            //$('#div_mail_name').show();
            $('#div_mail_domain').hide();
            $('#div_mail_secret').hide();
            $('#div_mail_key').hide();
            $('#div_mail_region').hide();
        }
    }
    
    </script>
@endsection