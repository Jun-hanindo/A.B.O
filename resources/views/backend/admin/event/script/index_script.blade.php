@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();
        loadSwitchButton('avaibility-check');

        function loadData()
        {
            var table = $('#event-datatables').DataTable();
            table.destroy();
            $('#event-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-event") !!}',
                columns: [
                    // {data: 'id', name: 'id', searchable: false, orderable: false},
                    {data: 'title', name: 'title'},
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

        $(".monthpicker").datepicker( {
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });
        
        $('.select_all-checkbox').on('click', function(){
            datatablesSelectAll(loadData());
        });

        $('.item-checkbox').on('click', function(){
            datatablesCheckbox(loadData());
        });

        $('#event-datatables').on('switchChange.bootstrapSwitch', '.avaibility-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-event-avaibility', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: "avaibility="+val,
                    success: function (data) {
                        $('.error').addClass('alert alert-success').html(data.message);
                    },
                    error: function(response){
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                });
        });
        

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection