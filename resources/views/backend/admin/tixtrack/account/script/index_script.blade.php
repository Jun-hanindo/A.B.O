@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();
        loadTextEditor();

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
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                ],
            });
            return table;
        }

        $('.actAdd').on('click',function(){
            $('#modal-form').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();
        });

        $('#accounts-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getAccount(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $("#button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();
            saveTrailModal('Account Tixtrack Form');

            function save()
            {
                modal_loader();
                var name = $("#name").val();
                var account_id = $("#account_id").val();
                $.ajax({
                    url: "{{ route('admin-post-tixtrack-account') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {'name':name,"account_id":account_id},
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
                
                var name = $("#name").val();
                var account_id = $("#account_id").val();
                var id = $("#id").val();
                modal_loader();
                var uri = "{{ URL::route('admin-update-tixtrack-account', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: {'name':name,"account_id":account_id},
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

        });

    });


    function getAccount(id){
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
                console.log(data);

                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#account_id").val(data.account_id);
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
    }
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection