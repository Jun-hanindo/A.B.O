<script type="text/javascript">
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
        $.ajax({
            url: "{{ route('admin-post-event-category') }}",
            type: "POST",
            dataType: 'json',
            data: {'name':name,"description":description,"icon":icon},
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
    }
</script>