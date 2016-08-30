@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">

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
            if(count_s > 0 && bool == true){
                $('#schedule_and_price_detail').val('ok');
            }else{
                $('#schedule_and_price_detail').val('');
            }
        }

        function loadDataPromotion(event_id)
        {
            if(event_id == undefined){
                event_id = 0;
            }
            var table = $('#event-promotion-datatables').DataTable();
            table.destroy();
            $('#event-promotion-datatables').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                bLengthChange: false,
                ajax: {
                    url: '{!! URL::route("datatables-event-promotion") !!}',
                    data: {
                        'event_id': event_id
                    },
                },
                columns: [
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                    {data: 'title', name: 'title'},
                    {data: 'date', name: 'date'}
                ],
            });
            //return table;
        }

        function autoSaveUpdateEvent(cat)
        {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $(".text-danger").remove();
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

            for (i=0; i < tinyMCE.editors.length; i++){
                var content = tinyMCE.editors[i].save();
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
                    var event_id = $('#event_id').val();
                    if(event_id == ''){
                        event_id = data.last_insert_id;
                        $('#event_id').val(event_id);
                        var uri = "{{ URL::route('admin-update-event', "::param") }}";
                        uri = uri.replace('::param', event_id);
                        var uri2 = "{{ URL::route('admin-edit-event', "::param") }}";
                        uri2 = uri2.replace('::param', event_id);
                        $('#form-event').attr('action', uri);
                        window.history.pushState("string", data.status, uri2);
                    }

                    if(cat == 'schedule'){
                        $('#modal-form-schedule').modal('show');
                        $('#title-create-schedule').show();
                        $('#title-update-schedule').hide();
                        $('#button_update_schedule').hide();
                        $('#button_save_schedule').show();
                    }else if(cat == 'promotion'){
                        $('#modal-form-promotion').modal('show');
                        $('#title-create-promotion').show();
                        $('#title-update-promotion').hide();
                        $('#button_update_promotion').hide();
                        $('#button_save_promotion').show();
                    }else{
                        window.location.href = "{{ route('admin-index-event') }}"
                    }
                },
                error: function(response){
                    if (response.status === 422) {
                        var data = response.responseJSON;
                        $.each(data,function(key,val){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                            $('.'+key).addClass('has-error');
                        });
                    } else {
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }
            });
        }

        function saveEventSchedule(event_id)
        {
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }
            });
        }

        function updateEventSchedule(event_id)
        {
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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
            var dt = new Date();
            var time = dt.getHours() + ":" + dt.getMinutes()
            $("#start_time, #end_time").timepicker('setTime', time);
        }

        function clearInputCategory(){
            $('#category_id').val('');
            $("#additional_info").val('');
            $("#price").val('');
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
                    $('#modal-form-category').modal('hide');
                    $('#modal-form-schedule').modal('show');
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
                    $('#modal-form-category').modal('hide');
                    $('#modal-form-schedule').modal('show');
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

        function saveEventPromotion(event_id)
        {
            var fd = new FormData();
            var image = $('#featured_image').prop('files')[0];
            if(image != undefined){
                fd.append('featured_image',image);
            }

            for (i=0; i < tinyMCE.editors.length; i++){
                var content = tinyMCE.editors[i].save();
            }

            var title = $('#title-promo').val();
            var description = $().val('#description-promo').val();

            fd.append('event_id', event_id);
            fd.append('title', title);
            fd.append('description', description);
            var other_data = $('#form-event-promotion').serializeArray();
            $.each(other_data,function(key,input){
                fd.append(input.name,input.value);
            });
            modal_loader();

            $.ajax({
                url: "{{ route('admin-post-promotion') }}",
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                data: fd,
                success: function (data) {
                    HoldOn.close();
                    loadDataPromotion(event_id); 

                    clearInputPromotion();
                    $('#modal-form-promotion').modal('hide');
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }
            });
        }

        function updateEventPromotion(event_id)
        {
            var fd = new FormData();
            var image = $('#featured_image').prop('files')[0];
            if(image != undefined){
                fd.append('featured_image',image);
            }

            for (i=0; i < tinyMCE.editors.length; i++){
                var content = tinyMCE.editors[i].save();
            }

            var title = $('#title-promo').val();
            var description = $().val('#description-promo').val();

            fd.append('event_id', event_id);
            fd.append('title', title);
            fd.append('description', description);
            
            var other_data = $('#form-event-promotion').serializeArray();
            $.each(other_data,function(key,input){
                fd.append(input.name,input.value);
            });

            var id = $("#promotion_id").val();
            var uri = "{{ URL::route('admin-update-promotion', "::param") }}";
            uri = uri.replace('::param', id);
            modal_loader();
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                data: fd,
                success: function (data) {
                    HoldOn.close();
                    loadDataPromotion(event_id);
                    clearInputPromotion();
                    $('#modal-form-promotion').modal('hide');
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
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }
            });
        }


        function getDataEventPromotion(id){
            $.ajax({
                url: "{{ URL::to('admin/promotion')}}"+'/'+id+'/edit',
                type: "get",
                dataType: 'json',
                success: function (response) {
                    if(response.data.active == false) {
                        response.data.active = 'false';
                    } else {
                        response.data.active = 'true';
                    }
                    var data = response.data;
                    $("#promotion_id").val(data.id);
                    $("#title-promo").val(data.title);
                    tinyMCE.get('description-promo').setContent(data.description);
                    $("#discount").val(data.discount);
                    $("#start_date").val(data.start_date);
                    $("#end_date").val(data.end_date);   
                    $("#code").val(data.code);   
                    $("#category").val(data.category); 
                    $('#div-preview_image').show();
                    $('#preview_image').attr('src', data.src_featured_image);   
                },
                error: function(response){
                    loadDataSchedule(event_id);
                    $('#modal-form-schedule').modal('hide');
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        }

        function clearInputPromotion(){
            $("#title-promo").val('');
            $("#discount").val('');
            $("#code").val('');
            $("#featured_image").val('');
            $('#preview_image').attr('src', '');
            //$('#start_date').data('datepicker').setDate(null);
            //$('#end_date').data('datepicker').setDate(null);
            tinyMCE.get('description-promo').setContent('');
        }

        function saveCat()
        {
            modal_loader();
            var name = $("#name-cat").val();
            var icon = $("#icon-cat").val();
            var description = tinyMCE.get('description-cat').getContent();
            $.ajax({
                url: "{{ route('admin-post-event-category') }}",
                type: "POST",
                dataType: 'json',
                data: {'name':name,"description":description,"icon":icon},
                success: function (data) {
                    HoldOn.close();

                    $("select.categories").append('<option value="'+data.last_id+'" selected="selected">'+name+'</option>');
                    var existingData = $(".categories").select2("data");
                    existingData.push({ id: data.last_id, text: name });
                    $(".categories").select2("data", existingData);
                    $('#modal-form-cat').modal('hide');
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                },
                error: function(response){
                    HoldOn.close();
                    if (response.status === 422) {
                        var data = response.responseJSON;

                        $.each(data,function(key,val){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key+'-cat'));
                            $('.'+key+'-cat').addClass('has-error');
                        });
                    } else {
                        $('.error-modal-cat').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }
            });
        }

        function clearInputCat(){
            $("#name-cat").val('');
            $("#icon-cat").val('');
            tinyMCE.get('description-cat').setContent('');
        }



        $(document).ready(function(){
            loadTinyMce(); 

            var event_id = $('#event_id').val();
            if(event_id != ''){
                countSchedule(event_id);
            }else{
                event_id = 0;
            } 

            $('.image').change(function(){
                var name = $(this).attr('data-name');
                $("#div-preview_"+name).show();
                preview(this,$(this).data('type'),name);
            });

            loadDataSchedule(event_id);
            loadDataPromotion(event_id);
            loadSwitchButton('event_type-check');

            $(".categories").select2();
            //$('#button_submit').hide();
            //$('#button_draft').show();

            $('#button_draft').on('click',function(){
                var cat = '';
                autoSaveUpdateEvent(cat);
            });   

            $(".datepicker").datepicker( {
                format: "yyyy-mm-dd",
            });

            $('#start_time, #end_time').timepicker();   

            $('.actAdd, .addPromotion').on('click',function(){
                var cat = $(this).attr('data-name');
                autoSaveUpdateEvent(cat);
                clearInput();
                var schedule_id = $('#schedule_id').val();
                if(schedule_id == ''){
                    schedule_id = 0;
                }
                loadDataScheduleCategory(schedule_id);

            });    

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
            }); 

            $('#event-promotion-datatables tbody').on( 'click', '.actEdit', function () {
                $('#modal-form-promotion').modal('show');
                $('#title-create-promotion').hide();
                $('#title-update-promotion').show();
                $('#button_update_promotion').show();
                $('#button_save_promotion').hide();

                var id = $(this).data('id');
                getDataEventPromotion(id);

            });

            $('#modal-form-promotion').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');

                $("#button_save_promotion").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    saveEventPromotion(event_id); 
                    //loadDataPromotion(event_id);              
                });

                $("#button_update_promotion").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    updateEventPromotion(event_id);                
                });
            });


            $('.addCategory').on('click',function(){
                $('#modal-form-cat').modal('show');
                $('#title-create-cat').show();
                $('#button_save-cat').show();
            });


            $('#modal-form-cat').on('show.bs.modal', function (e) {
                $("#button_save-cat").unbind('click').bind('click', function () {
                    saveCat();                
                });
                clearInputCat();

            });





            $('#event-schedule-datatables tbody').on( 'click', '.actDelete', function () {
                var id = $(this).attr('data-id');
                $('#delete-modal-schedule').modal('show');
                $('#delete-modal-schedule').attr('data-id', id);
            });  

            $('#delete-modal-schedule').on('click', '.continue-delete', function () {
                var id = $(this).attr('data-id');
                var uri = "{{ URL::route('admin-delete-event-schedule', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "DELETE",
                    success: function (data) {
                        $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        var event_id = $('#event_id').val();
                        loadDataSchedule(event_id);
                        countSchedule(event_id);
                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        var event_id = $('#event_id').val();
                        loadDataSchedule(event_id);
                        countSchedule(event_id);
                    }
                }); 
            });

            $('#delete-modal-category').on( 'click', '.continue-delete', function () {
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
                        $('.error-modal').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        $('#modal-form-schedule').modal('show');
                        var schedule_id = $('#schedule_id').val();
                        var category_id = $('#category_id').val();  
                        loadDataScheduleCategory(schedule_id);    
                        loadDataSchedule(event_id);  
                        countSchedule(event_id);
                    },
                    error: function(response){
                        $('.error-modal').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                }); 
            });

            $('#event-promotion-datatables tbody').on( 'click', '.actDeletePromotion', function () {
                var id = $(this).attr('data-id');
                $('#delete-modal-promotion').modal('show');
                $('#delete-modal-promotion').attr('data-id', id);
            });  

            $('#delete-modal-promotion').on('click', '.continue-delete', function () {
                var id = $(this).attr('data-id');
                var uri = "{{ URL::route('admin-delete-promotion', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "DELETE",
                    success: function (data) {
                        $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        var event_id = $('#event_id').val();
                        loadDataPromotion(event_id);
                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        var event_id = $('#event_id').val();
                        loadDataPromotion(event_id);
                    }
                }); 
            });

        });
    </script>
@endsection