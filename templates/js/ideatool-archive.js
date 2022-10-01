jQuery(document).ready(function ($) {

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
                console.log(response);
            }
        });
    });

    $('.imt-cat-ajax').on('click', function (){
        load_posts($(this).data('category'));
        $('.imt-cat-ajax').removeClass('active');
        $(this).addClass('active');
    });
    let pageNumber = 2;
    let cat = 0;
    function load_posts(id) {
        $("#imt-ideas-container").html('<div class="container imt-loader-container"><div class="spinner-border" role="status"></div></div>');
        var form_data = new FormData();
        form_data.append('action', 'imt_more_post_ajax');
        form_data.append('_ajax_nonce', ajax_posts_imt.nonce);
        form_data.append('cat', id);
        form_data.append('pageNumber', 1);
        jQuery.ajax({
            url: ajax_posts_imt.ajax_url,
            type: "POST",
            contentType: false,
            processData: false,
            data: form_data,
            success: function (data) {
                var $data = $(data);
                if ($data.length) {
                    cat = id;
                    pageNumber = 2;
                    $("#imt-ideas-container").html($data);
                }
            }
        });
        return false;
    }


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