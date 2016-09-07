{!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

<script>
$(document).ready(function() {

    loadData();

    $('#user_id').on('change', function () {
        loadData();
    });

});

function loadData()
{
    var user_id = $('select[name=user_id]').val();
    
    $.fn.dataTable.ext.errMode = 'none';
    $('#datatable').on('error.dt', function(e, settings, techNote, message) {
        $.ajax({
            url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
            type: "POST",
            dataType: 'json',
            data: "message= Trail "+message,
            success: function (data) {
                data.message;
            },
            error: function(response){
                response.responseJSON.message
            }
        });
    });

    var table = $('#datatable').DataTable();
    table.destroy();
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! URL::route("datatables-trail") !!}',
            data: {
                'user_id': user_id
            }
        },
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'user_id', name: 'user_id'},
            {data: 'session_id', name: 'session_id'},
            {data: 'description', name: 'description'},
            {data: 'ip_address', name: 'ip_address'}
        ]
    });
}

</script>
