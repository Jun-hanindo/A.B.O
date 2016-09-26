@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        var subscription_id = $('#subscription_id').val();
        loadData(subscription_id);

    });

    function loadData(subscription_id)
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#event-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Subscription Event "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#event-datatables').DataTable();
        table.destroy();
        $('#event-datatables').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                bLengthChange: false,
                ajax: {
                    url: '{!! URL::route("datatables-subscription-event") !!}',
                    data: {
                        'subscription_id': subscription_id
                    },
                },
                columns: [
                    {data: 'prefered_event', name: 'prefered_event'},
                ],
            });

        return table;
    }
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection