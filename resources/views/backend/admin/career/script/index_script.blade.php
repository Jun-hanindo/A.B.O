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

        $('#career-datatables').on('switchChange.bootstrapSwitch', '.avaibility-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-career-avaibility', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: "avaibility="+val,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    loadData();
                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#career-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Career "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#career-datatables').DataTable();
        table.destroy();
        $('#career-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-career") !!}',
            columns: [
                // {data: 'id', name: 'id', searchable: false, orderable: false},
                {data: 'job', name: 'job'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'avaibility', name: 'avaibility', class: 'center-align', searchable: false, orderable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                $(".avaibility-check").bootstrapSwitch({onText: "{{ trans('backend/general.enabled') }}", offText:"{{ trans('backend/general.disabled') }}", animate: false});
            }
        });

        return table;
    }
    </script>
    @include('backend.delete-modal-datatables')
@endsection