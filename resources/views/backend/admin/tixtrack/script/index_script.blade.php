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

        $('#account_id_order, #order_status, #order_item_type').on('change', function () {
            loadDataTransaction();
        });

        //var current_date = "{{ date('Y-m-d') }}";

        var start_date = $('input[name=local_created]').val();
        var end_date = $('input[name=end_date]').val();

        $('#local_created').datepicker({
            format: "yyyy-mm-dd",
            endDate: end_date,
        }).on('changeDate', function(){
            $('#end_date').datepicker('setStartDate', new Date($('#local_created').val()));
            loadDataTransaction();
        });

        $('#end_date').datepicker({
            format: "yyyy-mm-dd",
            startDate: start_date,
            endDate: end_date,
        }).on('changeDate', function(){
            $('#local_created').datepicker('setEndDate', new Date($('#end_date').val()));
            loadDataTransaction();
        });

        $('#local_created, #end_date').on('keyup', function () {
            loadDataTransaction();
        });

        $('#customer_id, #first_name, #last_name, #email').on('keyup', function () {
            loadDataMember();
        });

    });

    function loadDataMember()
    {
        var account_id = $('select[name=account_id_member]').val();
        var email = $('input[name=email]').val();
        var first_name = $('input[name=first_name]').val();
        var last_name = $('input[name=last_name]').val();
        var customer_id = $('input[name=customer_id]').val();
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
                    'customer_id': customer_id,
                    'first_name': first_name,
                    'last_name': last_name,
                    'email': email,
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
        var order_status = $('select[name=order_status]').val();
        var order_item_type = $('select[name=order_item_type]').val();
        var local_created = $('input[name=local_created]').val();
        var end_date = $('input[name=end_date]').val();

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
            order: [[ 0, 'desc' ]],
            ajax: {
                url: '{!! URL::route("datatables-tixtrack-transaction") !!}',
                data: {
                    'account_id': account_id,
                    'order_status': order_status,
                    'order_item_type' : order_item_type,
                    'local_created' : local_created,
                    'end_date' : end_date,
                }
            },
            columns: [
                {data: 'order_id', name: 'order_id'},
                {data: 'local_created', name: 'local_created', searchable: false},
                {data: 'event_name', name: 'event_name'},
                {data: 'customer', name: 'customer'},
                {data: 'price', name: 'price'},
                {data: 'order_status', name: 'order_status'},
                {data: 'order_item_type', name: 'order_item_type'},
                {data: 'seat_id', name: 'seat_id'},
                // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
    }

    </script>
    @include('backend.delete-modal-datatables')
@endsection