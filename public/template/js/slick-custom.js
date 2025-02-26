

(function ($) {
    // USE STRICT
    "use strict";

        /*==================================================================
        [ Slick1 ]*/
        $('.wrap-slick1').each(function(){
            var wrapSlick1 = $(this);
            var slick1 = $(this).find('.slick1');


            var itemSlick1 = $(slick1).find('.item-slick1');
            var layerSlick1 = $(slick1).find('.layer-slick1');
            var actionSlick1 = [];
            

            $(slick1).on('init', function(){
                var layerCurrentItem = $(itemSlick1[0]).find('.layer-slick1');

                for(var i=0; i<actionSlick1.length; i++) {
                    clearTimeout(actionSlick1[i]);
                }

                $(layerSlick1).each(function(){
                    $(this).removeClass($(this).data('appear') + ' visible-true');
                });

                for(var i=0; i<layerCurrentItem.length; i++) {
                    actionSlick1[i] = setTimeout(function(index) {
                        $(layerCurrentItem[index]).addClass($(layerCurrentItem[index]).data('appear') + ' visible-true');
                    },$(layerCurrentItem[i]).data('delay'),i); 
                }        
            });


            var showDot = false;
            if($(wrapSlick1).find('.wrap-slick1-dots').length > 0) {
                showDot = true;
            }

            $(slick1).slick({
                pauseOnFocus: false,
                pauseOnHover: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                speed: 1000,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 6000,
                arrows: true,
                appendArrows: $(wrapSlick1),
                prevArrow:'<button class="arrow-slick1 prev-slick1"><i class="zmdi zmdi-caret-left"></i></button>',
                nextArrow:'<button class="arrow-slick1 next-slick1"><i class="zmdi zmdi-caret-right"></i></button>',
                dots: showDot,
                appendDots: $(wrapSlick1).find('.wrap-slick1-dots'),
                dotsClass:'slick1-dots',
                customPaging: function(slick, index) {
                    var linkThumb = $(slick.$slides[index]).data('thumb');
                    var caption = $(slick.$slides[index]).data('caption');
                    return  '<img src="' + linkThumb + '">' +
                            '<span class="caption-dots-slick1">' + caption + '</span>';
                },
            });

            $(slick1).on('afterChange', function(event, slick, currentSlide){ 

                var layerCurrentItem = $(itemSlick1[currentSlide]).find('.layer-slick1');

                for(var i=0; i<actionSlick1.length; i++) {
                    clearTimeout(actionSlick1[i]);
                }

                $(layerSlick1).each(function(){
                    $(this).removeClass($(this).data('appear') + ' visible-true');
                });

                for(var i=0; i<layerCurrentItem.length; i++) {
                    actionSlick1[i] = setTimeout(function(index) {
                        $(layerCurrentItem[index]).addClass($(layerCurrentItem[index]).data('appear') + ' visible-true');
                    },$(layerCurrentItem[i]).data('delay'),i); 
                }
                         
            });

        });

      
        //     $(this).find('.slick3').slick({
        //         slidesToShow: 1,
        //         slidesToScroll: 1,
        //         fade: true,
        //         infinite: true,
        //         autoplay: false,
        //         autoplaySpeed: 6000,

        //         arrows: true,
        //         appendArrows: $(this).find('.wrap-slick3-arrows'),
        //         prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        //         nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

        //         dots: true,
        //         appendDots: $(this).find('.wrap-slick3-dots'),
        //         dotsClass:'slick3-dots',
        //         customPaging: function(slick, index) {
        //             var portrait = $(slick.$slides[index]).data('thumb');
        //             return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
        //         },  
        //     });
        // });
            
                

})(jQuery);