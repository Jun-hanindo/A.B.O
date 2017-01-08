<script type="text/javascript">
    
    function iconSwitch(){
        var val = $('.switch_icon').is(":checked") ? true : false;
        if(val){
            $('#icon-div').show();
            $('#icon_image-div, #icon_image-height, #icon_image-size').hide();
        }else{
            $('#icon-div').hide();
            $('#icon_image-div, #icon_image-height, #icon_image-size').show();
        }
    }

    function saveCat()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        var name = $("#name-cat").val();
        var icon = $("#icon-cat").val();
        var description = $("#description-cat").val();

        var fd = new FormData();
        var icon_image = $('#icon_image-cat').prop('files')[0];
        if(icon_image != undefined){
            fd.append('icon_image',icon_image);
        }
        var icon_image2 = $('#icon_image2-cat').prop('files')[0];
        if(icon_image2 != undefined){
            fd.append('icon_image2',icon_image2);
        }
        fd.append('name', name);
        fd.append('icon', icon);
        fd.append('description', description);
        var other_data = $('#form-cat').serializeArray();
        $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
        });
        $.ajax({
            url: "{{ route('admin-post-event-category') }}",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            data: fd,
            success: function (data) {
                HoldOn.close();
                var segment = "{{ Request::segment(3) }}";
                if(segment == "category"){
                    loadData();
                }else{
                    $("select.categories").append('<option value="'+data.last_id+'" selected="selected">'+name+'</option>');
                    var existingData = $(".categories").select2("data");
                    existingData.push({ id: data.last_id, text: name });
                    $(".categories").select2("data", existingData);
                }
                $('#modal-form-cat').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        if(key == "description"){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#cke_'+key+'-cat'));
                        }else{
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key+'-cat'));
                        }
                        $('.form-group.'+key+'-cat').addClass('has-error');
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
        $("#id-cat").val('');
        $("#description-cat").val('');
        $("#icon_image-cat").val('');
        $('#preview_icon_image').attr('src', '');
        $("#icon_image2-cat").val('');
        $('#preview_icon_image2').attr('src', '');
    }
</script>