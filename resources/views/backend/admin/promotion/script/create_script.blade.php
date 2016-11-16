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
            $('#delete-modal-promotion-image').modal('show');
            var name = $(this).attr('data-name');
            var val = $(this).attr('data-value');
            var id = $(this).attr('data-id');

            $('#delete-modal-promotion-image .continue-delete').attr('data-id', id);
            $('#delete-modal-promotion-image .continue-delete').attr('data-name', name);
            $('#delete-modal-promotion-image .continue-delete').attr('data-value', val);
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

                },
                error: function(response){
                    $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            });
        });

    });
    
    </script>
@endsection