@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();

        function loadData()
        {
            var table = $('#hastags-table').DataTable();
            table.destroy();
            $('#hastags-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-hastag") !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'active', name: 'active'},
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

        $('#hastags-table tbody').on( 'click', '.actEdit', function () {
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataHastag(id);

        } );

        $('#modal-form').on('show.bs.modal', function (e) {
            clearInput();
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');

            $("#button_save").unbind('click').bind('click', function () {
                saveHastag();                
            });
            $("#button_update").unbind('click').bind('click', function () {
                updateHastag();                
            });

            $("#name").on('change',function(){
                var str = $(this).val();
                $("#slug").val(slug(str));
            });

            function saveHastag()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error').removeClass('alert alert-danger');
                $('.error').html('');
                modal_loader();
                $.ajax({
                    url: "{{ route('admin-post-hastag') }}",
                    type: "POST",
                    dataType: 'json',
                    data: $("#form").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadData();
                        $('#modal-form').modal('hide');
                        $('.error').addClass('alert alert-success').html(data.message);
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
                            $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }

            function updateHastag()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error').removeClass('alert alert-danger');
                $('.error').html('');
                var id = $("#id").val();
                modal_loader();
                $.ajax({
                    url: "{{ URL::to('admin/master/hastag')}}"+'/'+id+'/update',
                    type: "POST",
                    dataType: 'json',
                    data: $("#form").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadData();
                        $('#modal-form').modal('hide');
                        $('.error').addClass('alert alert-success').html(data.message);
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
                            $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }

        });

        function clearInput(){
            $("#name").val('');
            $("#slug").val('');
        }

        function getDataHastag(id){
            $.ajax({
                    url: "{{ URL::to('admin/master/hastag')}}"+'/'+id+'/edit',
                    type: "get",
                    dataType: 'json',
                    success: function (response) {
                        if(response.data.active == false) {
                            response.data.active = 'false';
                        } else {
                            response.data.active = 'true';
                        }
                        $.each(response.data,function(key,val){
                            $('#'+key).val(val);
                        });
                    },
                    error: function(response){
                        loadData();
                        $('#modal-form').modal('hide');
                        $('.error').addClass('alert alert-success').html(response.responseJSON.message);
                    }
                });
        }

    });
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection