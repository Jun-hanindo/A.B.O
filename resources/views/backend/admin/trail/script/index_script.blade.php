{!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

<script>
$(document).ready(function() {
    var start_date = $('input[name=start_date]').val();
    var end_date = $('input[name=end_date]').val();

    loadData(start_date, end_date);

    $('#user_id').on('change', function () {
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        loadData(start_date, end_date);
    });

    $('#start_date').datepicker({
        format: "yyyy-mm-dd",
        endDate: end_date,
    }).on('changeDate', function(){
        $('#end_date').datepicker('setStartDate', new Date($('#start_date').val()));
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        loadData(start_date, end_date);
    });

    $('#end_date').datepicker({
        format: "yyyy-mm-dd",
        startDate: start_date,
        endDate: end_date,
    }).on('changeDate', function(){
        $('#start_date').datepicker('setEndDate', new Date($('#end_date').val()));
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        loadData(start_date, end_date);
    });

});

function loadData(start_date, end_date)
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
                'user_id': user_id,
                'start_date': start_date,
                'end_date': end_date,
            }
        },
        columns: [
            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'user', name: 'user'},
            {data: 'session_id', name: 'session_id'},
            {data: 'description', name: 'description'},
            {data: 'ip_address', name: 'ip_address'}
        ]
    });
}

</script>
