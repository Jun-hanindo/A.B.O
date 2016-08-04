@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

        function loadData()
        {
            var table = $('#event-datatables').DataTable();
            table.destroy();
            $('#event-datatables').DataTable({
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                } ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                order: [[ 1, 'asc' ]]
            });
        }

        $(".monthpicker").datepicker( {
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });
        

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection