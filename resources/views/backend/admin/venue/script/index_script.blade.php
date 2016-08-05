@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();
        loadEnableDisabled('avaibility-check');

        function loadData()
        {
            var table = $('#venue-datatables').DataTable();
            table.destroy();
            $('#venue-datatables').DataTable({
                columnDefs: [{
                    targets: [0, 4],
                    orderable: false,
                    searchable: false,
                }],
                order: [[ 1, 'asc' ]]
            });

            return table;
        }
        
        $('.select_all-checkbox').on('click', function(){
            datatablesSelectAll(loadData());
        });

        $('.item-checkbox').on('click', function(){
            datatablesCheckbox(loadData());
        });

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection