
<div class="header">
	<?php echo esc_html__('Layouts Options', 'ymc-smart-filter'); ?>
</div>

<div class="content">

    <div class="form-group wrapper-layout">

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

	    <?php $ymc_hide = ($ymc_filter_status === 'on') ? '' : 'ymc_hidden'; ?>

        <div class="manage-filters <?php echo esc_attr($ymc_hide); ?>">

            <div class="manage-filters__section">

                <label for="ymc-filter-layout" class="form-label">
		            <?php echo esc_html__('Select Filter Design', 'ymc-smart-filter');?>
                    <span class="information">
                    <?php echo esc_html__('Select design layout of filter.', 'ymc-smart-filter');?>
                </span>
                </label>

                <select class="form-select" id="ymc-filter-layout" name="ymc-filter-layout">

		            <?php
		            $filter_layouts = apply_filters('ymc_filter_layouts', $layouts);
		            foreach ($filter_layouts as $key => $layout) :

			            $selected = ( $ymc_filter_layout === $key ) ? 'selected' : '';

			            echo '<option value="' . $key . '" ' . $selected . '>' . esc_attr($layout) . '</option>';

		            endforeach;
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



    </div>

</div>



