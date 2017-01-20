@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">

        function hideShowSeatImage(val){
            if(val == 0){
                $('#seat_image-div').show();
            }else{
                $('#seat_image-div').hide();
            }
        }

        function hideShowBuyMessage(val){
            if(val == 1){
                $('.buymessage-div').show()
            }else{
                $('.buymessage-div').hide()
            }
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
            var seat_i = $('#seat_image').prop('files')[0];
            var seat_i2 = $('#seat_image2').prop('files')[0];
            var seat_i3 = $('#seat_image3').prop('files')[0];
            var share_i = $('#share_image').prop('files')[0];
            if(silde_i != undefined){
                fd.append('featured_image1',silde_i);
            }
            if(thumb_i != undefined){
                fd.append('featured_image2',thumb_i);
            }
            if(side_i != undefined){
                fd.append('featured_image3',side_i);
            }
            if(seat_i != undefined){
                fd.append('seat_image',seat_i);
            }
            if(seat_i2 != undefined){
                fd.append('seat_image2',seat_i2);
            }
            if(seat_i3 != undefined){
                fd.append('seat_image3',seat_i3);
            }
            if(share_i != undefined){
                fd.append('share_image',share_i);
            }

            // for (i=0; i < tinyMCE.editors.length; i++){
            //     var content = tinyMCE.editors[i].save();
            // }

            var other_data = $('#form-event').serializeArray();
            $.each(other_data,function(key,input){
                fd.append(input.name,input.value);
            });
            $.ajax({
                url: "{{ route('admin-saveupdate-event') }}",
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
                        saveTrailModal('Schedule Form');
                    }else if(cat == 'promotion'){
                        $('#modal-form-promotion').modal('show');
                        $('#title-create-promotion').show();
                        $('#title-update-promotion').hide();
                        $('#button_update_promotion').hide();
                        $('#button_save_promotion').show();
                        saveTrailModal('Promotion Form');
                    }else if(cat == 'preview'){
                        location.reload();
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

        function draft(){
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $(".text-danger").remove();
            var fd = new FormData();
            var silde_i = $('#featured_image1').prop('files')[0];
            var thumb_i = $('#featured_image2').prop('files')[0];
            var side_i = $('#featured_image3').prop('files')[0];
            var seat_i = $('#seat_image').prop('files')[0];
            var seat_i2 = $('#seat_image2').prop('files')[0];
            var seat_i3 = $('#seat_image3').prop('files')[0];
            var share_i = $('#share_image').prop('files')[0];
            if(silde_i != undefined){
                fd.append('featured_image1',silde_i);
            }
            if(thumb_i != undefined){
                fd.append('featured_image2',thumb_i);
            }
            if(side_i != undefined){
                fd.append('featured_image3',side_i);
            }
            if(seat_i != undefined){
                fd.append('seat_image',seat_i);
            }
            if(seat_i2 != undefined){
                fd.append('seat_image2',seat_i2);
            }
            if(seat_i3 != undefined){
                fd.append('seat_image3',seat_i3);
            }
            if(share_i != undefined){
                fd.append('share_image',share_i);
            }

            // for (i=0; i < tinyMCE.editors.length; i++){
            //     var content = tinyMCE.editors[i].save();
            // }

            var other_data = $('#form-event').serializeArray();
            $.each(other_data,function(key,input){
                fd.append(input.name,input.value);
            });
            modal_loader();
            $.ajax({
                url: "{{ route('admin-draft-event') }}",
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                data: fd,
                success: function (data) {
                    HoldOn.close();
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
                        window.location.href = "{{ route('admin-index-event') }}";
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



        $(document).ready(function(){ 
            var event_id = $('#event_id').val();
            
            if(event_id != ''){
                countSchedule(event_id);
            }else{
                event_id = 0;
            }    

            loadTextEditor(); 

            $('.image').change(function(){
                var name = $(this).attr('data-name');
                $("#div-preview_"+name).show();
                preview(this,$(this).data('type'),name);
            });

            var typingTimer;                //timer identifier
            $('.title_new').on('input keypress', function(event) {
                var doneTypingInterval = 500;
                var title = $(this).val();
                var slug = getSlug(title);
                //console.log(slug);
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function(){
                    var uri = "{{ URL::route('admin-slug-check-event', "::param") }}";
                    uri = uri.replace('::param', slug);
                    $.ajax({
                        url: uri,
                        type: "get",
                        contentType: "application/json",
                        dataType: 'json',
                        success: function (response) {
                            var data = response.data;
                            $('#slug').val(data.slug);
                            if(data == false){
                                $('#slug').val(slug);
                            }
                        },
                        error: function(response){
                            $('#slug').val(slug);
                        }
                    });
                }, doneTypingInterval);
            });

            var event_type = $('#event_type').val();
            hideShowSeatImage(event_type)
            $('#event_type').change(function(){
                var val = $(this).val();
                hideShowSeatImage(val)
            });

            $('.delete-seat_image2').click(function(){
                $('#delete-modal-seat-image').modal('show');
                var name = $(this).attr('data-id');
                var val = $(this).attr('data-value');

                $('#delete-modal-seat-image .continue-delete').attr('data-id', name);
                $('#delete-modal-seat-image .continue-delete').attr('data-value', val);
            });

            $('.delete-seat_image3').click(function(){
                $('#delete-modal-seat-image').modal('show');
                var name = $(this).attr('data-id');
                var val = $(this).attr('data-value');

                $('#delete-modal-seat-image .continue-delete').attr('data-id', name);
                $('#delete-modal-seat-image .continue-delete').attr('data-value', val);
            });

            $('#delete-modal-seat-image').on('click', '.continue-delete', function () {
                var id = $('#event_id').val();
                var image = $(this).attr('data-value');
                var uri = "{{ URL::route('admin-delete-seat-image', "::param") }}";
                var name = $(this).attr('data-id');
                var image = $(this).attr('data-value');
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: name+'='+image,
                    success: function (data) {
                        $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        
                        $('#'+name).val('');
                        $('#div-preview_'+name+' img').attr('src', '');
                        $('.delete-'+name).remove();

                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                });
            });

            $('.delete-seat-image3').click(function(){
                var id = $('#event_id').val();
                var image = $(this).attr('data-value');
                //console.log(image);
                var uri = "{{ URL::route('admin-delete-seat-image', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: {seat_image3: image},
                    success: function (data) {
                        $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        
                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        $('#seat_image3').val('');
                        $('#div-preview_seat_image3 img').attr('src', '');
                    }
                });
            });

            var buyCheck = $('#buy_button_disabled').prop( "checked" );
            if(buyCheck){
                var buyButton = 1;
            }else{
                var buyButton = 0;
            }
            hideShowBuyMessage(buyButton);

            $('#buy_button_disabled').on('click', function(){
                var check = $( this ).prop( "checked" );
                console.log(check);
                if(check){
                    var buyButton = 1;
                }else{
                    var buyButton = 0;
                }
                hideShowBuyMessage(buyButton);
            })

            $(".categories").select2();

            $('.colorpicker').colorpicker();

            $('#button_draft').on('click',function(){
                var cat = '';
                draft(cat);
            });

            $('#form-event').on("click", "#button_preview", function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
                var fd = new FormData();
                var silde_i = $('#featured_image1').prop('files')[0];
                var thumb_i = $('#featured_image2').prop('files')[0];
                var seat_i = $('#seat_image').prop('files')[0];
                var seat_i2 = $('#seat_image2').prop('files')[0];
                var seat_i3 = $('#seat_image3').prop('files')[0];
                if(silde_i != undefined){
                    fd.append('featured_image1',silde_i);
                }
                if(thumb_i != undefined){
                    fd.append('featured_image2',thumb_i);
                }
                if(seat_i != undefined){
                    fd.append('seat_image',seat_i);
                }
                if(seat_i2 != undefined){
                    fd.append('seat_image2',seat_i2);
                }
                if(seat_i3 != undefined){
                    fd.append('seat_image3',seat_i3);
                }

                var other_data = $('#form-event').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                modal_loader();
                var newwindow = window.open('', '_blank');
                $.ajax({
                    url: "{{ route('getpost-event') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        HoldOn.close();
                        var url = '{{ route('preview-event') }}';
                        newwindow.location = url;
                        return false;
                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    }
                });
            }); 

            loadDataSchedule(event_id);

            loadDataPromotion(event_id);

            $('.actAdd, .addPromotion').on('click',function(){
                var cat = $(this).attr('data-name');
                autoSaveUpdateEvent(cat);
                clearInput();
                clearInputPromotion();
                var schedule_id = $('#schedule_id').val();
                if(schedule_id == ''){
                    schedule_id = 0;
                }
                loadDataScheduleCategory(schedule_id);

            });  
            //loadSwitchButton('event_type-check');
            loadSwitchButton('discount_type-check');
            loadSwitchButton('switch_icon');
            discountSwitch();
            //$('#button_submit').hide();
            //$('#button_draft').show();  
            //
            $('#button_submit').click(function(){
                modal_loader();
            }); 

            $(".datepicker").datepicker( {
                format: "yyyy-mm-dd",
            });

            $('#start_time, #end_time').timepicker(); 
            
            $(".modal").on('hidden.bs.modal', function (e) {
                if($('.modal').hasClass('in')) {
                    $('body').addClass('modal-open');
                } 
            });

            $('#modal-form-schedule').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');
                $(".text-danger").remove();
                

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
                saveTrailModal('Schedule Form');
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
                
                
            });
                

            $('#modal-form-category').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');
                saveTrailModal('Price Info Form');
                clearInputCategory();
                

                $("#button_save_category").unbind('click').bind('click', function () {
                    var schedule_id = $('#schedule_id').val();
                    var event_id = $('#event_id').val();
                    saveEventScheduleCategory(schedule_id); 
                    loadDataScheduleCategory(schedule_id);    
                    loadDataSchedule(event_id); 
                    //$('body').removeClass('modal-open2');         
                });

                $("#button_update_category").unbind('click').bind('click', function () {
                    var schedule_id = $('#schedule_id').val();
                    var category_id = $('#category_id').val();
                    var event_id = $('#event_id').val();
                    updateEventScheduleCategory(category_id);  
                    loadDataScheduleCategory(schedule_id);    
                    loadDataSchedule(event_id);   
                    //$('body').removeClass('modal-open2');                
                });
            }); 

            $('#event-promotion-datatables tbody').on( 'click', '.actEdit', function () {
                saveTrailModal('Promotion Form');
                var id = $(this).data('id');
                getDataEventPromotion(id);
                clearInputPromotion();
                $('#modal-form-promotion').modal('show');
                $('#title-create-promotion').hide();
                $('#title-update-promotion').show();
                $('#button_update_promotion').show();
                $('#button_save_promotion').hide();

            });

            $('#modal-form-promotion').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-modal').removeClass('alert alert-danger');
                $('.error-modal').html('');
                var event_id = $('#event_id').val();
                minPrice(event_id);

                $('#discount_nominal').keyup(function (e) {
                    var val = $(this).val();
                    var max = $(this).attr('data-max');

                    if (this.value.length == 0 && e.which == 48 ){
                      return false;
                    }

                    if(parseFloat(max) > 0){
                        if(parseFloat(val) > parseFloat(max)){
                            //return false;
                            $('#discount_nominal').val(max);
                        }
                    }
                });

                $("#button_save_promotion").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    saveEventPromotion(event_id); 
                    //loadDataPromotion(event_id);              
                });

                $("#button_update_promotion").unbind('click').bind('click', function () {
                    var event_id = $('#event_id').val();
                    updateEventPromotion(event_id);                
                });

                $('#modal-form-promotion').on('switchChange.bootstrapSwitch', '.discount_type-check', function(event, state) {
                    discountSwitch();
                });
            });


            $('.addCategory').on('click',function(){
                $('#modal-form-cat').modal('show');
                $('#title-create-cat').show();
                $('#button_save-cat').show();
            });


            $('#modal-form-cat').on('show.bs.modal', function (e) {
                saveTrailModal('Category Form');
                $("#button_save-cat").unbind('click').bind('click', function () {
                    saveCat();                
                });
                clearInputCat();

                $('#modal-form-cat').on('switchChange.bootstrapSwitch', '.switch_icon', function(event, state) {
                    iconSwitch();
                });

            });





            $('#event-schedule-datatables tbody').on( 'click', '.actDelete', function () {
                var id = $(this).attr('data-id');
                $('#delete-modal-schedule').modal('show');
                $('#delete-modal-schedule').attr('data-id', id);
                $('#delete-modal-schedule .continue-delete').attr('data-id', id);
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
                        var event_id = $('#event_id').val();
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
                $('#delete-modal-promotion .continue-delete').attr('data-id', id);
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
    @include('backend.admin.event.script.schedule_script')
    @include('backend.admin.event.script.schedule_category_script')
    @include('backend.admin.event.script.promotion_script')
    @include('backend.admin.category.script.save_script')
@endsection