$(document).ready(function() {
    var swiper = new Swiper(".banner-slider", {
        effect: 'fade',
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            type: 'custom',
            renderCustom: function(swiper, current, total) {
                // return '0' + current + '/' + '0' + total;
                return '<div>' + '<span class="current">' + '0' + current + '</span>' + '<span class="total">' + '/' + '<span>' + '0' + total + '</span>' + '</span>' + '</div>'
            }
        },
        speed: 1000
    });

    var swiper3 = new Swiper(".pj-slider", {
        autoplay: true,
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next-1",
            prevEl: ".swiper-button-prev-1",
        },
        breakpoints: {
            567: {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 0,
            },
        },
    });
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 1) {
            $('header').addClass('fixed-header');
        } else {
            $('header').removeClass('fixed-header');
        }
    });
    $('.select-box span').click(function() {
        $(this).closest('.select-box').find('ul').slideToggle(300)
    })
    $('.select-box li').click(function() {
        $(this).closest('ul').slideToggle(300);
        $(this).closest('.select-box').find('span').html($(this).html())
    })
    $(".store-name").click(function() {
        $(this).toggleClass('active');
        $(this).next().slideToggle(200);
        $(this).closest('.store-des').toggleClass('active');
    });
    $('.col-select select').on('change', function() {
        $(this).closest('.modal-col').find('.col-have-content').css('z-index', '2')
    });
    $('.btn-close-content').click(function() {
        $(this).closest('.modal-col').find('.col-have-content').css('z-index', '0');
        $(this).closest('.modal-col').find('select').prop('selectedIndex', 0);
    })
    $('.btn-search').click(function () {
        $('.se-frm').toggleClass('show')
    })
    AOS.init({
        disable: function() {
            var maxWidth = 1200;
            return window.innerWidth < maxWidth;
        }
    });

    $('input[name="dates"]').daterangepicker();
})