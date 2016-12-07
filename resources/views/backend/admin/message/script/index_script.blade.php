@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

        function loadData()
        {
            $.fn.dataTable.ext.errMode = 'none';
            $('#message-datatables').on('error.dt', function(e, settings, techNote, message) {
                $.ajax({
                    url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                    type: "POST",
                    dataType: 'json',
                    data: "message= Inbox "+message,
                    success: function (data) {
                        data.message;
                    },
                    error: function(response){
                        response.responseJSON.message
                    }
                });
            });

            var table = $('#message-datatables').DataTable();
            table.destroy();
            $('#message-datatables').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 2, 'desc' ]],
                ajax: '{!! URL::route("datatables-message") !!}',
                columns: [
                    // {data: 'id', name: 'id', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ],
            });

            return table;
        }

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection