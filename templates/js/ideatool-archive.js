jQuery(document).ready(function ($) {

    let pageNumber = 1;
    let cat = 0;
    let order = 0;
    let pageLoader = true;

    $('#imt-add-ideas').on("click", function () {
        $('.ideas-add-form-container').css('display', 'block');
        $('.ideas-add-form').css('display', 'block');
    });

    document.onkeydown = function (evt) {
        evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc");
        } else {
            isEscape = (evt.keyCode === 27);
        }
        if (isEscape) {
            ideas_close_popup();
        }
    };

    $('.ideas-add-form-container').on("click", function () {
        ideas_close_popup();
    });


    $('#ideas-form-close').on("click", function () {
        ideas_close_popup();
    });

    function ideas_close_popup() {
        $('.ideas-add-form-container').css('display', 'none');
        $('.ideas-add-form').css('display', 'none');
    }


    $("#ideas-insert-form").submit(function (e) {
        e.preventDefault();

        $('#ideas-button').prop('disabled', 'true').html('<div class="spinner-border" role="status"></div>');
        var form_data = new FormData();
        var file_data = $('#imt-atc').prop('files')[0];

        form_data.append('action', 'imt_add_ideas');
        form_data.append('_ajax_nonce', ajax_posts_imt.nonce);
        form_data.append('file', file_data);
        form_data.append('title', $("#imt-title").val());
        form_data.append('exp', $("#imt-exp").val());
        form_data.append('cat', $("#imt-cat").val());

        jQuery.ajax({
            url: ajax_posts_imt.ajax_url,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                $('#ideas-button').html(ajax_posts_imt.success).removeClass('btn-primary').addClass('btn-success');
            },
            error: function (response) {
                $('#ideas-button').prop('disabled', 'false');
            }
        });
    });

    $('.imt-cat-ajax').on('click', function () {
        pageNumber = 1;
        cat = $(this).data('category');
        load_posts(cat, order, pageNumber, false);
        $('.imt-cat-ajax').removeClass('active');
        $(this).addClass('active');
    });

    function load_posts(id, order, page_number, html = true) {
        pageLoader = false;
        if (!html){
            $("#imt-ideas-container").html('<div class="container imt-loader-container"><div class="spinner-border" role="status"></div></div>');
        } else {
            $('.imt-loading').css('display', 'block');
        }
        var form_data = new FormData();
        form_data.append('action', 'imt_more_post_ajax');
        form_data.append('_ajax_nonce', ajax_posts_imt.nonce);
        form_data.append('cat', id);
        form_data.append('pageNumber', page_number);
        form_data.append('order', order);
        jQuery.ajax({
            url: ajax_posts_imt.ajax_url,
            type: "POST",
            contentType: false,
            processData: false,
            data: form_data,
            success: function (data) {
                $('.imt-loading').css('display', 'none');
                pageLoader = true;
                var $data = $(data);
                if ($data.length) {
                    if (html) {
                        $("#imt-ideas-container").append($data);
                    } else {
                        $("#imt-ideas-container").html($data);
                    }

                }
            }
        });
        return false;
    }

    $('#imt-order').change(function () {
        order = $(this).val();
        load_posts(cat, order, pageNumber);
    });

    var lastScrollTop = 0;
    $(window).on('scroll', function () {
        var st = $(this).scrollTop();
        if (st > lastScrollTop) {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && pageLoader) {
                pageLoader = false;
                pageNumber++;
                load_posts(cat, order, pageNumber);
            }
        }
        lastScrollTop = st;
    });

    const categoriesSwiper = new Swiper('.categories-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function () {
                checkArrow();
            },
            resize: function () {
                checkArrow();
            }
        }
    });
    const commentSwiper = new Swiper('.comment-slide', {
        slidesPerView: 1,
        spaceBetween: 30,
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    function checkArrow() {
        let swiperNavigation = $('.swiper-button-prev, .swiper-button-next');
        window.innerWidth >= 960 ? swiperNavigation.show() : swiperNavigation.hide();
    }

});
