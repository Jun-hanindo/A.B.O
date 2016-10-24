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
            $('#promoters-table').on('error.dt', function(e, settings, techNote, message) {
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

            var table = $('#promoters-table').DataTable();
            table.destroy();
            $('#promoters-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-promoter") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'country', name: 'country'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                ],
                "fnDrawCallback": function() {
                    //Initialize checkbos for enable/disable user
                    $(".avaibility-check").bootstrapSwitch({onText: "Show", offText:"Off", animate: false});
                    $(".status-check").bootstrapSwitch({onText: "Active", offText:"Inactive", animate: false});
                }
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

        $('#promoters-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getPromoter(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $("#button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();
            saveTrailModal('Promoter Form');

            function save()
            {
                modal_loader();
                var name = $("#name").val();
                var country = $("#country").val();
                var address = $("#address").val();
                $.ajax({
                    url: "{{ route('admin-post-promoter') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {'name':name,"address":address,"country":country},
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
                var country = $("#country").val();
                var address = $("#address").val();
                var id = $("#id").val();
                modal_loader();
                var uri = "{{ URL::route('admin-update-promoter', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: {'name':name,"address":address,"country":country},
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

        $("#country").select2({
            ajax: {
                url: "{{route('list-combo-country')}}",
                dataType: 'json',
                type: "POST",
                data: function (term, page) {
                    return {
                        type: 'country',
                        q: term
                    };
                },
                results: function (data, page) {
                    return { results: data.results };
                }

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

    });


    function getPromoter(id){
        var uri = "{{ URL::route('admin-edit-promoter', "::param") }}";
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
                $("#address").val(data.address);
                $("#country").select2('data', { id:data.country_id, text: data.country_name});
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
        $("#country").select2("val", "");
        $("#id").val('');
        $("#address").val('');
    }
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection