@section('script')

<script type="text/javascript">
    setInterval(function() {
       $('.sidebar').height($('.main-content').outerHeight())
    }, 10);

        $(document).ready(function(){

            $("#modalContact .btnFeedback").on('click', function(){
                sendMessage();
            });
            $("#modalNo .btnFeedback").on('click', function(){
                feedback();
            });

            $(".contact a, .btnAbout, .ask a, #client, #partner").on('click', function(){
                clearInputMessage();
                var id = $(this).attr('id');
                console.log(id);
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

        function faqSearch(q)
        {
            var text = $('.ul-faq-content').html();
            console.log(text);
        }

        function sendMessage()
        {
            //modal_loader();
            var data = $('#message-form').serialize();
            $.ajax({
                url: "{{ route('send-message') }}",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#modalYes').modal('show');
                    $('#modalContact').modal('hide');
                    clearInputMessage();
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
                        // $('#modalYes').modal('show');
                        // $('#modalContact').modal('hide');
                        $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        
                    }
                }
            });
        }

        function feedback(){
            var data = $('#feedback-form').serialize();
            $.ajax({
                url: "{{ route('send-feedback') }}",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#modalYes').modal('show');
                    $('#modalNo').modal('hide');
                    clearInputMessage();
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
                        // $('#modalYes').modal('show');
                        // $('#modalContact').modal('hide');
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