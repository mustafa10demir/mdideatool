<div class="wrap">
    <h1><?php _e( 'General Settings', 'md-idea-tool' ); ?></h1>
    <form method="post" novalidate="novalidate">
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row"><label for="blogname"><?php _e( 'Idea Deadline Hours', 'md-idea-tool' ); ?></label></th>
                <td>
                    <input name="hours" type="text" id="hours" value="<?php echo $hours ?>"
                           class="regular-text">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="<?php _e( 'Update', 'md-idea-tool' ); ?>"></p>
    </form>
</div>
