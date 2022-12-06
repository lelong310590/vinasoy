$(document).ready(function () {

    const body = $('body');
    const homeNewsCarousel = $('.home-new-carousel')
    const exeCarousel = $('.exe-carousel')
    const proudCarousel = $('.proud-carousel')
    const videoCarousel = $('.video-detail-carousel')
    const csrf = $('meta[name="csrf-token"]').attr('content');

    if (videoCarousel.length > 0) {
        videoCarousel.owlCarousel({
            loop: true,
            items: 1,
            dots: true,
            nav: false,
            autoHeight:true,
        })

        body.on('click', '.news-carousel-navigation.carousel-left', function () {
            videoCarousel.trigger('prev.owl.carousel');
        });

        body.on('click', '.news-carousel-navigation.carousel-right', function () {
            videoCarousel.trigger('next.owl.carousel');
        });
    }

    if (homeNewsCarousel.length > 0) {
        homeNewsCarousel.owlCarousel({
            loop: true,
            margin: 30,
            items: 4,
            dots: true,
            nav: false,
            autoHeight:true,
            responsive: {
                0: {
                    margin: 0,
                    items: 1,
                    dots: true,
                },
                992: {
                    margin: 40,
                    items: 4,
                    dots: false,
                }
            }
        })

        body.on('click', '.news-carousel-navigation.carousel-left', function () {
            homeNewsCarousel.trigger('prev.owl.carousel');
        });

        body.on('click', '.news-carousel-navigation.carousel-right', function () {
            homeNewsCarousel.trigger('next.owl.carousel');
        });
    }

    if (exeCarousel.length > 0) {
        exeCarousel.owlCarousel({
            loop: true,
            margin: 30,
            items: 4,
            dots: true,
            nav: false,
            autoHeight:true,
            responsive: {
                0: {
                    margin: 0,
                    items: 1,
                    dots: true,
                },
                992: {
                    margin: 40,
                    items: 4,
                    dots: false,
                }
            }
        })

        body.on('click', '.news-carousel-navigation.carousel-left', function () {
            exeCarousel.trigger('prev.owl.carousel');
        });

        body.on('click', '.news-carousel-navigation.carousel-right', function () {
            exeCarousel.trigger('next.owl.carousel');
        });
    }

    if (proudCarousel.length > 0) {
        proudCarousel.owlCarousel({
            loop:true,
            autoplay: true,
            margin:10,
            center: true,
            responsiveClass:true,
            responsive: {
                0: {
                    margin: 0,
                    items: 1,
                    dots: true,
                },
                992: {
                    margin: 40,
                    items: 3,
                    dots: false,
                }
            }
        })

        body.on('click', '.news-carousel-navigation.carousel-left', function () {
            proudCarousel.trigger('prev.owl.carousel');
        });

        body.on('click', '.news-carousel-navigation.carousel-right', function () {
            proudCarousel.trigger('next.owl.carousel');
        });
    }

    body.on('click', '.form-popup-close', function () {
       $('.form-popup').hide();
    });

    body.on('click', '.sign-in-button', function () {
        Swal.close();
        $('.form-popup').css('display', 'flex');
    })

    body.on('click', '.story-hero-more a', function () {
        $('.story-rule').show()
    })

    body.on('click', '.member-navigation', function () {
        $('.member-navigation-dropdown').toggleClass('active')
    })

    body.on('click', '.open-story-form', function () {
        $('.story-form').css('display', 'flex');
    })

    body.on('click', '.mobile-menu', function () {
        $('.main-navigation').css('display', 'block');
    })

    body.on('click', '.close-menu', function () {
        $('.main-navigation').css('display', 'none');
    })

    body.on('click', '#view-member-list', function () {
        $('.member-list').toggleClass('active');
        if ($('.member-list').hasClass('active')) {
            $('#view-member-list').text('Thu gọn')
        }else {
            $('#view-member-list').text('Xem danh sách')
        }

    })

    if ($('#dropzone-item').length > 0) {
        $("#dropzone-item").dropzone({ url: "/file/post" });
    }

})
