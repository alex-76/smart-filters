
<div class="header">
	<?php echo esc_html__('Search Options', 'ymc-smart-filter'); ?>
</div>

<div class="content">

    <header class="sub-header">
        <i class="far fa-search"></i>
		<?php echo esc_html__('Post Search', 'ymc-smart-filter'); ?>
    </header>

    <div class="form-group wrapper-search">

        <label for="ymc-filter-layout" class="form-label">
		    <?php echo esc_html__('Enable / Disable Post Search', 'ymc-smart-filter');?>
            <span class="information">
                <?php echo esc_html__('Enable / Disable Panel Search.', 'ymc-smart-filter'); ?>
            </span>
        </label>

        <div class="ymc-toggle-group">
            <label class="switch">
                <input type="checkbox" <?php echo ($ymc_filter_search === "off") ? "checked" : ""; ?>>
                <input type="hidden" name="ymc-filter-search" value='<?php echo esc_attr($ymc_filter_search); ?>'>
                <span class="slider"></span>
            </label>
        </div>

    </div>




</div>
