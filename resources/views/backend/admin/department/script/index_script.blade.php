@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#departments-table').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Department "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#departments-table').DataTable();
        table.destroy();
        $('#departments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-department") !!}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'avaibility', name: 'avaibility', class: 'center-align', searchable: false, orderable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                $(".avaibility-check").bootstrapSwitch({onText: "{{ trans('backend/general.enabled') }}", offText:"{{ trans('backend/general.disabled') }}", animate: false});
            }
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
        $.ajax({
            url: "{{ route('admin-post-department') }}",
            type: "POST",
            dataType: 'json',
            data: {'name':name},
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

    function update()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        
        var name = $("#name").val();
        var id = $("#id").val();
        modal_loader();
        var uri = "{{ URL::route('admin-update-department', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'name':name},
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


    function getDataDepartment(id){
        var uri = "{{ URL::route('admin-edit-department', "::param") }}";
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
    }
    
    $(document).ready(function() {
        
        loadData();
        loadTextEditor();

        $('#departments-table').on('switchChange.bootstrapSwitch', '.avaibility-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-department-avaibility', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: "avaibility="+val,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    loadData();
                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

        $('.actAdd').on('click',function(){
            $('#modal-form').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();
        });

        $('#departments-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataDepartment(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            
            $("#button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();
            saveTrailModal('Department Form');

        });

    });
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection