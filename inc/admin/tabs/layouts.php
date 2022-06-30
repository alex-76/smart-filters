
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

	    <?php $ymc_hide = ($ymc_filter_status === 'on') ? '' : 'ymc_hidden';	?>

        <div class="manage-filters <?php echo esc_attr($ymc_hide); ?>">
            <label for="ymc-filter-layout" class="form-label">
		        <?php echo esc_html__('Select Filter Design', 'ymc-smart-filter');?>
                <span class="information">
                    <?php echo esc_html__('Select design layout of filter.', 'ymc-smart-filter');?>
                </span>
            </label>
        </div>





    </div>

</div>



