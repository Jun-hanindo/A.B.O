@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();

        function loadData()
        {
            var table = $('#users-table').DataTable();
            table.destroy();
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-user") !!}',
                columns: [
                    {data: 'id', name: 'users.id'},
                    {data: 'username', name: 'users.username'},
                    {data: 'email', name: 'users.email'},
                    {data: 'name', name: 'name'},
                    {data: 'role', name: 'roles.name'},
                    {data: 'deleted', name: 'users.deleted',sClass: 'center-align',},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        }

        $('[data-tables=true]').on('click', '[data-button=restore]', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).data('name');
            $("#p-delete").hide();
            $("#p-restore").show();
            $('#form-destroy').attr('action', '{{ Request::url() }}/'+id+'/restore');
            $('#form-destroy').attr('method', 'post');
            $('#delete-modal').modal('show');
            $(".name").html(name);
            e.preventDefault();
        });

        $('[data-tables=true]').on('click', '[data-button=delete]', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).data('name');
            $("#p-restore").hide();
            $("#p-delete").show();
            $('#form-destroy').attr('action', '{{ Request::url() }}/'+id+'/delete');
            $('#form-destroy').attr('method', 'delete');
            $('#delete-modal').modal('show');
            $(".name").html(name);
            e.preventDefault();
        });
    });
    </script>
@endsection