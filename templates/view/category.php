<div class="container ideas-category">
    <div class="row">
        <div class="col-md-10">
            <div class="position-relative w-100 mb-4">
                <div class="swiper categories-swiper mx-md-5">
                    <div class="swiper-wrapper">
                        <button class="btn btn-outline-primary swiper-slide rounded-pill py-2 text-nowrap active imt-cat-ajax"
                                data-category="0">All
                        </button>

						<?php
						foreach ( $categoriesNotNull as $category ) { ?>
                            <div class="btn btn-outline-primary swiper-slide rounded-pill py-2 text-nowrap imt-cat-ajax"
                                 data-category="<?php echo $category->cat_ID; ?>" title="test">
								<?php echo $category->name; ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
                <div class="swiper-button-next slider-arrow"></div>
                <div class="swiper-button-prev slider-arrow"></div>
            </div>
        </div>
        <div class="col-md-2">
            <button id="imt-add-ideas" type="button" class="btn btn-success">+ <?php _e( 'Add Ideas',
					'md-idea-tool' ); ?></button>
        </div>
    </div>
</div>