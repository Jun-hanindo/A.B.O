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
                        if(val.discount> 0){
                            var discount = val.discount;
                        }else{
                            if(val.symbol_left === null){
                                var symbol_left = '';
                            }else{
                                var symbol_left = val.symbol_left;
                            }
                            if(val.symbol_right === null){
                                var symbol_right = '';
                            }else{
                                var symbol_right = val.symbol_right;
                            }
                            var discount = symbol_left+val.discount_nominal+symbol_right;
                        }
                        var htmlTop = 
                            '<div class="col-md-4 box-promo">'
                                +'<a href="#promoModal'+val.ep_id+'" data-toggle="modal">'
                                    +'<img src="'+val.featured_image2_url+'" class="image-promo">'
                                    +'<div class="boxInfo promo1">'
                                        +'<ul>'
                                            +'<li class="eventType">'+val.category+'</li>'
                                            +'<li class="eventName">'+val.promo_title+'<img src="'+val.featured_image_url+'"></li>'
                                            +'<br>'
                                            +'<li class="eventPlace">Valid from '+val.valid_date+'</li>'
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
                                                    +'<img height="166px" src="'+val.featured_image1_url+'">'
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
                                                    +'<p>Discount: '+discount+'</p>'
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