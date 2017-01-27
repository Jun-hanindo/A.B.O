@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#visa-checkout-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Visa Checkout "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#visa-checkout-datatables').DataTable();
        table.destroy();
        $('#visa-checkout-datatables').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 0, 'desc' ]],
            ajax: '{!! URL::route("datatables-visa-checkout") !!}',
            columns: [
                {data: 'title', name: 'title'},
                {data: 'banner_image', name: 'banner_image'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
    }
    </script>
    @include('backend.delete-modal-datatables')
@endsection