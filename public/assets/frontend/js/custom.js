modal_loader = function(){
    // HoldOn.open({
    //     theme:"sk-circle",
    //     message:"<h4>Proccessing....</h4>"
    // });
    HoldOn.open({
        theme:"custom",
        content:'<img src="'+base_url+'/assets/frontend/images/logo-spin.png" class="logo-spin">',
        message:"<p>Loading...</p>"
    });
};

//var sort = $('#sort-text').val();
$(document).ready(function(){

    $("#input-search").on('keyup', function(e){
        var q = $(this).val();

        if(e.keyCode != 40 && e.keyCode != 38){
            if(q.length >=3 ) {
                autoSearch(q/*, sort*/);
            } else {
                $("#ul-search").hide();
            }
        }else{
            if (e.keyCode == 40) {
                e.preventDefault();
                $("#ul-search li").first().find('a').focus();
            }
        }
    });

    $('#ul-search').keydown(function(e) {
        if (e.keyCode == 40) {
            e.preventDefault();
            $("#ul-search a:focus").closest('li').next().find('a').focus();
        }
        if (e.keyCode == 38) {
            e.preventDefault();
            $("#ul-search a:focus").closest('li').prev().find('a').focus();
        }
    });

    $('#input-search-mobile').on('keyup', function(e){
        var q = $(this).val();

        if(e.keyCode != 40 && e.keyCode != 38){

            if(q.length >=3 ) {
                autoSearchMobile(q/*, sort*/);
            } else {
                $("#ul-search-mobile").hide();
            }
        }else{
            if (e.keyCode == 40) {
                e.preventDefault();
                $("#ul-search-mobile li").first().find('a').focus();
            }
        }
    });



    $('#ul-search-mobile').keydown(function(e) {
        if (e.keyCode == 40) {
            e.preventDefault();
            $("#ul-search-mobile a:focus").closest('li').next().find('a').focus();
        }
        if (e.keyCode == 38) {
            e.preventDefault();
            $("#ul-search-mobile a:focus").closest('li').prev().find('a').focus();
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


//function autoSearch(q, sort)
function autoSearch(q)
{
    $.ajax({
        url: base_url+'/search',
        type: "GET",
        dataType: 'json',
        //data: {'q':q,'sort':sort},
        data: {'q':q},
        success: function (response) {
                setTimeout(function() {
                    $(".append-search").html('');
                    $(".drawer-item").remove();
                    $("#ul-search").show();
                    var results = response.data;
                    if(results.events.length > 0 && results.category == null){
                        var html = '<li class="inbox-message drawer-item header-search" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>';
                    }else if(results.events.length > 0 && results.category != null){
                        if(results.category.icon != null){
                            var img = '<i class="fa fa-'+results.category.icon+'"></i>';
                        }else{
                            var img = '<img src="'+results.category.icon_image2_url+'">';
                        }

                        var html = '<li class="inbox-message drawer-item header-search" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>'
                            +'<li class="inbox-message drawer-item header-search" id="header-search2">'
                            +'<a href="'+base_url+'/search/result?q=&cat%5B%5D='+results.category.slug+'" class="btn-see-all">'
                                +'<div class="img-search">'+img+'</div><div class="content">'
                                    + '<h5 class="all-result">All '+results.category.name+'</h5></div></a></li>';
                    }else if(results.events.length == 0 && results.category != null){
                        if(results.category.icon != null){
                            var img = '<i class="fa fa-'+results.category.icon+'"></i>';
                        }else{
                            var img = '<img src="'+results.category.icon_image2_url+'">';
                        }
                        var html = '<li class="inbox-message drawer-item header-search" id="header-search2">'
                            +'<a href="'+base_url+'/search/result?q=&cat%5B%5D='+results.category.slug+'" class="btn-see-all">'
                                +'<div class="img-search">'+img+'</div><div class="content">'
                                    + '<h5 class="all-result">All '+results.category.name+'</h5></div></a></li>';
                    }else{
                        var html = '';
                    }

                    // if(results.category != null){
                    //     var cat = '<li class="inbox-message drawer-item" id="header-search">'
                    //         +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                    //             +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                    //                 + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>';
                    // }else{
                    //     var cat = '';
                    // }
                    
                    $("#ul-search").append(html);
                    if(results.events.length > 0){
                        // $("#ul-search").append('<li class="inbox-message drawer-item" id="header-search">'
                        //     //+'<a href="'+base_url+'/search/result?q='+q+'&sort='+sort+'" class="btn-see-all">'
                        //     +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                        //         +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                        //             + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>');
                        $.each(results.events,function(key,val){
                            var html = '<li class="inbox-message drawer-item">'
                                    +'<a href="'+base_url+'/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'">'
                                        +'<img src="'+val.featured_image3_url+'">'
                                            +'<div class="content">'
                                                +'<h5>'+val.title+'</h5>'
                                                +'<span class="footer">'+val.schedule+', '+val.venue_name+val.city+'</span>'
                                            +'</div></a>'
                                    +'</li>';
                            $(html).insertAfter('.header-search:last');
                        });
                    }else{
                        //$("#ul-search").hide();
                    }
                }, 500);
            
        },
        error: function(response){
            
        }
    });
}

//function autoSearchMobile(q, sort)
function autoSearchMobile(q)
{
    $.ajax({
        url: base_url+'/search',
        type: "GET",
        dataType: 'json',
        // data: {'q':q,'sort':sort},
        data: {'q':q},
        success: function (response) {
                setTimeout(function() {
                    $("#ul-search-mobile .append-search").html('');
                    $("#ul-search-mobile .drawer-item").remove();
                    $("#ul-search-mobile").show();
                    var results = response.data;
                    if(results.events.length > 0 && results.category == null){
                        var html = '<li class="inbox-message drawer-item header-search" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>';
                    }else if(results.events.length > 0 && results.category != null){
                        if(results.category.icon != null){
                            var img = '<i class="fa fa-'+results.category.icon+'"></i>';
                        }else{
                            var img = '<img src="'+results.category.icon_image2_url+'">';
                        }

                        var html = '<li class="inbox-message drawer-item header-search" id="header-search">'
                            +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                                +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                                    + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>'
                            +'<li class="inbox-message drawer-item header-search" id="header-search2">'
                            +'<a href="'+base_url+'/search/result?q=&cat%5B%5D='+results.category.slug+'" class="btn-see-all">'
                                +'<div class="img-search">'+img+'</div><div class="content">'
                                    + '<h5 class="all-result">All '+results.category.name+'</h5></div></a></li>';
                    }else if(results.events.length == 0 && results.category != null){
                        if(results.category.icon != null){
                            var img = '<i class="fa fa-'+results.category.icon+'"></i>';
                        }else{
                            var img = '<img src="'+results.category.icon_image2_url+'">';
                        }
                        var html = '<li class="inbox-message drawer-item header-search" id="header-search2">'
                            +'<a href="'+base_url+'/search/result?q=&cat%5B%5D='+results.category.slug+'" class="btn-see-all">'
                                +'<div class="img-search">'+img+'</div><div class="content">'
                                    + '<h5 class="all-result">All '+results.category.name+'</h5></div></a></li>';
                    }else{
                        var html = '';
                    }
                    $("#ul-search-mobile").append(html);

                    if(results.events.length > 0){
                        // $("#ul-search-mobile").append('<li class="inbox-message drawer-item" id="header-search">'
                        //     // +'<a href="'+base_url+'/search/result?q='+q+'&sort='+sort+'" class="btn-see-all">'
                        //     +'<a href="'+base_url+'/search/result?q='+q+'" class="btn-see-all">'
                        //         +'<div class="img-search"><i class="fa fa-search"></i></div><div class="content">'
                        //             + '<h5 class="all-result">All Results for "'+q+'"</h5></div></a></li>');
                        $.each(results.events,function(key,val){
                            var html = '<li class="inbox-message drawer-item">'
                                    +'<a href="'+base_url+'/'+val.slug+'" data-id="'+val.id+'" class="li-notif" data-id="'+val.id+'">'
                                        +'<img src="'+val.featured_image3_url+'">'
                                            +'<div class="content">'
                                                +'<h5>'+val.title+'</h5>'
                                            +'<span class="footer">'+val.schedule+', '+val.venue_name+val.city+'</span>'
                                    +'</div></a>'
                                +'</li>';
                            $(html).insertAfter('#ul-search-mobile  #header-search');
                        });
                    }else{
                        //$("#ul-search-mobile").hide();
                    }
                }, 500);
            
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
