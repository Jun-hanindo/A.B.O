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
                                +'<a href="#promoModal'+val.ep_id+'" data-toggle="modal">'
                                    +'<img src="'+val.featured_image2_url+'" class="image-promo">'
                                    +'<div class="boxInfo promo1">'
                                        +'<ul>'
                                            +'<li class="eventType">'+val.category+'</li>'
                                            +'<li class="eventName">'+val.promo_title+'<img src="'+val.featured_image_url+'"></li>'
                                            +'<br>'
                                            +'<li class="eventPlace">Valid from '+val.valid+'</li>'
                                        +'</ul>'
                                    +'</div>'
                                +'</a>'
                                +'<div class="modal fade promoModal" id="promoModal'+val.ep_id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'
                                    +'<div class="modal-dialog" role="document">'
                                        +'<div class="modal-content">'
                                            +'<div class="modal-header">'
                                                +'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                                +'<h4 class="modal-title" id="myModalLabel">'+val.promo_title+'</h4>'
                                            +'</div>'
                                            +'<div class="modal-body">'
                                                +'<div class="promoBanner">'
                                                    +'<img src="'+val.featured_image1_url+'">'
                                                +'</div>'
                                                +'<div class="descPromoModal">'
                                                    +'<h4>About This Promotion</h4>'
                                                    +'<div class="promoBannerDesc">'
                                                        +'<div class="row">'
                                                            +'<div class="col-md-9">'
                                                                +'<p>'+val.promo_desc+'</p>'
                                                            +'</div>'
                                                            +'<div class="col-md-3">'
                                                                +'<img src="'+val.featured_image_url+'" class="promoLogo">'
                                                            +'</div>'
                                                        +'</div>'
                                                    +'</div>'
                                                    +'<p>Discount: '+val.disc+'</p>'
                                                    +'<h4>Promotion Period</h4>'
                                                    +'<p>Start Date:'+val.start_date+'</p>'
                                                    +'<br>'
                                                    +'<p>End Date:'+val.end_date+'</p>'
                                                +'</div>'
                                            +'</div>'
                                            +'<div class="modal-footer">'
                                                +'<div class="row">'
                                                    +'<div class="col-md-8">'
                                                        +'<h4>Get Your Early Bird Tickets Now!</h4>'
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