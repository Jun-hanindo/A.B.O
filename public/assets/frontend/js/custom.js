
var sort = $('#sort-text').val();
$(document).ready(function(){
    $(".input-search").on('keyup', function(){
        var q = $(this).val();

        if(q.length >=3 ) {
            autoSearch(q, sort);
        } else {
            $("#ul-search").hide();
        }
    });
});



function autoSearch(q, sort)
{
    $.ajax({
        url: base_url+'/search',
        type: "GET",
        dataType: 'json',
        data: {'q':q,'sort':sort},
        success: function (response) {
                setTimeout(function() {
                    $(".append-search").html('');
                    $(".drawer-item").remove();
                    $("#ul-search").show();
                    var results = response.data;
                    if(results.events.length > 0){
                        $("#ul-search").append('<div class="inbox-message drawer-item" id="header-search" style="height:80px;">'
                            +'<a style="display:block;padding:10px;height:100%" href="'+base_url+'/search/result?q='+q+'&sort='+sort+'" class="btn-see-all">'
                                +'<div class="content" style="float:left;padding-left:20px;">'
                                    + '<h5 style="color:#000;">All Result for "'+q+'"</h5></div></a></div>');
                        $.each(results.events,function(key,val){
                            var html = '<div class="inbox-message drawer-item" style="border-top:1px solid #ddd;height:80px;">'
                                    +'<a href="'+base_url+'/event/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'" style="display:block;padding:10px;height:100%">'
                                        +'<img style="height:100%;float:left;" src="'+val.featured_image3_url+'"></span></span>'
                                            +'<div class="content" style="float:left;padding-left:20px;">'
                                                +'<h5 style="color:#000;">'+val.title+'</h5>'
                                            +'<span class="footer" style="color:#bdbdbd;font-size: 13px;">'+val.date_set+', '+val.venue+'</span></span>'
                                        +'</span>'
                                    +'</div></a>'
                                +'</div>';
                            $(html).insertAfter('#header-search');
                        });
                    }else{
                        $("#ul-search").hide();
                    }
                }, 300);
            
        },
        error: function(response){
            
        }
    });
}