modal_loader = function(){
    HoldOn.open({
        theme:"sk-circle",
        message:"<h4>Proccessing....</h4>"
    });
};

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

    $('.input-search-mobile').on('keyup', function(){
        var q = $(this).val();

        if(q.length >=3 ) {
            autoSearchMobile(q, sort);
        } else {
            $("#ul-search-mobile").hide();
        }
    });

    $('.language').on('click', function(){
        var lang = $(this).attr('data-lang');
        var country = $(this).attr('data-country');
        setLanguage(lang, country);

    });

    $(document).click(function(){
        $("#ul-search").hide();
    });

    $('.discover-mobile .categoryTab-mobile .dropdown').on('show.bs.dropdown', function () {
        $('.discover-mobile .categoryTab-mobile .dropdown').removeClass("active");
    });

    $('.discover-mobile .categoryTab-mobile .dropdown').on('hide.bs.dropdown', function () {
        $('.discover-mobile .categoryTab-mobile .dropdown').addClass("active");
    })

    $('.discover-mobile .eventTabScroll-mobile .dropdown').on('show.bs.dropdown', function () {
        $('.discover-mobile .eventTabScroll-mobile .dropdown').removeClass("active");
    });

    $('.discover-mobile .eventTabScroll-mobile .dropdown').on('hide.bs.dropdown', function () {
        $('.discover-mobile .eventTabScroll-mobile .dropdown').addClass("active");
    })
});

function setLanguage(lang, country)
{
    $.ajax({
        url: base_url+'/language',
        type: "GET",
        dataType: 'json',
        data: {'language':lang, 'country':country},
        success: function (response) {
            //$(country).insertAfter('.cd-dropdown-trigger img');
            location.reload();
        },
        error: function(response){
            
        }
    });
}



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
                                    + '<h5 class="all-result">All Result for "'+q+'"</h5></div></a></div>');
                        $.each(results.events,function(key,val){
                            var html = '<div class="inbox-message drawer-item">'
                                    +'<a href="'+base_url+'/event/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'">'
                                        +'<img src="'+val.featured_image3_url+'">'
                                            +'<div class="content">'
                                                +'<h5>'+val.title+'</h5>'
                                            +'<span class="footer">'+val.schedule+', '+val.venue_name+val.city+'</span>'
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

function autoSearchMobile(q, sort)
{
    $.ajax({
        url: base_url+'/search',
        type: "GET",
        dataType: 'json',
        data: {'q':q,'sort':sort},
        success: function (response) {
                setTimeout(function() {
                    $("#ul-search-mobile .append-search").html('');
                    $("#ul-search-mobile .drawer-item").remove();
                    $("#ul-search-mobile").show();
                    var results = response.data;
                    if(results.events.length > 0){
                        $("#ul-search-mobile").append('<div class="inbox-message drawer-item" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'&sort='+sort+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5 class="all-result">All Result for "'+q+'"</h5></div></a></div>');
                        $.each(results.events,function(key,val){
                            var html = '<div class="inbox-message drawer-item">'
                                    +'<a href="'+base_url+'/event/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'">'
                                        +'<img src="'+val.featured_image3_url+'">'
                                            +'<div class="content">'
                                                +'<h5>'+val.title+'</h5>'
                                            +'<span class="footer">'+val.schedule+', '+val.venue_name+val.city+'</span>'
                                    +'</div></a>'
                                +'</div>';
                            $(html).insertAfter('#ul-search-mobile  #header-search');
                        });
                    }else{
                        $("#ul-search-mobile").hide();
                    }
                }, 300);
            
        },
        error: function(response){
            
        }
    });
}

$("#eventVideo").on('hidden.bs.modal', function (e) {
    $("#eventVideo iframe").attr("src", $("#eventVideo iframe").attr("src"));
});

$(".modal-backdrop, #eventVideo .close, #eventVideo .btn").on("click", function() {
    $("#eventVideo iframe").attr("src", $("#eventVideo iframe").attr("src"));
});

$('#link_title_more_promotion').click(function(){
    $(this).hide();
});

$(document).scroll(function() {
    var y = $(this).scrollTop();
    if (y > 175) {
        $('.tabCategories').fadeIn();
    } else {
        $('.tabCategories').fadeOut();
    }
});
