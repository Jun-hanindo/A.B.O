@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();
        loadSwitchButton('avaibility-check');

        function loadData()
        {
            $.fn.dataTable.ext.errMode = 'none';
            $('#event-datatables').on('error.dt', function(e, settings, techNote, message) {
                $.ajax({
                    url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                    type: "POST",
                    dataType: 'json',
                    data: "message= Event "+message,
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
                ajax: '{!! URL::route("datatables-event") !!}',
                columns: [
                    // {data: 'id', name: 'id', searchable: false, orderable: false},
                    {data: 'title', name: 'title'},
                    {data: 'user_id', name: 'user_id'},
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
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

        $('[data-tables=true]').on('click', '.actDuplicate', function(e) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-duplicate-event', "::param") }}";
            uri = uri.replace('::param', id);
            $.ajax({
                url: uri,
                type: "get",
                dataType: 'json',
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
    </script>
    @include('backend.delete-modal-datatables')
@endsection