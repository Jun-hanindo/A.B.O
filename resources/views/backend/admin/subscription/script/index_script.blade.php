@section('scripts')
{!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

<script>
$(document).ready(function() {
    var start_date = $('input[name=start_date]').val();
    var end_date = $('input[name=end_date]').val();
    loadData(start_date, end_date);

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
    $.fn.dataTable.ext.errMode = 'none';
    $('#subscription-datatables').on('error.dt', function(e, settings, techNote, message) {
        $.ajax({
            url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
            type: "POST",
            dataType: 'json',
            data: "message= Subscribers "+message,
            success: function (data) {
                data.message;
            },
            error: function(response){
                response.responseJSON.message
            }
        });
    });

    var table = $('#subscription-datatables').DataTable();
    table.destroy();
    $('#subscription-datatables').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 3, 'desc' ]],
        ajax:{
            url: '{!! URL::route("datatables-subscription") !!}',
            data: {
                'start_date': start_date,
                'end_date': end_date,
            }
        },
        columns: [
            // {data: 'id', name: 'id', searchable: false, orderable: false},
            {data: 'email', name: 'email'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
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