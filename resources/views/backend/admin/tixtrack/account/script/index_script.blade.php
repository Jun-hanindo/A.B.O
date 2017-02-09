@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();
        loadLoginData();
        getLoginCombo();

        $('.actAdd').on('click',function(){
            $('#modal-form').modal('show');
            $('#modal-form #title-create').show();
            $('#modal-form #title-update').hide();
            $('#modal-form #button_update').hide();
            $('#modal-form #button_save').show();
        });

        $('#accounts-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#modal-form #title-create').hide();
            $('#modal-form #title-update').show();
            $('#modal-form #button_update').show();
            $('#modal-form #button_save').hide();

            var id = $(this).data('id');
            getAccount(id);

        });

        $('.actAddLogin').on('click',function(){
            $('#modal-login-form').modal('show');
            $('#modal-login-form #title-create').show();
            $('#modal-login-form #title-update').hide();
            $('#modal-login-form #button_update').hide();
            $('#modal-login-form #button_save').show();
        });

        $('#login-accounts-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-login-form').modal('show');
            $('#modal-login-form #title-create').hide();
            $('#modal-login-form #title-update').show();
            $('#modal-login-form #button_update').show();
            $('#modal-login-form #button_save').hide();

            var id = $(this).data('id');
            getLoginAccount(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            $("#modal-form #button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#modal-form #button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();
            saveTrailModal('Account Tixtrack Form');

        });


        $('#modal-login-form').on('show.bs.modal', function (e) {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            $("#modal-login-form #button_save").unbind('click').bind('click', function () {
                saveLogin();                
            });
            $("#modal-login-form #button_update").unbind('click').bind('click', function () {
                updateLogin();                
            });
            clearInputLogin();
            saveTrailModal('Login Account Tixtrack Form');

        });

        $('#login-accounts-table tbody').on( 'click', '.actDeleteLogin', function (e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var uri = "{{ URL::route('admin-delete-tixtrack-login-account', "::param") }}";
            uri = uri.replace('::param', id);
            $('#destroy').attr('action', uri);
            
            $('#delete-modal').modal('show');
            $("#delete-modal #name").html(name);
            e.preventDefault();

        });

        // $('#login-accounts-table tbody').on( 'click', '.actDeleteLogin', function () {
        //     $('#delete-modal2').modal('show');
        //     var name = $(this).attr('data-id');
        //     var val = $(this).attr('data-value');

        //     $('#delete-modal2 .continue-delete').attr('data-id', name);
        //     $('#delete-modal2 .continue-delete').attr('data-value', val);

        // });

        // $('#delete-modal2').on('click', '.continue-delete', function () {
        //     var id = $(this).attr('data-id');
        //     var uri = "{{ URL::route('admin-delete-tixtrack-login-account', "::param") }}";
        //     uri = uri.replace('::param', id);
        //     $.ajax({
        //         url: uri,
        //         type: "DELETE",
        //         success: function (data) {
        //             $('.error-login-account').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
        //             //loadLoginData();
        //             location.reload();
        //         },
        //         error: function(response){
        //             $('.error-login-account').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
        //             loadLoginData();
        //             // location.reload();
                    
        //         }
        //     }); 
        // });

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#accounts-table').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Account Tixtrack "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#accounts-table').DataTable();
        table.destroy();
        $('#accounts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-tixtrack-account") !!}',
            columns: [
                {data: 'account_id', name: 'account_id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });
        return table;
    }

    function loadLoginData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#accounts-table').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Login Account Tixtrack "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#login-accounts-table').DataTable();
        table.destroy();
        $('#login-accounts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-tixtrack-login-account") !!}',
            columns: [
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });
        return table;
    }

    function save()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        var name = $("#name").val();
        var account_id = $("#account_id").val();
        var login_account_id = $("#login_account_id").val();
        $.ajax({
            url: "{{ route('admin-post-tixtrack-account') }}",
            type: "POST",
            dataType: 'json',
            data: {'name':name,"account_id":account_id,"login_account_id":login_account_id},
            success: function (data) {
                HoldOn.close();
                loadData();
                $('#modal-form').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.form-group.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function update()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        
        var name = $("#name").val();
        var account_id = $("#account_id").val();
        var login_account_id = $("#login_account_id").val();
        var id = $("#id").val();
        modal_loader();
        var uri = "{{ URL::route('admin-update-tixtrack-account', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'name':name,"account_id":account_id,"login_account_id":login_account_id},
            success: function (data) {
                HoldOn.close();
                loadData();
                $('#modal-form').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');  
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


    function getAccount(id){
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var uri = "{{ URL::route('admin-edit-tixtrack-account', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.data.active == false) {
                    response.data.active = 'false';
                } else {
                    response.data.active = 'true';
                }
                var data = response.data;
                

                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#account_id").val(data.account_id);
                $("#login_account_id").select2('data', { id:data.login_account_id, text: data.email});
            },
            error: function(response){
                loadData();
                $('#modal-form').modal('hide');
                $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }

    function clearInput(){
        $("#name").val('');
        $("#id").val('');
        $("#account_id").val('');
        $("#login_account_id").select2("val", "");
    }



    function saveLogin()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            url: "{{ route('admin-post-tixtrack-login-account') }}",
            type: "POST",
            dataType: 'json',
            data: {'email':email,"password":password},
            success: function (data) {
                HoldOn.close();
                loadLoginData();
                $('#modal-login-form').modal('hide');
                $('.error-login-account').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.form-group.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-login-account').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function updateLogin()
    {
        
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var email = $("#email").val();
        var password = $("#password").val();
        var id = $("#id_login").val();
        modal_loader();
        var uri = "{{ URL::route('admin-update-tixtrack-login-account', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'email':email,"password":password},
            success: function (data) {
                HoldOn.close();
                loadLoginData();
                loadData();
                $('#modal-login-form').modal('hide');
                $('.error-login-account').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');  
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
                    $('.error-login-account').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }


    function getLoginAccount(id){
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var uri = "{{ URL::route('admin-edit-tixtrack-login-account', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.data.active == false) {
                    response.data.active = 'false';
                } else {
                    response.data.active = 'true';
                }
                var data = response.data;
                
                $("#id_login").val(data.id);
                $("#email").val(data.email);
                $("#password").val(data.password);
            },
            error: function(response){
                loadLoginData();
                $('#modal-login-form').modal('hide');
                $('.error-login-account').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }

    function clearInputLogin(){
        $("#email").val('');
        $("#id_login").val('');
        $("#password").val('');
    }

    function getLoginCombo()
    {

        var uri = "{{route('admin-list-combo-tixtrack-login-account')}}";

        $("#login_account_id").select2({
            ajax: {
                url: uri,
                dataType: 'json',
                type: "get",
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {
                    return { results: data.results };
                },

            },
            initSelection: function (item, callback) {
                var id = item.val();
                var text = item.data('option');
                if(id > 0){

                    var data = { id: id, text: text };
                    callback(data);
                }
            },
            formatAjaxError:function(a,b,c){return"Not Found .."}
        });
    }
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection