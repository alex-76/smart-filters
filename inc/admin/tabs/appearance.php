
<div class="header">
	<?php echo esc_html__('Appearance Options', 'ymc-smart-filter'); ?>
</div>

<div class="content">

    <div class="form-group wrapper-layout">

        <div class="appearance-section">

            <header class="sub-header">
                <i class="far fa-address-card"></i>
			    <?php echo esc_html__('Post Options', 'ymc-smart-filter'); ?>
            </header>

            <div class="from-element">
                <label class="form-label">
		            <?php echo esc_html__('Empty Results', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Enter text to show while empty result posts.', 'ymc-smart-filter');?>
                </span>
                </label>
                <input class="input-field" type="text" name="ymc-empty-post-result" value="<?php echo esc_attr($ymc_empty_post_result); ?>">
            </div>

            <div class="from-element">
                <label class="form-label">
	                <?php echo esc_html__('Post Link', 'ymc-smart-filter'); ?>
                    <span class="information">
                    <?php echo esc_html__('Select link target post.', 'ymc-smart-filter');?>
                </span>
                </label>
                <select class="form-select"  id="ymc-link-target" name="ymc-link-target">
                    <option value="_self" <?php if ($ymc_link_target === '_self') {echo "selected";} ?>>
                        <?php echo esc_html__('Same Tab', 'ymc-smart-filter'); ?>
                    </option>
                    <option value="_blank" <?php if ($ymc_link_target === '_blank') {echo "selected";} ?>>
                        <?php echo esc_html__('New Tab', 'ymc-smart-filter'); ?>
                    </option>
                </select>
            </div>

            <div class="from-element">
                <label class="form-label">
			        <?php echo esc_html__('Post Order By', 'ymc-smart-filter'); ?>
                    <span class="information">
                    <?php echo esc_html__('Set post order by.', 'ymc-smart-filter');?>
                </span>
                </label>

                <!--- Add select --->

            </div>

            <div class="from-element">
                <label class="form-label">
			        <?php echo esc_html__('Post Order Type', 'ymc-smart-filter'); ?>
                    <span class="information">
                    <?php echo esc_html__('Set post order type.', 'ymc-smart-filter');?>
                </span>
                </label>

                <!--- Add select --->

            </div>



            <header class="sub-header">
                <i class="far fa-address-card"></i>
		        <?php echo esc_html__('Pagination Options', 'ymc-smart-filter'); ?>
            </header>

            <div class="from-element">
                <label class="form-label">
			        <?php echo esc_html__('Posts Per Page', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Select Posts Per Page. Use -1 for all posts.', 'ymc-smart-filter');?>
                </span>
                </label>
                <input class="input-field" type="text" name="ymc-per-page" value="<?php echo esc_attr($ymc_per_page); ?>">
            </div>

            <div class="from-element">

                <label class="form-label">
			        <?php echo esc_html__('Pagination Type', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Select type of pagination.', 'ymc-smart-filter');?>
                </span>
                </label>

	            <?php $pagination_type = apply_filters('ymc_pagination_type', $pagination_type); ?>

                <select class="form-select" id="ymc-pagination-type" name="ymc-pagination-type">
		            <?php
                        foreach ($pagination_type as $key => $ptype) {

                            if ($ymc_pagination_type === $key) {

                                $selected = 'selected';
                            }
                            else {
                                $selected = '';
                            }
                            echo '<option value="' . $key . '" ' . $selected . '>' . esc_html($ptype) . '</option>';
                        }
		            ?>
                </select>

            </div>

        </div>


    </div>


</div>
