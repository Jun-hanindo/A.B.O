@section('script')

<script type="text/javascript">
        $(document).ready(function(){
            var page_content = 1;

            $(".btnLoad").on('click', function(){
                page_content += 1;
                loadDiscover(page_content);
            });

        });

        function loadDiscover(page)
        {
            $.ajax({
                url: "{{ route('discover') }}",
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
                        var uri = "{{ URL::route('event-detail', "::param") }}";
                        uri = uri.replace('::param', val.slug);
                        var first_date = '';
                        if(val.first_date != ''){
                            first_date = '<li class="eventDate"><i class="fa fa-calendar-o"></i> '+val.first_date+'</li>'
                        }
                        
                        var htmlTop = 
                            '<a href="'+uri+'">'
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