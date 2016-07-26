@section('script')
<script type="text/javascript">

    function showFormResetPassword(){
        $("#loginModal").modal('hide');
        $('#modalResetPassword').modal('show');
        $('.modal-title').html('Reset Password');
        $('.error').removeClass('alert alert-danger').html('');
    }

    function submitChangePassword() {
        modal_loader();
        clearNotice();
        $.ajax({
            url: "{{ route('change-password') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form-change-password").serialize(),
            success: function (data) {
                HoldOn.close();
                $('#modalChangePassword').modal('hide');
                openLoginModal();
                $('.error').addClass('alert alert-success').html(data.message);    
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('.'+key));
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
                shakeModal();
            }
        });
    }

    function showRegisterForm(){
        $(".tooltip-field").remove();
        $('#form-login').fadeOut('fast',function(){
            $('#form-signup').fadeIn('fast');
            $('.sign-in-footer').fadeOut('fast',function(){
                $('.register-footer').fadeIn('fast');
            });
            $('.tetle-head-footer').html('Create Account one more step to start using iLive');
        }); 
        $('.error').removeClass('alert alert-danger').html('');
           
    }
    function showLoginForm(){
        $(".tooltip-field").remove();
        $('#form-signup').fadeOut('fast',function(){
            $('#form-login').fadeIn('fast');
            $('.register-footer').fadeOut('fast',function(){
                $('.sign-in-footer').fadeIn('fast');    
            });
            
            $('.tetle-head-footer').html('Login to your account to start');
        });       
         $('.error').removeClass('alert alert-danger').html(''); 
    }

    function openLoginModal(){
        showLoginForm();
        setTimeout(function(){
            $('#loginModal').modal('show');    
        }, 230);
        
    }
    function openRegisterModal(){
        showRegisterForm();
        setTimeout(function(){
            $('#loginModal').modal('show');    
        }, 230);
        
    }

    function loginAjax(){
        modal_loader();
        clearNotice();
        $.ajax({
            url: "{{ route('post-login') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form-login").serialize(),
            success: function (data) {
                HoldOn.close();
                location.replace("{{ route('/') }}");
                
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('.'+key));
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
                shakeModal();
            }
        });
    };

    function clearNotice(){
        $('.error').removeClass('alert alert-danger').html('');
        $('.error').removeClass('alert alert-success').html('');
        $(".tooltip-field").remove();
    }

    function clearForm(){
        $("#form-signup").find("input[type=text], password").val("");
        $("#form-login").find("input[type=text], password").val("");
    }

    function signUpAjax(){
        modal_loader();
        clearNotice();
        $.ajax({
            url: "{{ route('post-signup') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form-signup").serialize(),
            success: function (data) {
                HoldOn.close();
                showLoginForm();
                $('input[type="password"]').val('');
                $('.error').addClass('alert alert-success').html(data.message);
                
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('.'+key));
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
                shakeModal();
            }
        });
    }

    function shakeModal(){
        // $('#loginModal .modal-dialog').addClass('shake');
        $('.modal-dialog').addClass('shake');
        
        $('input[type="password"]').val('');
        setTimeout( function(){ 
            $('#loginModal .modal-dialog').removeClass('shake'); 
        }, 500 ); 
    }

    function submitResetPassword(){
        modal_loader();
        clearNotice();
        $.ajax({
            url: "{{ route('reset-password') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form-reset-password").serialize(),
            success: function (data) {
                HoldOn.close();
                $('.error').addClass('alert alert-success').html(data.message);
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('.'+key));
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
                shakeModal();
            }
        });
    }

    function submitEmail(){
        modal_loader();
        clearNotice();
        $.ajax({
            url: "{{ route('submit-email') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form-input-email").serialize(),
            success: function (data) {
                HoldOn.close();
                showLoginForm();
                location.replace("{{ route('/') }}");
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('.'+key));
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
                shakeModal();
            }
        });
    }

</script>
@endsection
   