function imt_add_score(id, is_login) {
    if (is_login){
        var score = parseInt(jQuery('#score' + id).html());
        if (jQuery('.imt-add-score' + id).hasClass('active')) {
            jQuery('.imt-add-score' + id).removeClass('active');
            jQuery('#score' + id).html(score - 1);
        } else {
            jQuery('.imt-add-score' + id).addClass('active');
            jQuery('#score' + id).html(score + 1);
        }

        var form_data = new FormData();
        form_data.append('action', 'imt_add_score');
        form_data.append('_ajax_nonce', ajax_posts_imt.nonce);
        form_data.append('postID', id);

        jQuery.ajax({
            url: ajax_posts_imt.ajax_url,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
            }
        });
    } else {
        jQuery('.ideas-add-form-container').css('display', 'block');
        jQuery('.ideas-add-form').css('display', 'block');
    }

}