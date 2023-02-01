(function ($) {

    "use strict";

    /* ---------------------------------------------

    Navigation menu

    --------------------------------------------- */

    // dropdown for mobile
    /* is_exist() */
    jQuery.fn.is_exist = function(){
        return this.length;
    }


    $(window).load(function () {

    })

  var XmozeGlobal = function ($scope, $) {
    if ($scope.hasClass('xmoze-sticky-yes')) {
      var current_widget = $scope;
      current_widget.wrap('<div class="sticky-wrapper"></div>');
      var headerHeight = $(current_widget).parent('.sticky-wrapper').height(),
        stickyWrapper = $(current_widget).parent('.sticky-wrapper');
      stickyWrapper.css('height', headerHeight + "px")
      window.onscroll = function () {
        scrollFunction()
      };

      function scrollFunction() {

        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
          if ($scope.hasClass('xmoze-sticky-yes')) {
            stickyWrapper.addClass("is-sticky");
            console.log(stickyWrapper);
          }
        } else {
          if ($scope.hasClass('xmoze-sticky-yes')) {
            stickyWrapper.removeClass("is-sticky");
          }
        }
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
          if ($scope.hasClass('xmoze-sticky-yes')) {
            $scope.addClass("reveal-sticky");
          }
        } else {
          if ($scope.hasClass('xmoze-sticky-yes')) {
            $scope.removeClass("reveal-sticky");
          }
        }

      }

    }
  }

    var XmozeductCategories = function () {
        if ($.fn.isotope) {
            var $gridMas = $('.product-categories-wrap.masonry');

            $gridMas.isotope({
                itemSelector: '.xmoze-product-cat-wrap',
                percentPosition: true,
                layoutMode: 'packery',
            })

            $gridMas.imagesLoaded().progress(function () {
                $gridMas.isotope()
            });
        }
    }

    var XmozePostLoop = function () {
        if ($.fn.isotope) {

            $('.xmoze-post-widget-area.masonry').isotope({
                itemSelector: '.xmoze-post-widget-area.masonry>div',
                percentPosition: true,
                layoutMode: 'packery',
            })

        }
    }


    //portfolio gallery js start
    var Xmoze_Portfolio_Gallery_Js = function ($scope , $) {

        if ($.fn.isotope) {
                var gridMas = $('.xmoze-pf-gallery-wrap.layout-mode-masonry');

                gridMas.isotope({
                    itemSelector: '.xmoze-pf-gallery-wrap .xmoze-portfolio-item-wrap',
                    percentPosition: true,
                    layoutMode: 'packery',
                }).resize();

                gridMas.imagesLoaded().progress(function () {
                    gridMas.isotope()
                });
        }


        if ($(".xmoze-pf-gallery-slider").length > 0) {
            var wrapper = $scope.find(".xmoze-pf-gallery-slider");
            if (wrapper.length === 0)
                return;
            var settings = wrapper.data('settings');

            wrapper.slick({
                infinite: settings['loop'],
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay:  settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: settings['nav'],
                prevArrow: '<button type="button" class="xmoze-slick-prev">'+ settings.prev_icon +'</button>',
                nextArrow: '<button type="button" class="xmoze-slick-next">'+ settings.next_icon +'</button>',
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                lazyLoad: 'ondemand',
                dotsClass: "xmoze-pf-gallery-slider-dots",
                responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                        },
                    },
                    {
                        breakpoint: 450,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                        },
                    },
                ],
            });

        }
    }



    var Xmoze_Team_Js = function ($scope , $) {

        var wrapper = $scope.find(".team-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
            wrapper.slick({
                infinite: true,
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay: settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: settings['nav'],
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                lazyLoad: 'ondemand',
                dotsClass: "team-slider-dot-list",
                swipe: true,
                appendArrows: '.team-slider-arrow',
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                responsive: [{
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: settings['per_coulmn'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                            slidesToScroll: 1,
                        },
                    },
                ],
            });

            $(document).ready(function() {
                $('.team-slider-arrow button').click(function() {
                    $('.team-slider-arrow button').removeClass("slick-active");
                    $(this).addClass("slick-active");
                });
            });


    }

    var Xmoze_Testimonial_Js = function ($scope , $) {

        var wrapper = $scope.find(".testimonial-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
            wrapper.slick({
                infinite: true,
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay: settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: settings['nav'],
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                lazyLoad: 'ondemand',
                centerMode: settings['show_center_mode'],
                dotsClass: "testimonial-slider-dot-list",
                swipe: true,
                vertical: settings['show_vertical'],
                appendArrows: '.team-slider-arrow',
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                responsive: [{
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: settings['per_coulmn'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                            slidesToScroll: 1,
                            vertical: false,
                        },
                    },
                ],
            });
    }


    //portfolio js start
    var Xmoze_Portfolio_Js = function ($scope,$) {
        if ($.fn.isotope) {

                var $gridMas = $('.xmoze-portfolio-wrap.layout-mode-masonry');
                var $grid = $('.xmoze-portfolio-wrap.layout-mode-normal.enable-filter-yes');

                $grid.isotope({
                    itemSelector: '.xmoze-portfolio-item-wrap',
                    percentPosition: true,
                    layoutMode: 'fitRows',
                }).resize()

                $grid.imagesLoaded().progress(function () {
                    $grid.isotope('layout')
                }).resize();

                $gridMas.isotope({
                    itemSelector: '.xmoze-portfolio-item-wrap',
                    percentPosition: true,
                    layoutMode: 'packery',
                })

                $gridMas.imagesLoaded().progress(function () {
                    $gridMas.isotope('layout')
                });

                $grid.isotope().resize();
                $gridMas.isotope().resize();

                $(".pf-isotope-nav li").on('click', function () {
                    $(".pf-isotope-nav li").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    $gridMas.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: "linear",
                            queue: false,
                        }
                    });

                    var selector = $(this).attr("data-filter");
                    $grid.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: "linear",
                            queue: false,
                        }
                    });


                });

        }

        //Portfolio slider

        var wrapper = $scope.find(".portfolio-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
            wrapper.slick({
                infinite: true,
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay: settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: settings['nav'],
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                lazyLoad: 'ondemand',
                dotsClass: "portfolio-slider-dot-list",
                swipe: true,
                appendArrows: '.portfolio-slider-arrow',
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                responsive: [{
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: settings['per_coulmn'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                            slidesToScroll: 1,
                        },
                    },
                ],
            });

        // comment load more button click event
        $('.xmoze-pf-loadmore-btn').on('click', function () {
            var button = $(this);

            // decrease the current comment page value
            var dpaged = button.data('paged'),
                total_pages = button.data('total-page'),
                nonce = button.data('referrar'),
                ajaxurl = button.data('url');

            dpaged++;
            // console.log(foio_portfolio_js_datas);
            $.ajax({
                url: ajaxurl, // AJAX handler, declared before
                dataType: 'html',
                data: {
                    'action': 'xmoze_loadmore_callback', // wp_ajax_cloadmore
                    // 'post_id': foio_portfolio_js_datas.parent_post_id, // the current post
                    'paged': dpaged, // current comment page
                    'folio_nonce': nonce,
                    'portfolio_settings': button.data('portfolio-settings'),
                },
                type: 'POST',
                beforeSend: function (xhr) {
                    button.text('Loading...'); // preloader here
                },
                success: function (data) {
                    if (data) {
                        $('.xmoze-portfolio-wrap').append(data);
                        $('.xmoze-portfolio-wrap').isotope('reloadItems').isotope()
                        button.text('More projects');
                        button.data('paged', dpaged);
                        // if the last page, remove the button
                        if (total_pages == dpaged)
                            button.remove();
                    } else {
                        button.remove();
                    }
                }
            });
            return false;
        });

        $(".popup-icon").magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
       });




    }

    //Job js start
    var Xmoze_Job_Js = function () {
        if ($.fn.isotope) {

                var $gridMas = $('.xmoze-job-wrap.layout-mode-masonry');
                var $grid = $('.xmoze-job-wrap.layout-mode-normal');

                $grid.isotope({
                    itemSelector: '.xmoze-job-item-wrap',
                    percentPosition: true,
                }).resize()

                $grid.imagesLoaded().progress(function () {
                    $grid.isotope('layout')
                }).resize();

                $gridMas.isotope({
                    itemSelector: '.xmoze-job-item-wrap',
                    percentPosition: true,
                })

                $gridMas.imagesLoaded().progress(function () {
                    $gridMas.isotope('layout')
                });

                $grid.isotope().resize();
                $gridMas.isotope().resize();

                $(".jf-isotope-nav li").on('click', function () {
                    $(".jf-isotope-nav li").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    $gridMas.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: "linear",
                            queue: false,
                        }
                    });

                    var selector = $(this).attr("data-filter");
                    $grid.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: "linear",
                            queue: false,
                        }
                    });


                });

        }

        // comment load more button click event
        $('.xmoze-jf-loadmore-btn').on('click', function () {
            var button = $(this);

            // decrease the current comment page value
            var dpaged = button.data('paged'),
                total_pages = button.data('total-page'),
                nonce = button.data('referrar'),
                ajaxurl = button.data('url');

            dpaged++;
            // console.log(foio_job_js_datas);
            $.ajax({
                url: ajaxurl, // AJAX handler, declared before
                dataType: 'html',
                data: {
                    'action': 'xmoze_loadmore_callback', // wp_ajax_cloadmore
                    // 'post_id': foio_job_js_datas.parent_post_id, // the current post
                    'paged': dpaged, // current comment page
                    'folio_nonce': nonce,
                    'job_settings': button.data('job-settings'),
                },
                type: 'POST',
                beforeSend: function (xhr) {
                    button.text('Loading...'); // preloader here
                },
                success: function (data) {
                    if (data) {
                        $('.xmoze-job-wrap').append(data);
                        $('.xmoze-job-wrap').isotope('reloadItems').isotope()
                        button.text('More projects');
                        button.data('paged', dpaged);
                        // if the last page, remove the button
                        if (total_pages == dpaged)
                            button.remove();
                    } else {
                        button.remove();
                    }
                }
            });
            return false;
        });

    }



    var XmozeTeam = function ($scope, $) {

        var postwrapper = $scope.find(".xmoze--team");
        if (postwrapper.length === 0)
            return;

        var settings = postwrapper.data('settings');

        /*--------------------------------------------------------------
        xmoze slider js
        --------------------------------------------------------------*/
        var postwrapper = $('.xmoze--team'),
            rtl = $('body').hasClass('rtl') ? true : false;

        postwrapper.owlCarousel({
            rtl: rtl,
            stagePadding: 200,
            dots:settings['dots'],
            loop: settings['loop'],
            center: true,
            autoplay: settings['autoplay'],
            nav: settings['nav'],
            mouseDrag:settings['mousedrag'],
            autoplaytimeout: settings['autoplaytimeout'],
            items: settings['per_coulmn'],
            navText: [settings.prev_icon, settings.next_icon],
            responsive:{
                0:{
                    items: settings['per_coulmn_mobile'],
                    mouseDrag:settings['mousedrag'],
                    stagePadding: 0,
                },
                768:{
                    items: settings['per_coulmn_tablet'],
                    mouseDrag:settings['mousedrag'],
                    stagePadding: 0,
                },
                1025:{
                    items:settings['per_coulmn'],
                    mouseDrag:settings['mousedrag'],
                    stagePadding: 100,
                },

                1400:{
                    items:settings['per_coulmn'],
                    mouseDrag:settings['mousedrag'],
                    stagePadding: 200,
                }
            }
        });

    }


    var Xmoze_Back_To_Top = function ($scope, $) {
        /*--------------------------------------------------------------
        xmoze slider js
        --------------------------------------------------------------*/

        jQuery(".xmoze-back-to-top-wraper").click(function () {
            jQuery("html, body").animate({
                scrollTop: 0
            }, 1000);
        });

        function stickyHeader($class) {
            jQuery(window).on('scroll', function () {
                var headerHeight = 600;
                if (jQuery(window).scrollTop() >= headerHeight) {
                    jQuery('.xmoze-back-to-top-wraper .xmoze-icon').addClass('sticky-active');
                } else {
                    jQuery('.xmoze-back-to-top-wraper .xmoze-icon').removeClass('sticky-active');
                }
            });
        }

        stickyHeader('.xmoze-back-to-top-wraper');

    }

    var navMenu = function ($scope, $) {

        $('.xmoze-mega-menu').closest('.elementor-container').addClass('megamenu-full-container');
        var count = 0;
        $(".main-navigation ul.navbar-nav>li.xmoze-mega-menu>.sub-menu>li").each(function (index) {
            count++;
            if ($(this).is('li:last-child')) {
                $(this).parent().addClass('mg-column-' + count);
                count = 0;
            }
        });

        $('.main-navigation ul.navbar-nav>li').each(function(i, v) {
            $(v).find('a').contents().wrap('<span class="menu-item-text"/>')
        });
        $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');

        function navMenu() {

            if (jQuery('.xmoze-main-menu-wrap').hasClass('menu-style-inline')) {
                if (jQuery(window).width() < 1025) {
                    jQuery('.xmoze-main-menu-wrap').addClass('menu-style-flyout');
                    jQuery('.xmoze-main-menu-wrap').removeClass('menu-style-inline');
                } else {
                    jQuery('.xmoze-main-menu-wrap').removeClass('menu-style-flyout');
                    jQuery('.xmoze-main-menu-wrap').addClass('menu-style-inline');
                }

                $(window).resize(function () {
                    if (jQuery(window).width() < 1025) {
                        jQuery('.xmoze-main-menu-wrap').addClass('menu-style-flyout');
                        jQuery('.xmoze-main-menu-wrap').removeClass('menu-style-inline');
                    } else {
                        jQuery('.xmoze-main-menu-wrap').removeClass('menu-style-flyout');
                        jQuery('.xmoze-main-menu-wrap').addClass('menu-style-inline');
                    }
                })
            }

                // main menu toggleer icon (Mobile site only)
                $('[data-toggle="navbarToggler"]').on("click", function (e) {
                    $('.navbar').toggleClass('active');
                    $('.navbar-toggler-icon').toggleClass('active');
                    $('body').toggleClass('offcanvas--open');
                    e.stopPropagation();
                    e.preventDefault();

                });
                $('.navbar-inner').on("click", function (e) {
                    e.stopPropagation();
                });

                // Remove class when click on body
                $('body').on("click", function () {
                    $('.navbar').removeClass('active');
                    $('.navbar-toggler-icon').removeClass('active');
                    $('body').removeClass('offcanvas--open');
                });
                $('.main-navigation ul.navbar-nav li.menu-item-has-children>a').on("click", function (e) {
                    e.preventDefault();
                    $(this).siblings('.sub-menu').toggle();
                    $(this).parent('li').toggleClass('dropdown-active');
                })


        }


        navMenu();
    }



//Portfolio slider






    $(window).on("elementor/frontend/init", function () {

        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-portfolio-gallery.default", Xmoze_Portfolio_Gallery_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-product-categories.default", XmozeductCategories);
        elementorFrontend.hooks.addAction("frontend/element_ready/blog-loop.default", XmozePostLoop);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-testimonial-loop.default", Xmoze_Testimonial_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze_team.default", XmozeTeam);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-back-to-top.default", Xmoze_Back_To_Top);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-portfolio.default", Xmoze_Portfolio_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-job.default", Xmoze_Job_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze-main-menu.default", navMenu);
        elementorFrontend.hooks.addAction("frontend/element_ready/xmoze_team.default", Xmoze_Team_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/global", XmozeGlobal);

    });

})(jQuery);