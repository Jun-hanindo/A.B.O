@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();

        function loadData()
        {
            var table = $('#countries-table').DataTable();
            table.destroy();
            $('#countries-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-country") !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        }

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection