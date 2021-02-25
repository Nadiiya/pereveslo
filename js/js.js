(function ($) {

    $(document).ready(function () {

        $(function () {
            $('.item').matchHeight();
            $('.publ-others').matchHeight();
            $('.newspaper').matchHeight();
            $('.book').matchHeight();
            $('.authors-slider__item').matchHeight();
            $('.post-card__title').matchHeight();
        });

        // slider settings
        $('.slide').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            mobileFirst: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            adaptiveHeight: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        //burgerMenu
        function burgerMenu() {
            if ($(window).width() > 1024) {
                $('body').removeClass('mobile-window');

            } else {
                $('body').addClass('mobile-window');

            }
        }

        //burger toggle
        burgerMenu();
        $('.burger').on('click', function () {
            $('.main-menu').toggleClass('main-menu--open');
            $('.main-menu').toggle(500);
        });


        $(window).resize(function () {
            if ($(window).width() > 1024) {
                $('.main-menu').removeAttr('style');
                $('.main-menu').removeClass('main-menu--open');
            }
            burgerMenu();
        });

        // Add fancybox to images
        $('.fancybox, a[href$="jpg"], a[href$="png"], a[href$="gif"]').fancybox({
            minHeight: 0,
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });

        //fancybox settings
        $('[data-fancybox]').fancybox({

            titleShow: true,
            titlePosition: 'outside',
            buttons: [
                'zoom',
                'thumbs',
                'close'
            ],
            caption: function (instance, item) {
                return $(this).attr('title');
            }

        });
    });

}(jQuery));