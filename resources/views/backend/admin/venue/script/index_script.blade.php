@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

        function loadData()
        {
            var table = $('#venue-datatables').DataTable();
            table.destroy();
            $('#venue-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-venue") !!}',
                columns: [
                    {data: 'id', name: 'id', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'avaibility', name: 'avaibility', searchable: false, orderable: false}
                ],
                "fnDrawCallback": function() {
                    //Initialize checkbos for enable/disable user
                    $(".avaibility-check").bootstrapSwitch({onText: "Enabled", offText:"Disabled", animate: false});
                }
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