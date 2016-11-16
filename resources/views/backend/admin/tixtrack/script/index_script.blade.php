@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadDataMember();
        loadDataTransaction();

        $('#account_id_member').on('change', function () {
            loadDataMember();
        });

        $('#account_id_order').on('change', function () {
            loadDataTransaction();
        });

    });

    function loadDataMember()
    {
        var account_id = $('select[name=account_id_member]').val();
        $.fn.dataTable.ext.errMode = 'none';
        $('#member-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Tixtrack Member "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#member-datatables').DataTable();
        table.destroy();
        $('#member-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-tixtrack-member") !!}',
                data: {
                    'account_id': account_id,
                }
            },
            columns: [
                {data: 'customer_id', name: 'customer_id'},
                {data: 'email', name: 'email'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
    }

    function loadDataTransaction()
    {
        var account_id = $('select[name=account_id_order]').val();

        $.fn.dataTable.ext.errMode = 'none';
        $('#transaction-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Tixtrack Transaction "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#transaction-datatables').DataTable();
        table.destroy();
        $('#transaction-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-tixtrack-transaction") !!}',
                data: {
                    'account_id': account_id,
                }
            },
            columns: [
                {data: 'order_id', name: 'order_id'},
                {data: 'event_name', name: 'event_name'},
                {data: 'customer', name: 'customer'},
                {data: 'price', name: 'price'},
                // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
    }

    </script>
    @include('backend.delete-modal-datatables')
@endsection