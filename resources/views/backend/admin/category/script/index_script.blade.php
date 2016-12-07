@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();
        loadTextEditor();

        $('#categories-table').on('switchChange.bootstrapSwitch', '.avaibility-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-category-avaibility', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: "avaibility="+val,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

        $('#categories-table').on('switchChange.bootstrapSwitch', '.status-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-category-status', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: "status="+val,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

        $('.actAdd').on('click',function(){
            $('#modal-form-cat').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();
        });

        $('#categories-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form-cat').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataEventCategory(id);

        });


        $('#modal-form-cat').on('show.bs.modal', function (e) {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            
            $("#button_save-cat").unbind('click').bind('click', function () {
                saveCat();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                updateCat();                
            });
            clearInputCat();
            saveTrailModal('Category Form');

        });

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#categories-table').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Category "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#categories-table').DataTable();
        table.destroy();
        $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-event-category") !!}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'avaibility', name: 'avaibility', class: 'center-align', searchable: false, orderable: false},
                {data: 'status', name: 'status', class: 'center-align', searchable: false, orderable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                $(".avaibility-check").bootstrapSwitch({onText: "{{ trans('backend/general.show') }}", offText:"{{ trans('backend/general.off') }}", animate: false});
                $(".status-check").bootstrapSwitch({onText: "{{ trans('backend/general.active') }}", offText:"{{ trans('backend/general.inactive') }}", animate: false});
            }
        });
        return table;
    }

    function updateCat()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        
        var name = $("#name-cat").val();
        var icon = $("#icon-cat").val();
        var description = $("#description-cat").val();
        var id = $("#id-cat").val();
        modal_loader();
        var uri = "{{ URL::route('admin-update-event-category', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: {'name':name,"description":description,"icon":icon},
            success: function (data) {
                HoldOn.close();
                loadData();
                $('#modal-form-cat').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');  
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        if(key == "description"){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#cke_'+key+'-cat'));
                        }else{
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key+'-cat'));
                        }
                        $('.'+key+'-cat').addClass('has-error');
                    });
                } else {
                    $('.error-modal-cat').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function getDataEventCategory(id){
        var uri = "{{ URL::route('admin-edit-event-category', "::param") }}";
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

                $("#id-cat").val(data.id);
                $("#name-cat").val(data.name);
                $("#icon-cat").val(data.icon);
                $('#icon-cat').selectpicker('val', data.icon);
                $("#description-cat").val(data.description);
            },
            error: function(response){
                loadData();
                $('#modal-form-cat').modal('hide');
                $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }
    
    </script>
    @include('backend.admin.category.script.save_script')
    @include('backend.delete-modal-datatables')
@endsection