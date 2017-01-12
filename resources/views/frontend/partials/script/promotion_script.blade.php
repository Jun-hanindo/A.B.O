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
                        if(val.banner_image != null){
                            if(val.featured_image_link != null){
                                var img = '<a href="'+val.featured_image_link+'" target="_blank">'
                                    +'<img class="promoBanner" src="'+val.banner_image_url+'">'
                                +'</a>'; 
                            }else{
                                var img = '<a>'
                                    +'<img class="promoBanner" src="'+val.banner_image_url+'">'
                                +'</a>';
                            } 
                        }else{
                            if(val.featured_image != null){
                                if(val.featured_image_link != null){
                                    var img = '<a href="'+val.featured_image_link+'" target="_blank">'
                                        +'<img class="promoBanner" src="'+val.featured_image_url+'" onload="this.width/=2;this.onload=null;">'
                                    +'</a>'; 
                                }else{
                                    var img = '<a>'
                                        +'<img class="promoBanner" src="'+val.featured_image_url+'" onload="this.width/=2;this.onload=null;">'
                                    +'</a>';
                                } 
                            }
                        }

                        if(val.disc != ''){
                            var disc = '<p>{{ trans("general.discount") }}: ' 
                                +val.disc+'</p>';
                        }else{
                            var disc = '';
                        }

                        if(val.link_title_more_description != ''){
                            var link_more = '<a id="link_title_more_promotion" class="collapsed" data-toggle="collapse" href="#more_description'+val.ep_id+'" aria-expanded="false"><u>'+val.link_title_more_description+'</u></a>';
                        }else{
                            var link_more = '';
                        }
                        if(val.more_description != ''){
                            var more_desc = '<span class="collapse" id="more_description'+val.ep_id+'">'+val.more_description+'</span>';
                        }else{
                            var more_desc = '';
                        }
                        if(val.start_date != ''){
                            var start = '<h4>{{ trans("frontend/general.promotion_period") }}</h4>'
                                +'<p>{{ trans("frontend/general.start_date") }}: '+val.start_date+'</p>'
                                + '<br>'
                        }else{
                            var start = '';
                        }
                        if(val.end_date != ''){
                            var end = '<p>{{ trans("frontend/general.end_date") }}: '+val.end_date+'</p>';
                        }else{
                            var end = '';
                        }

                        var htmlTop = 
                            '<div class="col-md-4 box-promo">'
                                +'<a href="#promoModal'+val.ep_id+'" data-toggle="modal">'
                                    +'<img src="'+val.featured_image2_url+'" class="image-promo">'
                                    +'<div class="boxInfo promo1">'
                                        +'<ul>'
                                            +'<li class="eventType">'+val.category+'</li>'
                                            +'<li class="eventName">'
                                                +'<div class="col-md-9 col-xs-9 promoNameThumb" >'+val.promo_title+'</div> '
                                                +'<div class="col-md-3 col-xs-3 promoLogoThumb" >'+'<img src="'+val.featured_image_url+'" onload="this.width/=2;this.onload=null;"></div> '
                                            +'</li>'
                                        +'</ul>'
                                    +'</div>'
                                +'</a>'
                                +'<div class="modal fade promoModal full-modal" id="promoModal'+val.ep_id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'
                                    +'<div class="modal-dialog" role="document">'
                                        +'<div class="modal-content">'
                                            +'<div class="modal-header">'
                                                +'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                                +'<h4 class="modal-title" id="myModalLabel">'+val.category+' - '+val.title+'</h4>'
                                            +'</div>'
                                            +'<div class="modal-body">'
                                                +'<div class="desc-promo-modal">'
                                                    +'<div class="promoBanner">'
                                                        +'<img src="'+val.featured_image1_url+'" class="promo-modal-web">'
                                                        +'<img src="'+val.featured_image2_url+'" class="promo-modal-mobile">'
                                                    +'</div>'
                                                    +'<div class="descPromoModal">'
                                                        +'<div class="promoBannerDesc">'
                                                            +'<div class="row">'
                                                                +'<div class="col-md-12 col-xs-12">'
                                                                    +img
                                                                    +'<h3 class="font-bold">'+val.promo_title+'</h3>'
                                                                    +val.promo_desc
                                                                    +link_more
                                                                    +more_desc
                                                                +'</div>'
                                                            +'</div>'
                                                        +'</div>'
                                                        +disc
                                                        +start
                                                        +end
                                                    +'</div>'
                                                +'</div>'
                                            +'</div>'
                                            +'<div class="modal-footer">'
                                                +'<div class="row">'
                                                    +'<div class="col-md-8">'
                                                        +'<h4>Enjoy This Promotion Now</h4>'
                                                    +'</div>'
                                                    +'<div class="col-md-4">'
                                                        +'<form action="'+val.buylink+'">'
                                                            +'<button type="button" class="btn btn-primary">Buy Now</button>'
                                                        +'</form> '
                                                    +'</div>'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
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