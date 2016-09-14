@section('script')

<script type="text/javascript">

        $(document).ready(function(){

            $(".btnFeedback").on('click', function(){
                sendMessage();
            });

            $(".contact a, .btnAbout").on('click', function(){
                clearInputMessage();
                var id = $(this).attr('id');
                $('#subject #'+id).prop('selected', true);
            });

            $("#client, #partner").on('click', function(){
                var id = $(this).attr('id');
                $('#subject #'+id).prop('selected', true);
            });


        });

        function sendMessage()
        {
            //modal_loader();
            var data = $('#messageBox').serialize();
            $.ajax({
                url: "{{ route('send-message') }}",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#modalYes').modal('show');
                    $('#modalContact').modal('hide');
                },
                error: function(response){
                    // $('#modalYes').modal('show');
                    // $('#modalContact').modal('hide');
                    if (response.status === 422) {
                        var data = response.responseJSON;
                        $.each(data,function(key,val){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                            $('.'+key).addClass('has-error');
                        });
                    } else {
                        $('#modalYes').modal('show');
                        $('#modalContact').modal('hide');
                        $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        
                    }
                }
            });
        }

        function clearInputMessage(){
            $('input, textarea').val('');
            $('.tooltip-field').remove();
            $('.error-modal').html('');
        }

</script>

@endsection