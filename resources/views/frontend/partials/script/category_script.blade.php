@section('script')

<script type="text/javascript">
        $(document).ready(function(){

            $(".btnLoad").on('click', function(){
                var slug = $(this).attr('data-slug');
                loadCategory(slug);
            });

        });
        
        var page_content = 1;

        function loadCategory(slug)
        {
            var uri = "{{ URL::route('category-detail', "::param") }}";
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
                        var uri2 = "{{ URL::route('event-detail', "::param") }}";
                        uri2 = uri2.replace('::param', val.slug);
                        var first_date = '';
                        if(val.first_date != ''){
                            first_date = '<li class="eventDate"><i class="fa fa-calendar-o"></i> '+val.first_date+'</li>'
                        }
                        
                        var htmlTop = 
                            '<a href="'+uri2+'">'
                                +'<div class="col-md-4 box-release">'
                                    +'<img src="'+val.featured_image2_url+'">'
                                    +'<div class="boxInfo info1">'
                                        +'<ul>'
                                            +'<li class="eventType">'+val.cat_name+'</li>'
                                            +'<li class="eventName">'+val.title+'</li>'
                                            +first_date
                                            +'<li class="eventPlace">'+val.venue.name+'</li>'
                                        +'</ul>'
                                    +'</div>'
                                +'</div>'
                            +'</a>';
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