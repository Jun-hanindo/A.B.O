@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();
        loadTextEditor();
        loadSwitchButton('symbol_position');

        function loadData()
        {
            $.fn.dataTable.ext.errMode = 'none';
            $('#currencies-table').on('error.dt', function(e, settings, techNote, message) {
                $.ajax({
                    url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                    type: "POST",
                    dataType: 'json',
                    data: "message= Currency "+message,
                    success: function (data) {
                        data.message;
                    },
                    error: function(response){
                        response.responseJSON.message
                    }
                });
            });

            var table = $('#currencies-table').DataTable();
            table.destroy();
            $('#currencies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-currency") !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'code', name: 'code'},
                    {data: 'symbol_left', name: 'symbol_left'},
                    {data: 'symbol_right', name: 'symbol_right'},
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

        $('#currencies-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataCurrency(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $("#button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();
            saveTrailModal('Currency Form');

            function save()
            {
                modal_loader();
                var name = $("#name").val();
                $.ajax({
                    url: "{{ route('admin-post-currency') }}",
                    type: "POST",
                    dataType: 'json',
                    data: $('#form').serialize(),
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
                
                var id = $("#id").val();
                modal_loader();
                var uri = "{{ URL::route('admin-update-currency', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: $('#form').serialize(),
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


        function getDataCurrency(id){
            var uri = "{{ URL::route('admin-edit-currency', "::param") }}";
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
                    $("#title").val(data.title);
                    $("#code").val(data.code);
                    if(data.symbol_left != ''){
                        var symbol = data.symbol_left;
                        $(".symbol_position").bootstrapSwitch('state', true); 
                    }else{
                        var symbol = data.symbol_right;
                        $(".symbol_position").bootstrapSwitch('state', false); 
                    }
                    $("#symbol").val(symbol);
                },
                error: function(response){
                    loadData();
                    $('#modal-form').modal('hide');
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
            });
        }

        function clearInput(){
            $("#title").val('');
            $("#code").val('');
            $("#symbol").val('');
            $(".symbol_position").bootstrapSwitch('state', true); 
        }

    });
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection