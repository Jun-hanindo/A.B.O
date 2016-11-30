@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();
        
        // $('.select_all-checkbox').on('click', function(){
        //     datatablesSelectAll(loadData());
        // });

        // $('.item-checkbox').on('click', function(){
        //     datatablesCheckbox(loadData());
        // });

        // $('#venue-datatables').on('switchChange.bootstrapSwitch', '.avaibility-check', function(event, state) {
        //     var id = $(this).attr('data-id');
        //     var uri = "{{ URL::route('admin-update-venue-avaibility', "::param") }}";
        //     uri = uri.replace('::param', id);
        //     var val = $(this).is(":checked") ? true : false;
        //     $.ajax({
        //             url: uri,
        //             type: "POST",
        //             dataType: 'json',
        //             data: "avaibility="+val,
        //             success: function (data) {
        //                 $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
        //             },
        //             error: function(response){
        //                 $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
        //             }
        //         });
        // });

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#venue-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Venue "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#venue-datatables').DataTable();
        table.destroy();
        $('#venue-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-venue") !!}',
            columns: [
                // {data: 'id', name: 'id', searchable: false, orderable: false},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'post_by', name: 'post_by'},
                {data: 'avaibility', name: 'avaibility', class: 'center-align', searchable: false, orderable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                $(".avaibility-check").bootstrapSwitch({onText: "Enabled", offText:"Disabled", animate: false});
            }
        });

        return table;
    }
    </script>
    @include('backend.delete-modal-datatables')
@endsection