<div class="wrap">
    <h1><?php _e( 'General Settings', 'md-idea-tool' ); ?></h1>
    <form method="post" novalidate="novalidate">
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row"><label for="blogname"><?php _e( 'Idea Deadline Day', 'md-idea-tool' ); ?></label></th>
                <td>
                    <input name="day" type="text" id="day" value="<?php echo $day ?>"
                           class="regular-text">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="<?php _e( 'Update', 'md-idea-tool' ); ?>"></p>
    </form>
</div>
