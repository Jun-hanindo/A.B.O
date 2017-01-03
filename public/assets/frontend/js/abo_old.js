// Header Responsive
   $(document).ready(function(){
      $('.mobile-collapse-header').click(function() {
        if ($(window).width() < 960){
          $(this).next('ul').slideToggle();
          $(this).next('.mobileApp').slideToggle();
          $(this).next('.facebookLike').slideToggle();
          return false;
        }
      });

      // Hide Header on on scroll down
      $(window).scroll(function() {
            var y = $(window).scrollTop();
            var height = $('.contentTab').offset().top;
            var isFixed = false;
            var shouldBeFixed = y > height;
            if (shouldBeFixed && !isFixed) {
                $('.eventTabScroll').fadeIn();
                isFixed = true;
            }
            else if (!shouldBeFixed && isFixed)
            {
                $('.eventTabScroll').fadeOut();
                isFixed = false;
            }
        });

      $('.smoothScroll').on('click', function(event) {
          var target = $(this.getAttribute('href'));
          if( target.length ) {
              event.preventDefault();
              $('html, body').stop().animate({
                  scrollTop: target.offset().top -120
              }, 1000);
          }
      });

      $('.mapEvent').click(function () {
           $('.mapEvent iframe').css("pointer-events", "auto");
       });
       
       $( ".mapEvent" ).mouseleave(function() {
         $('.mapEvent iframe').css("pointer-events", "none"); 
       });

      $(window).resize(function(){
        if ($(this).width() < 960){
          $('.mobile-collapse-header').next('ul').hide();
        }else{
          $('.mobile-collapse-header').next('ul').show();
        }
      })

      $('.mobile-collapse-header-top').click(function(){
        $('.mobile-collapse-body-top').slideToggle();
      })

      $('.mobile-flag').click(function(){
      $(this).toggleClass('shown');
      $('.mobile-flag-collapse').slideToggle();
      })

      $('.lang-box').click(function(){
      $('.lang-box ul').slideUp();
      $(this).find('.lang-link').removeClass('shown')
      if ($(this).find('ul').is(':visible')){
      $('.lang-box ul').slideUp();
      $(this).find('.lang-link').removeClass('shown')
      }else{
      $(this).find('ul').slideDown();
      $('.lang-link').removeClass('shown')
      $(this).find('.lang-link').addClass('shown')
      }
      })

      $('.cd-dropdown-trigger').click(function(){
      if ($(this).is(':not(.dropdown-is-active)')){
      $('.lang-box ul').hide();
      $('.lang-link').removeClass('shown')
      }
      })


      $('.li-flag').click(function(){
      $('.li-flag ul').slideUp();
      $(this).find('.flag-expand').removeClass('shown')
      if ($(this).find('ul').is(':visible')){
      $('.li-flag ul').slideUp();
      $(this).find('.flag-expand').removeClass('shown')
      }else{
      $(this).find('ul').slideDown();
      $('.flag-expand').removeClass('shown')
      $(this).find('.flag-expand').addClass('shown')
      }
      })

      $('.mobile-flag').click(function(){
      if ($(this).is(':not(.shown)')){
      $('.li-flag ul').hide();
      $('.flag-expand').removeClass('shown')
      }
      })

      $('.mobile-search').click(function(){$('.mobile-search-show').addClass('open')})
      $('.back-menu-search').click(function(){$('.mobile-search-show').removeClass('open')})
    })
   // $(document).scroll(function() {
   //      var y = $(this).scrollTop();
   //      if (y > 800) {
   //        $('.eventTabScroll').fadeIn();
   //      } else {
   //        $('.eventTabScroll').fadeOut();
   //      }
   //    });
     $('input[name=keyword]').keyup(function(){
      if($(this).val().length)
        $('#ul-search').show();
      else
        $('#ul-search').hide();
    });
     $(".input-search").focusin(function() {
              $(".input-group-addon").css("background-color","white");
              $(".icon-search-header").css("color","black");
          });
          $(".input-search").focusout(function() {
              $(".input-group-addon").css("background-color","#292929");
              $(".icon-search-header").css("color","white");
          });
          $('.mobile-collapse-header-top').click(function(){$(this).toggleClass('open')})
          $('#carouselHacked').carousel();
          // $('#carouselHacked').carousel({
          //   interval: 1000 * 10
          // });
          setInterval(function() {
       $('.sidebar').height($('.main-content').outerHeight())
    }, 10);


    $('#general-anchor').click(function(){
      $('.faq-general-show').show(); 
      $('.main-faq-mobile').hide()
    })
    $('#top-anchor').click(function(){
      $('.faq-top-show').show(); 
      $('.main-faq-mobile').hide()
    })
    $('#seat-anchor').click(function(){
      $('.faq-seat-show').show(); 
      $('.main-faq-mobile').hide()
    })
    $('#payment-anchor').click(function(){
      $('.faq-payment-show').show(); 
      $('.main-faq-mobile').hide()
    })
    $('.back-faq').click(function(){
      $('.mobile-content-show').hide(); 
      $('.main-faq-mobile').show()
    })

    // $(window).scroll(function() {
    //         var y = $(window).scrollTop();
    //         var height = $('.discover-content').offset().top;
    //         var isFixed = false;
    //         var shouldBeFixed = y > height;
    //         if (shouldBeFixed && !isFixed) {
    //             $('.eventTabScroll').fadeIn();
    //             isFixed = true;
    //         }
    //         else if (!shouldBeFixed && isFixed)
    //         {
    //             $('.eventTabScroll').fadeOut();
    //             isFixed = false;
    //         }
    //     });

    $(document).scroll(function() {
         var y = $(this).scrollTop();
         if (y > 200) {
          $('.tabCategories').fadeIn();
         } else {
          $('.tabCategories').fadeOut();
         }
      });
//     $('.carousel-indicators li').click(function(e){
//     e.stopPropagation();
//     $('#carouselHacked').carousel($(this).data('slide-to')); 
// });
// End Header



// Footer
