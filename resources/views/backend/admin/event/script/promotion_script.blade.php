<script type="text/javascript">
    function loadDataPromotion(event_id)
    {
        if(event_id == undefined){
            event_id = 0;
        }
        
        $.fn.dataTable.ext.errMode = 'none';
        $('#event-promotion-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Promotion "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

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
                {data: 'date', name: 'date'},
                {data: 'sort_order', name: 'sort_order', class: 'center-align', searchable: false, orderable: false}
            ],
        });
        //return table;
    }

    function saveEventPromotion(event_id)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var fd = new FormData();
        var promo_logo = $('#promotion_logo').prop('files')[0];
        if(promo_logo != undefined){
            fd.append('promotion_logo',promo_logo);
        }
        var promo_banner = $('#promotion_banner').prop('files')[0];
        if(promo_banner != undefined){
            fd.append('promotion_banner',promo_banner);
        }

        // for (i=0; i < tinyMCE.editors.length; i++){
        //     var content = tinyMCE.editors[i].save();
        // }

        var title = $('#title_promo').val();
        var description = $('#description_promo').val();

        fd.append('event_id', event_id);
        fd.append('title', title);
        fd.append('description_promo', description);
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

                $('#modal-form-promotion').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        if(key == "description_promo"){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#cke_'+key));
                        }else{
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        }
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
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var fd = new FormData();
        var promo_logo = $('#promotion_logo').prop('files')[0];
        if(promo_logo != undefined){
            fd.append('promotion_logo',promo_logo);
        }
        var promo_banner = $('#promotion_banner').prop('files')[0];
        if(promo_banner != undefined){
            fd.append('promotion_banner',promo_banner);
        }

        // for (i=0; i < tinyMCE.editors.length; i++){
        //     var content = tinyMCE.editors[i].save();
        // }

        var title = $('#title_promo').val();
        var description = $('#description_promo').val();

        fd.append('event_id', event_id);
        fd.append('title', title);
        fd.append('description_promo', description);
        
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
                $('#modal-form-promotion').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        if(key == "description_promo"){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#cke_'+key));
                        }else{
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        }
                        $('.form-group.'+key).addClass('has-error');
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
                $("#title_promo").val(data.title);
                $("#discount").val(data.discount);
                $("#start_date").val(data.start_date);
                $("#end_date").val(data.end_date);   
                $("#promotion_code").val(data.code);   
                $("#category").val(data.category); 
                $('#div-preview_promo_logo').show(); 
                $('#div-preview_promo_banner').show();
                //$('#featured_image').val(data.featured_image);
                if(!data.currency_id){
                    var def = $("#form-event-promotion #currency_id").attr('data-default');
                    $("#form-event-promotion #currency_id").val(def);
                }else{
                    $("#form-event-promotion #currency_id").val(data.currency_id);
                }
                if(data.discount > 0){
                    $("#discount").val(data.discount);
                }else{
                    $("#discount").val('');
                }

                if(data.discount > 0){
                    $("#discount_nominal").val(data.discount_nominal);
                }else{
                    $("#discount_nominal").val('');
                }  
                if(data.discount > 0){
                    $(".discount_type-check").bootstrapSwitch('state', true); 
                    $('#discount-percent').show();
                    $('#discount-nominal').hide();
                }else{ 
                    $(".discount_type-check").bootstrapSwitch('state', false); 
                    $('#discount-percent').hide();
                    $('#discount-nominal').show();
                }
                $('#preview_promo_logo').attr('src', data.src_featured_image);  
                $('#preview_promo_banner').attr('src', data.src_banner_image);  
                if(data.featured_image != null){
                    $('#span-promotion_logo').html('<a href="javascript:void(0)" data-id="'+id+'" data-name="promotion_logo" data-value="'+data.featured_image +'" class="btn btn-danger btn-xs delete-promotion_logo" title="Delete Promotion Logo"><i class="fa fa-trash-o fa-fw"></i></a>');
                } 
                if(data.banner_image != null){
                    $('#span-promotion_banner').html('<a href="javascript:void(0)" data-id="'+id+'" data-name="promotion_banner" data-value="'+data.banner_image +'" class="btn btn-danger btn-xs delete-promotion_banner" title="Delete Promotion Banner"><i class="fa fa-trash-o fa-fw"></i></a>');
                }
                $("#description_promo").val(data.description);
                $("#link_title_more_description").val(data.link_title_more_description);
                $("#more_description").val(data.more_description);
                $("#image_link").val(data.featured_image_link);
            },
            error: function(response){
                loadDataSchedule(event_id);
                $('#modal-form-schedule').modal('hide');
                $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        });
    }

    function clearInputPromotion(){
        $("#title_promo").val('');
        $("#discount").val('');
        $("#promotion_code").val('');
        $("#promotion_logo").val('');
        $("#promotion_banner").val('');
        $('#preview_promo_logo').attr('src', '');
        $('#preview_promo_banner').attr('src', '');
        $("#discount").val('');
        $("#discount_nominal").val('');
        $(".discount_type-check").bootstrapSwitch('state', true); 
        $('#description_promo').val('');
        $('#image_link').val('');
        var currency = $("#form-event-promotion #currency_id").attr('data-default');
        $("#form-event-promotion #currency_id").val(currency);
        $('#start_date').data('datepicker').setDate(null);
        $('#end_date').data('datepicker').setDate(null);
        $('#discount-percent').show();
        $('#discount-nominal').hide();
        $("#link_title_more_description").val('');
        $('#more_description').val('');
    }

    function minPrice(event_id){
        var uri = "{{ URL::route('admin-min-price-event', "::param") }}";
        uri = uri.replace('::param', event_id);
        $.ajax({
            url: uri,
            type: "GET",
            dataType: 'json',
            success: function (response) {
                var max = parseFloat(response.data.price);
                $('#discount_nominal').attr('data-max', max);
            },
            error: function(response){
                var max = parseFloat(response.responseJSON.data);
                $('#discount_nominal').attr('data-max', max);
            }
        });
    }

    //function saveSortOrder(schedule_id, id_current, current_sort, update_sort, id_other){
    function saveSortOrderPromotion(event_id, id_current, order)
    {
        $('.error').html('');
        $.ajax({
            url: "{{ route('admin-update-promotion-sort-order') }}",
            type: "POST",
            dataType: 'json',
            data: "id_current=" + id_current + "&event_id=" + event_id + "&order=" + order,
            success: function (data) {
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        });
    }

    $(document).ready(function(){ 
        loadDataPromotion(event_id);
        
        $('#modal-form-promotion').on('click', '.delete-promotion_logo, .delete-promotion_banner', function () {
            $('#delete-modal-promotion-image').modal('show');
            $('#modal-form-promotion').modal('hide');
            var name = $(this).attr('data-name');
            var val = $(this).attr('data-value');
            var id = $(this).attr('data-id');

            $('#delete-modal-promotion-image .continue-delete').attr('data-id', id);
            $('#delete-modal-promotion-image .continue-delete').attr('data-name', name);
            $('#delete-modal-promotion-image .continue-delete').attr('data-value', val);
        });


        $('#delete-modal-promotion-image').on('click', '#btn-modal-cancel', function () {
            $('#delete-modal-promotion-image').modal('hide');
            $('#modal-form-promotion').modal('show');
        });
        $('#delete-modal-promotion-image').on('click', '.continue-delete', function () {
            var image = $(this).attr('data-value');
            var name = $(this).attr('data-name');
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-delete-promotion-image', "::param") }}";
            uri = uri.replace('::param', id);
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: name+'='+image,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    
                    $('#'+name).val('');
                    if(name == 'promotion_logo'){
                        $('#div-preview_promo_logo img').attr('src', '');
                    }else{
                       $('#div-preview_promo_banner img').attr('src', ''); 
                    }
                    $('.delete-'+name).remove();
                    $('#delete-modal-promotion-image').modal('hide');
                    $('#modal-form-promotion').modal('show');

                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

        $(document).on('click', '.sort_asc_promo',function(){
            var event_id = $(this).attr('data-event');
            var id_current = $(this).attr('data-id');
            var order = 'asc';
            saveSortOrderPromotion(event_id, id_current, order);
            loadDataPromotion(event_id);

        });

        $(document).on('click', '.sort_desc_promo',function(){
            var event_id = $(this).attr('data-event');
            var id_current = $(this).attr('data-id');
            var order = 'desc';
            saveSortOrderPromotion(event_id, id_current,order);
            loadDataPromotion(event_id);

        });
    });
    
</script>