
<div class="header">
	<?php echo esc_html__('Layouts Options', 'ymc-smart-filter'); ?>
</div>

<div class="content">

    <div class="form-group wrapper-layout">

        <div class="switch-wrapper">

            <label for="ymc-filter-layout" class="form-label">
		        <?php echo esc_html__('Enable / Disable Filter', 'ymc-smart-filter');?>
                <span class="information">
                <?php echo esc_html__('Enable / Disable filter.', 'ymc-smart-filter'); ?>
            </span>
            </label>

            <div class="ymc-toggle-group">
                <label class="switch">
                    <input type="checkbox" <?php echo ($ymc_filter_status === "off") ? "checked" : ""; ?>>
                    <input type="hidden" name="ymc-filter-status" value='<?php echo esc_attr($ymc_filter_status); ?>'>
                    <span class="slider"></span>
                </label>
            </div>

        </div>

	    <?php $ymc_hide = ($ymc_filter_status === 'on') ? '' : 'ymc_hidden'; ?>

        <div class="manage-filters <?php echo esc_attr($ymc_hide); ?>">

            <div class="manage-filters__section">
                <header class="sub-header">
                    <i class="far fa-filter"></i>
                    <?php echo esc_html__('Filter Layout', 'ymc-smart-filter'); ?>
                </header>
            </div>

            <div class="manage-filters__section">
                <label for="ymc-filter-layout" class="form-label">
		            <?php echo esc_html__('Select Filter Layout', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Select design layout of filters.', 'ymc-smart-filter');?>
                </span>
                </label>
                <select class="form-select" id="ymc-filter-layout" name="ymc-filter-layout">
		            <?php
                        $filter_layouts = apply_filters('ymc_filter_layouts', $layouts);
                        if( $filter_layouts ) :
                            foreach ($filter_layouts as $key => $layout) :

                                $selected = ( $ymc_filter_layout === $key ) ? 'selected' : '';

                                echo '<option value="' . $key . '" ' . $selected . '>' . esc_attr($layout) . '</option>';

                            endforeach;
                        endif;
		            ?>
                </select>
            </div>

            <div class="manage-filters__section color-setting">

                <div class="col">
                    <label for="ymc-filter-layout" class="form-label">
		                <?php echo esc_html__('Text Color', 'ymc-smart-filter');?>
                        <span class="information">
                            <?php echo esc_html__('Select text colors for filter layout.', 'ymc-smart-filter');?>
                        </span>
                    </label>
                    <input class="ymc-custom-color" type="text" value="<?php echo esc_attr($ymc_filter_text_color); ?>"  name='ymc-filter-text-color'/>
                </div>

                <div class="col">
                    <label for="ymc-filter-layout" class="form-label">
			            <?php echo esc_html__('Background Color', 'ymc-smart-filter');?>
                        <span class="information">
                    <?php echo esc_html__('Select background for filter layout.', 'ymc-smart-filter');?>
                </span>
                    </label>
                    <input class="ymc-custom-color" type="text" value="<?php echo esc_attr($ymc_filter_bg_color); ?>"  name='ymc-filter-bg-color'/>
                </div>

                <div class="col">
                    <label for="ymc-filter-layout" class="form-label">
			            <?php echo esc_html__('Active Color Text', 'ymc-smart-filter');?>
                        <span class="information">
                            <?php echo esc_html__('Select active color for filter layout.', 'ymc-smart-filter');?>
                        </span>
                    </label>
                    <input class="ymc-custom-color" type="text" value="<?php echo esc_attr($ymc_filter_active_color); ?>"  name='ymc-filter-active-color'/>
                </div>

            </div>

        </div>

        <div class="manage-post">

            <div class="manage-filters__section">
                <header class="sub-header">
                    <i class="far fa-address-card"></i>
                    <?php echo esc_html__('Post Layout', 'ymc-smart-filter'); ?>
                </header>
            </div>

            <div class="manage-filters__section">
                <label for="ymc-filter-layout" class="form-label">
			        <?php echo esc_html__('Select Post Layout', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Select design layout for posts.', 'ymc-smart-filter');?>
                </span>
                </label>
                <select class="form-select" id="ymc-filter-layout" name="ymc-post-layout">
		            <?php
                        $post_layouts = apply_filters('ymc_post_layouts', $layouts);

                        if($post_layouts) :

                            foreach ($post_layouts as $key => $layout) :

                                $selected = ( $ymc_post_layout === $key ) ? 'selected' : '';

                                echo '<option value="' . $key . '" ' . $selected . '>' . esc_attr($layout) . '</option>';

                            endforeach;

                        endif;
		            ?>
                </select>
            </div>

            <div class="manage-filters__section">

                <label for="ymc-filter-layout" class="form-label">
                    <?php echo esc_html__('Select column layout', 'ymc-smart-filter');?>
                    <span class="information">
                        <?php echo esc_html__('Select column layout of posts.', 'ymc-smart-filter');?>
                    </span>
                </label>

                <div class="screen-wrapper">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-desktop"></i></span>
                        <input class="input-screen" type="number" name="ymc_col_desktop" min='1' max="4"
                               value=<?php echo esc_attr($ymc_col_options['ymc_col_desktop']); ?>>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-tablet-alt"></i></span>
                        <input class="input-screen" type="number" name="ymc_col_tablet" min='1' max="4"
                               value=<?php echo esc_attr($ymc_col_options['ymc_col_tablet']); ?>>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-mobile-alt"></i></span>
                        <input class="input-screen" type="number" name="ymc_col_mobile" min='1' max="4"
                               value=<?php echo esc_attr($ymc_col_options['ymc_col_mobile']); ?>>
                    </div>
                </div>

            </div>




        </div>



    </div>

</div>



