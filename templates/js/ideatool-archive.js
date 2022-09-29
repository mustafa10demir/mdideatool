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
                alert("test");
            },
            error: function (response) {
                console.log('error');
            }
        });

    });

});