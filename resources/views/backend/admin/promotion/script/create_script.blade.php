@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();
        loadSwitchButton('discount_type-check');
        discountSwitch();

        $(".datepicker").datepicker( {
            format: "yyyy-mm-dd",
        });

        $('.image').change(function(){
            var name = $(this).attr('data-name');
            $("#div-preview_"+name).show();
            preview(this,$(this).data('type'),name);
        });

        $('#form-promotion').on('switchChange.bootstrapSwitch', '.discount_type-check', function(event, state) {
            discountSwitch();
        });

        $('.delete-promotion_logo, .delete-promotion_banner').on('click', function () {
            $('#delete-modal2').modal('show');
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var value = $(this).attr('data-value');
            var title = $(this).attr('data-title');

            $('#delete-modal2 .continue-delete').attr('data-id', id);
            $('#delete-modal2 .continue-delete').attr('data-name', name);
            $('#delete-modal2 .continue-delete').attr('data-value', value);
            $('#delete-modal2 #name').html(title);
        });


        $('#delete-modal2').on('click', '.continue-delete', function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var value = $(this).attr('data-value');
            var uri = "{{ URL::route('admin-delete-promotion-image', "::param") }}";
            uri = uri.replace('::param', id);
            modal_loader();
            $.ajax({
                url: uri,
                type: "POST",
                dataType: 'json',
                data: name+'='+value,
                success: function (data) {
                    $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    
                    $('#'+name).val('');
                    if(name == 'promotion_logo'){
                        $('#div-preview_promo_logo img').attr('src', '');
                    }else{
                       $('#div-preview_promo_banner img').attr('src', ''); 
                    }
                    $('.delete-'+name).remove();
                    HoldOn.close();

                },
                error: function(response){
                    HoldOn.close();
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

    });
    
    </script>
@endsection