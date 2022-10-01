<div class="ideas-add-form-container"></div>
<form class="ideas-add-form" id="ideas-insert-form">
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" id="ideas-form-close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="form-group row">
        <label for="colFormLabel" class="col-sm-2 col-form-label"><?php _e( 'Title',
				'md-idea-tool' ); ?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="imt-title" placeholder="<?php _e( 'Title',
				'md-idea-tool' ); ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="colFormLabel" class="col-sm-2 col-form-label"><?php _e( 'Description',
				'md-idea-tool' ); ?></label>
        <div class="col-sm-10">
                <textarea type="text" class="form-control" name="exp" id="imt-exp" placeholder="<?php _e( 'Description',
	                'md-idea-tool' ); ?>" required></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="colFormLabel" class="col-sm-2 col-form-label"><?php _e( 'Category',
				'md-idea-tool' ); ?></label>
        <div class="col-sm-10">
            <select class="form-control" name="category" id="imt-cat">
                <option selected value="0"><?php _e( 'Category',
						'md-idea-tool' ); ?></option>
				<?php
				foreach ( $categories as $category ) {
					echo '<option value="' . $category->cat_ID . '">' . $category->name . '</option>';
				}
				?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="colFormLabel" class="col-sm-2 col-form-label"><?php _e( 'Attachment',
				'md-idea-tool' ); ?></label>
        <div class="col-sm-10">
            <input type="file" id="imt-atc" class="form-control-file" name="attachment"
                   accept="image/jpeg, image/png, .doc,.docx,application/msword, .pdf" required>
        </div>
    </div>
    <div class="form-group row ideas-form-button">
        <button id="ideas-button" type="submit" class="btn btn-primary"><?php _e( 'Send Ideas',
				'md-idea-tool' ); ?></button>
    </div>
</form>
