@section('script')

<script type="text/javascript">

        $(document).ready(function(){

            $("#btnSubscribe").on('click', function(){
                subscribe();
            });
            $("#modalNo .btnFeedback").on('click', function(){
                feedback();
            });

            $(".contact a, .btnAbout, .ask a, #client, #partner").on('click', function(){
                clearInputMessage();
                var id = $(this).attr('id');
                $('#subject #'+id).prop('selected', true);
            });
            
            $(".faq-search").on('keyup', function(){
                var q = $(this).val();

                if(q.length >=3 ) {
                    faqSearch(q);
                } else {
                    $("#ul-search").hide();
                }
            });


        });

        function subscribe()
        {
            //modal_loader();
            var data = $('#form-subscribe').serialize();
            $.ajax({
                url: "{{ route('subscribe-store') }}",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#modalSubscribe').modal('show');
                    clearInput();

                },
                error: function(response){
                    $('.tooltip-field').remove();
                    if (response.status === 422) {
                        var data = response.responseJSON;
                        $.each(data,function(key,val){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                            $('.'+key).addClass('has-error');
                        });
                    } else {
                        $('.error').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        
                    }
                }
            });
        }

        function clearInput(){
            $('input').val('');
            $('.tooltip-field').remove();
            $('.error').html('');
        }

</script>

@endsection