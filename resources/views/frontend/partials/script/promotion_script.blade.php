@section('script')

<script type="text/javascript">
        $(document).ready(function(){
            var page_content = 1;

            $(".btnLoad").on('click', function(){
                page_content += 1;
                loadPromotion(page_content);
            });

        });

        function loadPromotion(page)
        {
            $.ajax({
                url: "{{ route('promotion') }}",
                type: "GET",
                dataType: 'json',
                data: {'page':page},
                success: function (response) {
                    if(response.data.next_page_url == null ) {
                        $(".loadMore").hide();
                    } else {
                        $(".loadMore").show();
                    }
                    var events = response.data.data;
                    $.each(events,function(key,val){
                        var htmlTop = 
                            '<div class="col-md-4 box-promo">'
                                +'<img src="'+val.featured_image2_url+'" class="image-promo">'
                                +'<div class="boxInfo promo1">'
                                    +'<ul>'
                                        +'<li class="eventType">'+val.category+'</li>'
                                        +'<li class="eventName">'+val.promo_title+'<img src="'+val.featured_image_url+'"></li>'
                                        +'<li class="eventPlace">Valid from '+val.valid_date+'</li>'
                                    +'</ul>'
                                +'</div>'
                            +'</div>';
                        $(".append-events").append(htmlTop);
                    });
                },
                error: function(response){
                    $(".append-events").append(response.responseJSON.message);
                }
            });
        }

</script>

@endsection