
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
                <input class="" type="text" name="ymc-empty-post-result" value="<?php echo esc_attr($ymc_empty_result); ?>">
            </div>

        </div>

    </div>


</div>
