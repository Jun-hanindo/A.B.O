@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){
            loadTinyMce();
            $('#button_submit').hide();
            $('#button_draft').show();

            var event_id = $('#event_id').val();
            if(event_id == ''){
                event_id = 0;
            }
            countSchedule(event_id);
            loadDataSchedule(event_id);
            loadSwitchButton('event_type-check');

            $(".datepicker").datepicker( {
                format: "yyyy-mm-dd",
            });
            $('#start_time, #end_time').timepicker();

            function loadDataSchedule(event_id)
            {
                if(event_id == undefined){
                    event_id = 0;
                }
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
            }    

            function handleScheduleCategory()
            {
                var count_s = $('#count_schedule').val();
                var bool = true;
                $('input[name^="count_category"]').each(function() {
                    if($(this).val() == 0){
                        bool = false;
                    }
                });
                console.log(count_s);
                if(count_s > 0 && bool == true){
                    $('#button_submit').show();
                    $('#button_draft').hide();
                }else{
                    $('#button_submit').hide();
                    $('#button_draft').show();
                }
            }    

            $('#button_draft').on('click',function(){
                var fd = new FormData();
                var silde_i = $('#featured_image1').prop('files')[0];
                var thumb_i = $('#featured_image2').prop('files')[0];
                var side_i = $('#featured_image3').prop('files')[0];
                if(silde_i != undefined){
                    fd.append('featured_image1',silde_i);
                }
                if(thumb_i != undefined){
                    fd.append('featured_image2',thumb_i);
                }
                if(side_i != undefined){
                    fd.append('featured_image3',side_i);
                }

                var other_data = $('#form-event').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                $.ajax({
                    url: "{{ route('admin-draft-event') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        
                        window.location.href = "{{ route('admin-index-event') }}"
                    },
                    error: function(response){
                        location.reload();
                    }
                });
            });  

            $('.actAdd').on('click',function(){
                var event_id = $('#event_id').val();
                var schedule_id = $('#schedule_id').val();

                if(event_id == ''){
                    autoSaveEvent();
                }else{
                    autoUpdateEvent(event_id);
                }  

                if(schedule_id == ''){
                    schedule_id = 0;
                }

                clearInput();

            });

            function autoSaveEvent()
            {
                var fd = new FormData();
                var silde_i = $('#featured_image1').prop('files')[0];
                var thumb_i = $('#featured_image2').prop('files')[0];
                var side_i = $('#featured_image3').prop('files')[0];
                if(silde_i != undefined){
                    fd.append('featured_image1',silde_i);
                }
                if(thumb_i != undefined){
                    fd.append('featured_image2',thumb_i);
                }
                if(side_i != undefined){
                    fd.append('featured_image3',side_i);
                }

                var other_data = $('#form-event').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                $.ajax({
                    url: "{{ route('admin-auto-post-event') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        var event_id = data.last_insert_id;
                        $('#event_id').val(event_id);
                        $('#form-event').attr('action', "{{ URL::to('admin/event')}}"+'/'+event_id+'/update');
                        window.history.pushState("string", data.status, "{{ URL::to('admin/event')}}"+'/'+event_id+'/edit');
                        $('#modal-form-schedule').modal('show');
                        $('#title-create-schedule').show();
                        $('#title-update-schedule').hide();
                        $('#button_update_schedule').hide();
                        $('#button_save_schedule').show();
                        
                    },
                    error: function(response){
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                });
            }

            function autoUpdateEvent(id)
            {
                var fd = new FormData();
                var silde_i = $('#featured_image1').prop('files')[0];
                var thumb_i = $('#featured_image2').prop('files')[0];
                var side_i = $('#featured_image3').prop('files')[0];
                if(silde_i != undefined){
                    fd.append('featured_image1',silde_i);
                }
                if(thumb_i != undefined){
                    fd.append('featured_image2',thumb_i);
                }
                if(side_i != undefined){
                    fd.append('featured_image3',side_i);
                }

                var other_data = $('#form-event').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                $.ajax({
                    url: "{{ URL::to('admin/event')}}"+'/'+id+'/auto-update',
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        $('#modal-form-schedule').modal('show');
                        $('#title-create-schedule').show();
                        $('#title-update-schedule').hide();
                        $('#button_update_schedule').hide();
                        $('#button_save_schedule').show();
                        //window.history.pushState("string", data.status, "{{ URL::to('admin/event')}}"+'/'+id+'/edit');
                        
                    },
                    error: function(response){
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                });
            }
                

            $('#modal-form-schedule').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');

                $("#button_save_schedule").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    saveEventSchedule(event_id); 
                    loadDataSchedule(event_id);              
                });

                $("#button_update_schedule").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    updateEventSchedule(event_id);                
                });

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
                            $('.error').addClass('alert alert-success').html(data.message);
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
                                $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
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
                    modal_loader();
                    $.ajax({
                        url: "{{ URL::to('admin/event-schedule')}}"+'/'+id+'/update',
                        type: "POST",
                        dataType: 'json',
                        data: $("#form-event-schedule").serialize(),
                        success: function (data) {
                            HoldOn.close();
                            loadDataSchedule(event_id);
                            $('#modal-form-schedule').modal('hide');
                            $('.error').addClass('alert alert-success').html(data.message);
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
                                $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                            }
                        }
                    });
                }
            });

            $('#event-schedule-datatables tbody').on( 'click', '.actEdit', function () {
                $('#modal-form-schedule').modal('show');
                $('#title-create-schedule').hide();
                $('#title-update-schedule').show();
                $('#button_update_schedule').show();
                $('#button_save_schedule').hide();

                var id = $(this).data('id');
                getDataEventSchedule(id);

            });


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
                            $("#time_period").val(data.time_period);
                            var schedule_id = data.id;
                            if(schedule_id == ''){
                                schedule_id = 0;
                            }
                            loadDataScheduleCategory(schedule_id);
                        },
                        error: function(response){
                            loadDataSchedule(event_id);
                            $('#modal-form-schedule').modal('hide');
                            $('.error').addClass('alert alert-success').html(response.responseJSON.message);
                        }
                    });
            }

            $('#event-schedule-datatables tbody').on( 'click', '.actDelete', function () {
                var id = $(this).attr('data-id');
                $('#delete-modal-schedule').modal('show');
                $('#delete-modal-schedule').attr('data-id', id);
            });  

            $('#delete-modal-schedule').on( 'click', function () {
                var id = $(this).attr('data-id');
                var uri = "{{ URL::route('admin-delete-event-schedule', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "DELETE",
                    success: function (data) {
                        $('.error').addClass('alert alert-success').html(data.message);
                        var event_id = $('#event_id').val();
                        loadDataSchedule(event_id);
                        countSchedule(event_id);
                    },
                    error: function(response){
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                        var event_id = $('#event_id').val();
                        loadDataSchedule(event_id);
                        countSchedule(event_id);
                    }
                }); 
            });

            $('#delete-modal-category').on( 'click', function () {
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');
                var id = $(this).attr('data-id');
                var uri = "{{ URL::route('admin-delete-event-schedule-category', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "DELETE",
                    success: function (data) {
                        $('.error-modal').addClass('alert alert-success').html(data.message);
                        $('#modal-form-schedule').modal('show');
                        var schedule_id = $('#schedule_id').val();
                        var category_id = $('#category_id').val();  
                        loadDataScheduleCategory(schedule_id);    
                        loadDataSchedule(event_id);  
                        countSchedule(event_id);
                    },
                    error: function(response){
                        $('.error-modal').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                }); 
            });

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
                        $('.error').addClass('alert alert-success').html(data.message);

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
                            $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
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
                        $('.error').addClass('alert alert-success').html(data.message);
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
                            $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }

            function loadDataScheduleCategory(schedule_id)
            {
                if(schedule_id == undefined){
                    schedule_id = 0;
                }
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
                        {data: 'price', name: 'price'}
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
                        }); 
                    }
                });

                //return table;
            }

            $('.actAddCategory').on('click',function(){
                var event_id = $('#event_id').val();
                var schedule_id = $('#schedule_id').val();
                if(schedule_id == ''){
                    autoSaveSchedule(event_id);
                }else{
                    autoUpdateSchedule(event_id);
                }
                
                clearInputCategory();
                
            });


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
                        },
                        error: function(response){
                            $('#modal-form-schedule').modal('hide');
                            $('.error').addClass('alert alert-success').html(response.responseJSON.message);
                        }
                    });
            }
                

            $('#modal-form-category').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error').removeClass('alert alert-danger');
                $('.error').html('');
                

                $("#button_save_category").unbind('click').bind('click', function () {
                    var schedule_id = $('#schedule_id').val();
                    var event_id = $('#event_id').val();
                    saveEventScheduleCategory(schedule_id); 
                    loadDataScheduleCategory(schedule_id);    
                    loadDataSchedule(event_id);          
                });

                $("#button_update_category").unbind('click').bind('click', function () {
                    var schedule_id = $('#schedule_id').val();
                    var category_id = $('#category_id').val();
                    updateEventScheduleCategory(category_id);  
                    loadDataScheduleCategory(schedule_id);    
                    loadDataSchedule(event_id);                   
                });

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
                            $('#modal-form-category').modal('hide');
                            $('#modal-form-schedule').modal('show');
                            $('#title-create-schedule').hide();
                            $('#title-update-schedule').show();
                            $('#button_update_schedule').show();
                            $('#button_save_schedule').hide();
                            $('.error-modal').addClass('alert alert-success').html(data.message);
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
                                $('.error-modal').addClass('alert alert-danger').html(response.responseJSON.message);
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
                    console.log($('#form-event-category').serialize());
                    modal_loader();
                    $.ajax({
                        url: "{{ URL::to('admin/event-schedule-category')}}"+'/'+id+'/update',
                        type: "POST",
                        dataType: 'json',
                        data: $('#form-event-category').serialize(),
                        success: function (data) {
                            HoldOn.close();
                            $('#modal-form-category').modal('hide');
                            $('#modal-form-schedule').modal('show');
                            $('#title-create-schedule').hide();
                            $('#title-update-schedule').show();
                            $('#button_update_schedule').show();
                            $('#button_save_schedule').hide();
                            $('.error-modal').addClass('alert alert-success').html(data.message);
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
                                $('.error-modal').addClass('alert alert-danger').html(response.responseJSON.message);
                            }
                        }
                    });
                }
            });

            function countSchedule(event_id)
            {
                var uri = "{{ URL::route('admin-count-event-schedule', "::param") }}";
                uri = uri.replace('::param', event_id);
                $.ajax({
                    url: uri,
                    type: "get",
                    dataType: 'json',
                    success: function (response) {
                        if(response.data.active == false) {
                            response.data.active = 'false';
                        } else {
                            response.data.active = 'true';
                        }
                        var data = response.data;
                        $("#count_schedule").val(data);
                    },
                    error: function(response){
                        response.responseJSON.message;
                    }
                });
            }  


            function clearInput(){
                $('#date_at').data('datepicker').setDate(null);
                $('#schedule_id').val('');
                $("#time_period").val('');
                var schedule_id = $('#schedule_id').val();
                if(schedule_id == ''){
                    schedule_id = 0;
                }
                loadDataScheduleCategory(schedule_id);
            }
            function clearInputCategory(){
                $('#category_id').val('');
                $("#additional_info").val('');
                $("#price").val('');
            }


        });
    </script>
@endsection