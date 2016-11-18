@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();

        var driver = $("#mail_driver").val();
        hideShowField(driver);

        $("#mail_driver").on('change', function(){
            var driver = $(this).val();
            hideShowField(driver);
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