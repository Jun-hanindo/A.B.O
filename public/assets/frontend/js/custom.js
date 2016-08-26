
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
    $(document).click(function(){
        $("#ul-search").hide();
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
                        $("#ul-search").append('<div class="inbox-message drawer-item" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'&sort='+sort+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5>All Result for "'+q+'"</h5></div></a></div>');
                        $.each(results.events,function(key,val){
                            var html = '<div class="inbox-message drawer-item">'
                                    +'<a href="'+base_url+'/event/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'">'
                                        +'<img src="'+val.featured_image3_url+'">'
                                            +'<div class="content">'
                                                +'<h5>'+val.title+'</h5>'
                                            +'<span class="footer">'+val.date_set+', '+val.venue+'</span>'
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