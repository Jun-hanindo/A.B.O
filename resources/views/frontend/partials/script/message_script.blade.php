@section('script')

<script type="text/javascript">

        $(document).ready(function(){

            $("#btn-message").on('click', function(){
                sendMessage();
            });

            $(".contact a, .btnAbout").on('click', function(){
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
            var data = $('#messageBox').serialize();
            $.ajax({
                url: "{{ route('send-message') }}",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#modalYes').modal('show');
                    $('#modalNo').modal('hide');
                },
                error: function(response){
                    $('#modalYes').modal('show');
                    $('#modalNo').modal('hide');
                }
            });
        }

        function resetFilterSearch(){
            $('.cat-filter').prop('checked', false);
            $('#filter-venue').val('all');
            $('#filter-period').val('all');
        }

</script>

@endsection