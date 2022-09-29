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


    function load_posts_scrool() {
        str = '&cat=' + cat + '&pageNumber=' + pageNumber + '&action=more_post_ajax';
        $.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_posts_popular.ajaxurl,
            data: str,
            success: function (data) {
                var $data = $(data);
                if ($data.length) {
                    if (pageNumber % 4 === 0) {
                        $(".callaction").appendTo("#ajax-posts");
                        $(".wpcf7-response-output").html('');
                    }
                    $("#ajax-posts").append($data);
                    pageLoader = true;
                    var ppp = ajax_posts_popular.ppp;
                    $('.loaderdiv').css('display', 'none');
                } else {
                    $('.loaderdiv').css('display', 'none');
                    $('.loaderdivfinish').css('display', 'block');
                }
            },
        });
        return false;
    }

    function load_posts(id) {
        var str = '&cat=' + id + '&pageNumber=1&action=more_post_ajax';
        $.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_posts_popular.ajaxurl,
            data: str,
            success: function (data) {
                var $data = $(data);
                if ($data.length) {
                    cat = id;
                    pageNumber = 2;
                    pageLoader = true;
                    $("#ajax-posts").html($(".callaction"));
                    $('.callaction').css('display', 'none');
                    $(".wpcf7-response-output").html('');
                    $("#ajax-posts").html($data);
                    $(".callaction").appendTo("#ajax-posts");
                    $('.callaction').css('display', 'block');
                }
            }
        });
        return false;
    }

    $(".getcat").on("click", function () {
        load_posts($(this).data('category'));
        $('.getcat').removeClass('active');
        $(this).addClass('active');
        $('.loaderdivfinish').css('display', 'none');
    });

});