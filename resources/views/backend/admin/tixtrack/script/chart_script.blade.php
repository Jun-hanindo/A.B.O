@section('scripts')

    <script>
    $(document).ready(function() {

    });

    function chartCategory()
    {
        
        $.ajax({
            url: "{{ route('admin-post-homepage') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form").serialize() + "&category=" + category,
            success: function (data) {
                HoldOn.close();
                if(category == 'slider'){
                    loadDataSlider();
                }else if(category == 'event'){
                    loadDataEvent();
                }else{
                    loadDataPromotion();
                }
                $('#modal-form').modal('hide');
                $('.error-'+category).html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            },
            error: function(response){
                HoldOn.close();
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                        $('.'+key).addClass('has-error');
                    });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
            }
        });
    }

    // var cat = document.getElementById("category_chart").getContext("2d");
    // var catChart = new Chart(cat, {
    //     type: 'line',
    //     data: data,
    // });

    </script>
@endsection