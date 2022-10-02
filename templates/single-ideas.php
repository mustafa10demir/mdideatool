<?php
get_header();
$attachment = get_post_meta( get_the_ID(), '_imt_attachment', true );

require_once IMT_PLUGIN_DIR . '/templates/init/core.php';

?>
    <div class="container imt-single-page">
        <h1><?php the_title(); ?></h1>
        <button type="button" class="btn btn-outline-success imt-add-score<?php echo get_the_ID();
		if ( $is_score ) {
			echo " active";
		} ?>" onclick="imt_add_score(<?php echo get_the_ID() . ',' . is_user_logged_in(); ?>)">
			<?php _e( 'LIKE', 'md-idea-tool' ); ?> <span class="imt-badge text-bg-secondary"
                                                         id="score<?php echo get_the_ID(); ?>"><?php echo $score; ?></span>
        </button>
        <p> <?php the_excerpt(); ?> </p>
		<?php
		if ( $attachment ) {
			echo '<a target="_blank" href="' . esc_attr( $attachment ) . '" class="btn btn-primary">' . __( 'View Attachment',
					'md - idea - tool' ) . '</a>';
		}
		?>
        <div class="imt-comment">
			<?php comments_template(); ?>
        </div>
    </div>
<?php

get_footer();
