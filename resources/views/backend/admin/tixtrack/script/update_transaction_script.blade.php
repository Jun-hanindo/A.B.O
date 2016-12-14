@section('scripts')

    <script>

    // function swapAccount(account)
    // {
    //     $('.error-account').removeClass('alert alert-danger');
    //     $('.error-account').html('');
    //     modal_loader();
    //     $.ajax({
    //         url: "{{ route('admin-tixtrack-swap-account') }}",
    //         type: "PUT",
    //         dataType: 'json',
    //         data: {'account':account},
    //         success: function (data) {
    //             HoldOn.close();
    //             // if(data.code == 200){
    //             //     $('#transaction-row').show();
    //             // }else{
    //             //     $('#transaction-row').hide();
    //             // }
    //             $('.error-account').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    //         },
    //         error: function(response){
    //             HoldOn.close();
    //             //$('#transaction-row').hide();
    //             $('.error-account').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    //         }
    //     });
    // }

    $(document).ready(function() {
        $('#button_update').click(function(){
            modal_loader();
        });
        // $('#swap-account').on('change', function(){
        //     var account = $(this).val();
        //     swapAccount(account);
        // });

        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();

        $('#start_date').datepicker({
            format: "yyyy-mm-dd",
            endDate: end_date,
        }).on('changeDate', function(){
            $('#end_date').datepicker('setStartDate', new Date($('#start_date').val()));
        });

        $('#end_date').datepicker({
            format: "yyyy-mm-dd",
            startDate: start_date,
            endDate: end_date,
        }).on('changeDate', function(){
            $('#start_date').datepicker('setEndDate', new Date($('#end_date').val()));
        });

    });
        
    
    </script>
@endsection