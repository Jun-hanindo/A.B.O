<script type="text/javascript">
    function handleScheduleCategory()
    {
        var count_s = $('#count_schedule').val();
        var bool = true;
        $('input[name^="count_category"]').each(function() {
            if($(this).val() == 0){
                bool = false;
            }
        });
        var event_id = $('#event_id').val();
        if(count_s > 0 && bool == true){
            $('#schedule_and_price_detail').val('ok');
        }else{
            $('#schedule_and_price_detail').val('');
        }
    }

    function clearInputCategory()
    {
        $('#category_id').val('');
        $("#additional_info").val('');
        $("#price").val('');
        $("#seat_color").val('');
        var currency = $("#form-event-category #currency_id").attr('data-default');
        $("#form-event-category #currency_id").val(currency);
    }

    function loadDataScheduleCategory(schedule_id)
    {
        if(schedule_id == undefined){
            schedule_id = 0;
        }
        
        $.fn.dataTable.ext.errMode = 'none';
        $('#event-schedule-category-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Schedule Category "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });
        
        var table = $('#event-schedule-category-datatables').DataTable();
        table.destroy();
        $('#event-schedule-category-datatables').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            bLengthChange: false,
            ajax: {
                url: '{!! URL::route("datatables-event-schedule-category") !!}',
                data: {
                    'schedule_id': schedule_id
                },
                complete: function(data){
                    var res = data.responseText;
                    var json = JSON.parse(res);
                    $('#count_category').val(json.recordsTotal);
                }
            },
            columns: [
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                {data: 'additional_info', name: 'additional_info'},
                {data: 'price', name: 'price'},
                {data: 'seat_color', name: 'seat_color'},
                {data: 'sort_order', name: 'sort_order', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                handleScheduleCategory();
                $('#event-schedule-category-datatables tbody').on( 'click', '.actEditCategory', function () {
                    $('#modal-form-category').modal('show');
                    $('#modal-form-schedule').modal('hide');
                    $('#title-create-category').hide();
                    $('#title-update-category').show();
                    $('#button_update_category').show();
                    $('#button_save_category').hide();

                    var id = $(this).data('id');
                    getDataEventScheduleCategory(id);

                });


                $('#event-schedule-category-datatables tbody').on( 'click', '.actDeleteCategory', function () {
                    var id = $(this).attr('data-id');
                    $('#modal-form-schedule').modal('hide');
                    $('#delete-modal-category').modal('show');
                    $('#delete-modal-category').attr('data-id', id);
                    $('#delete-modal-category .continue-delete').attr('data-id', id);
                }); 
            }
        });

        //return table;
    }

    function getDataEventScheduleCategory(id){
        $.ajax({
            url: "{{ URL::to('admin/event-schedule-category')}}"+'/'+id+'/edit',
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.data.active == false) {
                    response.data.active = 'false';
                } else {
                    response.data.active = 'true';
                }
                var data = response.data;
                $("#category_id").val(data.id);
                $("#additional_info").val(data.additional_info);
                $("#price").val(data.price);
                $("#price_cat").val(data.time_period);
                $("#seat_color").val(data.seat_color);
                var def = $("#form-event-category #currency_id").attr('data-default');
                if(!data.currency_id){
                    $("#form-event-category #currency_id").val(def);
                }else{
                    $("#form-event-category #currency_id").val(data.currency_id);
                }
            },
            error: function(response){
                $('#modal-form-schedule').modal('hide');
                $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        });
    }

    function saveEventScheduleCategory(schedule_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error-modal').removeClass('alert alert-danger');
        $('.error-modal').html('');
        modal_loader();
        $.ajax({
            url: "{{ route('admin-post-event-schedule-category') }}",
            type: "POST",
            dataType: 'json',
            data: $('#form-event-category').serialize() + "&event_schedule_id=" + schedule_id,
            success: function (data) {
                HoldOn.close();

                loadDataScheduleCategory(schedule_id);
                $('#modal-form-category').modal('hide');
                $('#modal-form-schedule').modal('show'); 
                //$('body').addClass('modal-open2');
                $('#title-create-schedule').hide();
                $('#title-update-schedule').show();
                $('#button_update_schedule').show();
                $('#button_save_schedule').hide();
                $('.error-modal').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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

    function updateEventScheduleCategory(id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error-modal').removeClass('alert alert-danger');
        $('.error-modal').html('');
        modal_loader();
        $.ajax({
            url: "{{ URL::to('admin/event-schedule-category')}}"+'/'+id+'/update',
            type: "POST",
            dataType: 'json',
            data: $('#form-event-category').serialize(),
            success: function (data) {
                HoldOn.close();
                //loadDataScheduleCategory(schedule_id);
                $('#modal-form-category').modal('hide');
                $('#modal-form-schedule').modal('show'); 
                //$('body').addClass('modal-open2');
                // $('#title-create-schedule').hide();
                // $('#title-update-schedule').show();
                // $('#button_update_schedule').show();
                // $('#button_save_schedule').hide();
                //$('.error-modal').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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

    //function saveSortOrder(schedule_id, id_current, current_sort, update_sort, id_other){
    function saveSortOrder(schedule_id, id_current, order)
    {
        $('.error-modal').html('');
        $.ajax({
            url: "{{ route('admin-sort-order-schedule-category') }}",
            type: "POST",
            dataType: 'json',
            //data: "current_sort=" + current_sort + "&update_sort=" + update_sort + "&id_current=" + id_current + "&id_other=" + id_other + "&schedule_id=" + schedule_id,
            data: "id_current=" + id_current + "&schedule_id=" + schedule_id + "&order=" + order,
            success: function (data) {
                $('.error-modal').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        });
    }

    $(document).ready(function(){ 
        $(document).on('click', '.sort_asc',function(){
            //console.log('tes asc');
            var schedule_id = $(this).attr('data-schedule');
            var id_current = $(this).attr('data-id');
            // var current_sort = $(this).attr('data-sort');
            // var update_sort = +current_sort - 1;
            // var id_other = $('#event-schedule-category-datatables tbody .sort_asc[data-sort="'+update_sort+'"]').attr('data-id');
            // if(id_other == undefined){
            //     update_sort = 0;
            //     id_other = $('#event-schedule-category-datatables tbody .sort_asc[data-sort="'+update_sort+'"]').attr('data-id');
            // }
            var order = 'asc';
            //saveSortOrder(schedule_id, id_current, current_sort, update_sort, id_other);
            saveSortOrder(schedule_id, id_current, order);
            loadDataScheduleCategory(schedule_id);

        });

        $(document).on('click', '.sort_desc',function(){
            //console.log('tes desc');
            var schedule_id = $(this).attr('data-schedule');
            var id_current = $(this).attr('data-id');
            // var current_sort = $(this).attr('data-sort');
            // var update_sort = +current_sort + 1;
            // var id_other = $('#event-schedule-category-datatables tbody .sort_desc[data-sort="'+update_sort+'"]').attr('data-id');
            // if(id_other == undefined){
            //     update_sort = 0;
            //     id_other = $('#event-schedule-category-datatables tbody .sort_desc[data-sort="'+update_sort+'"]').attr('data-id');
            // }
            var order = 'desc';
            saveSortOrder(schedule_id, id_current,order);
            loadDataScheduleCategory(schedule_id);

        });
    });
    
</script>