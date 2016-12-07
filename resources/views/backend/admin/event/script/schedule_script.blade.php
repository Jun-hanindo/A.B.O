<script type="text/javascript">
    function countSchedule(event_id)
    {
        var uri = "{{ URL::route('admin-count-event-schedule', "::param") }}";
        uri = uri.replace('::param', event_id);
        $.ajax({
            url: uri,
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if(response.data.active == false) {
                    response.data.active = 'false';
                } else {
                    response.data.active = 'true';
                }
                var data = response.data;
                $("#count_schedule").val(data);
                handleScheduleCategory();
            },
            error: function(response){
                //response.responseJSON.message;
                $("#count_schedule").val(0);
                handleScheduleCategory();
            }
        });
    } 

    function loadDataSchedule(event_id)
    {
        if(event_id == undefined){
            event_id = 0;
        }

        $.fn.dataTable.ext.errMode = 'none';
        $('#event-schedule-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Event Schedule "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });
        
        var table = $('#event-schedule-datatables').DataTable();
        table.destroy();
        $('#event-schedule-datatables').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            bLengthChange: false,
            ajax: {
                url: '{!! URL::route("datatables-event-schedule") !!}',
                data: {
                    'event_id': event_id
                },
            },
            columns: [
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                {data: 'date_at', name: 'date_at'},
                {data: 'start_time', name: 'start_time'}
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                handleScheduleCategory();
            }
        });
        //return table;
        handleScheduleCategory();
    }

    function saveEventSchedule(event_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        $.ajax({
            url: "{{ route('admin-post-event-schedule') }}",
            type: "POST",
            dataType: 'json',
            data: $('#form-event-schedule').serialize() + "&event_id=" + event_id,
            success: function (data) {
                HoldOn.close();
                var schedule_id = data.last_insert_id;
                $('#schedule_id').val(schedule_id);
                loadDataSchedule(event_id); 
                $('#modal-form-schedule').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function updateEventSchedule(event_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var id = $("#schedule_id").val();
        var uri = "{{ URL::route('admin-update-event-schedule', "::param") }}";
        uri = uri.replace('::param', id);
        modal_loader();
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: $("#form-event-schedule").serialize(),
            success: function (data) {
                HoldOn.close();
                loadDataSchedule(event_id);
                $('#modal-form-schedule').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function autoSaveSchedule(event_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        //modal_loader();
        $.ajax({
            url: "{{ route('admin-post-event-schedule') }}",
            type: "POST",
            dataType: 'json',
            data: $('#form-event-schedule').serialize() + "&event_id=" + event_id,
            success: function (data) {
                HoldOn.close();
                var schedule_id = data.last_insert_id;
                $('#schedule_id').val(schedule_id);
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

                loadDataSchedule(event_id); 
                countSchedule(event_id);
                $('#modal-form-schedule').modal('hide');
                $('#modal-form-category').modal('show');
                $('#title-create-category').show();
                $('#title-update-category').hide();
                $('#button_update_category').hide();
                $('#button_save_category').show();

            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }

    function autoUpdateSchedule(event_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var id = $("#schedule_id").val();
        modal_loader();
        $.ajax({
            url: "{{ URL::to('admin/event-schedule')}}"+'/'+id+'/update',
            type: "POST",
            dataType: 'json',
            data: $("#form-event-schedule").serialize(),
            success: function (data) {
                HoldOn.close();
                loadDataSchedule(event_id);
                countSchedule(event_id);
                $('#modal-form-schedule').modal('hide');
                $('#modal-form-category').modal('show');
                $('#title-create-category').show();
                $('#title-update-category').hide();
                $('#button_update_category').hide();
                $('#button_save_category').show();
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }


    function getDataEventSchedule(id){
        $.ajax({
            url: "{{ URL::to('admin/event-schedule')}}"+'/'+id+'/edit',
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.data.active == false) {
                    response.data.active = 'false';
                } else {
                    response.data.active = 'true';
                }
                var data = response.data;
                $("#schedule_id").val(data.id);
                $("#date_at").val(data.date_at);
                $("#start_time").val(data.start_time);
                $("#end_time").val(data.end_time);
                $("#description_schedule").val(data.description);
                var schedule_id = data.id;
                if(schedule_id == ''){
                    schedule_id = 0;
                }
                loadDataScheduleCategory(schedule_id);
            },
            error: function(response){
                loadDataSchedule(event_id);
                $('#modal-form-schedule').modal('hide');
                $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        });
    }

    function clearInput(){
        $('#date_at').data('datepicker').setDate(null);
        $('#schedule_id').val('');
        $('#description_schedule').val('');
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes()
        $("#start_time, #end_time").timepicker('setTime', time);
    }

    $(document).ready(function(){ 
        loadDataSchedule(event_id);

    });
    
</script>