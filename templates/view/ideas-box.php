<?php
require_once IMT_PLUGIN_DIR . '/templates/init/core.php';
?>
<div class="entry-content container">
    <div class="card ideas-card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <img class="author-img"
                         src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>">
                    <span class="author-name">  <?php echo get_the_author_meta( "display_name",
							get_the_author_meta( 'ID' ) ); ?> </span>
                </div>
                <div class="col-md-6 btn-col">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-success imt-add-score<?php echo get_the_ID();
						if ( $is_score ) {
							echo " active";
						} ?>" onclick="imt_add_score(<?php echo get_the_ID() . ',' . is_user_logged_in(); ?>)">
							<?php _e( 'LIKE', 'md-idea-tool' ); ?> <span class="imt-badge text-bg-secondary"
                                                                         id="score<?php echo get_the_ID(); ?>"><?php echo $score; ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?></h5>
            <p class="card-text">
				<?php
				$postDetail = wp_strip_all_tags( get_post_field( 'post_excerpt', get_the_ID() ) );
				if ( strlen( $postDetail ) >= 301 ) {
					$postDetail = mb_substr( $postDetail, 0, 300, 'UTF-8' ) . "...";
				}
				echo $postDetail;
				?>
            </p>
			<?php
			$attachment = get_post_meta( get_the_ID(), '_imt_attachment', true );
			if ( $attachment ) {
				echo '<a target="_blank" href="' . esc_attr( $attachment ) . '" class="btn btn-success">' . __( 'View Attachment',
						'md - idea - tool' ) . '</a>';
			}
			?>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e( 'Read More', 'md-idea-tool' ); ?></a>
        </div>
    </div>
</div>