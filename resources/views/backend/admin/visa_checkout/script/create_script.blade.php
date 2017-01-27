@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();

        $('.image').change(function(){
            var name = $(this).attr('data-name');
            $("#div-preview_"+name).show();
            preview(this,$(this).data('type'),name);
        });

        // $('.delete-banner_image, .delete-banner_image_mobile').on('click', function () {
        //     $('#delete-modal2').modal('show');
        //     var id = $(this).attr('data-id');
        //     var name = $(this).attr('data-name');
        //     var value = $(this).attr('data-value');
        //     var title = $(this).attr('data-title');

        //     $('#delete-modal2 .continue-delete').attr('data-id', id);
        //     $('#delete-modal2 .continue-delete').attr('data-name', name);
        //     $('#delete-modal2 .continue-delete').attr('data-value', value);
        //     $('#delete-modal2 #name').html(title);
        // });


        // $('#delete-modal2').on('click', '.continue-delete', function () {
        //     var id = $(this).attr('data-id');
        //     var name = $(this).attr('data-name');
        //     var value = $(this).attr('data-value');
        //     var uri = "{{ URL::route('admin-delete-visa-checkout-image', "::param") }}";
        //     uri = uri.replace('::param', id);
        //     modal_loader();
        //     $.ajax({
        //         url: uri,
        //         type: "POST",
        //         dataType: 'json',
        //         data: name+'='+value,
        //         success: function (data) {
        //             $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                    
        //             $('#'+name).val('');
        //             $('#div-preview_'+name+' img').attr('src', '');
        //             $('.delete-'+name).remove();
        //             HoldOn.close();

        //         },
        //         error: function(response){
        //             HoldOn.close();
        //             $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
        //         }
        //     });
        // });

    });
        
    
    </script>
@endsection