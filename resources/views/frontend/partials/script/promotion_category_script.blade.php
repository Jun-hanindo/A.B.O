@section('script')

<script type="text/javascript">
        $(document).ready(function(){

            $(".btnLoad").on('click', function(){
                var slug = $(this).attr('data-slug');
                loadPromotion(slug);
            });

        });
            
        var page_content = 1;

        function loadPromotion(slug)
        {
            var uri = "{{ URL::route('promotion-detail', "::param") }}";
                uri = uri.replace('::param', slug);
            page_content += 1;
            $.ajax({
                url: uri,
                type: "GET",
                dataType: 'json',
                data: {'page':page_content},
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
                                        +'<li class="eventPlace">Valid from '+val.start+' - '+val.end+'</li>'
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