@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();
        loadTinyMce();

        function loadData()
        {
            var table = $('#event-categories-table').DataTable();
            table.destroy();
            $('#event-categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-event-category") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        }

        $('.actAdd').on('click',function(){
            $('#modal-form').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();
        });

        $('#event-categories-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataEventCategory(id);

        });


        $('#modal-form').on('show.bs.modal', function (e) {
            $("#button_save").unbind('click').bind('click', function () {
                save();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                update();                
            });
            clearInput();

            function save()
            {
                modal_loader();
                var name = $("#name").val();
                var icon = $("#icon").val();
                var description = tinyMCE.get('description').getContent();
                $.ajax({
                    url: "{{ route('admin-post-event-category') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {'name':name,"description":description,"icon":icon},
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
                
                var name = $("#name").val();
                var icon = $("#icon").val();
                var description = tinyMCE.get('description').getContent();
                var id = $("#id").val();
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

                    $("#id").val(data.id);
                    $("#name").val(data.name);
                    $("#icon").val(data.icon);
                    tinyMCE.get('description').setContent(data.description);
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
            $("#icon").val('');
            $("#id").val('');
            tinyMCE.get('description').setContent('');
        }

    });
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection