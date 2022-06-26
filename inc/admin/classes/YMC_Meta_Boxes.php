<?php

class YMC_Meta_Boxes {

	public function __construct() {
		add_action( 'add_meta_boxes', array($this,'add_post_metabox'));
		add_action( 'save_post', array($this,'wpdocs_save_meta_box'), 10, 2);
	}

	public function wpdocs_save_meta_box( $post_id,$post ) {}

	public function add_post_metabox() {

		add_meta_box( 'ymc_top_meta_box' , __('Settings','ymc-smart-filter'), array($this,'ymc_top_meta_box'), 'ymc_filters', 'normal', 'core'/*,array()*/);

		add_meta_box( 'ymc_side_meta_box' , __('YMC Pro Features','ymc-smart-filter'), array($this,'ymc_side_meta_box'), 'ymc_filters', 'side', 'core'/*,array()*/);

	}

	public function ymc_top_meta_box() { ?>

        <header class="ymc__header">
            <div class="logo"><img src="<?php echo YMC_SMART_FILTER_URL . '/admin/assets/images/full-logo.png'; ?>"></div>
            <div class="manage-dash">
                <span class="dashicons dashicons-admin-tools"></span>
                <span class="title"><?php echo esc_html__('General Settings','ymc-smart-filter'); ?></span>
            </div>
        </header>

        <div class="ymc__container-settings">
            <div class="tab-sidebar">
                <ul class="nav-tabs" id="ymcTab">
                    <li class="nav-item">
                        <a class="link active" id="general-tab" href="#general">
	                        <?php echo esc_html__('General','ymc-smart-filter'); ?>
                            <span class="info"><?php echo esc_html__('Post Type, Categories','ymc-smart-filter'); ?> </span>
                            <span class="dashicons dashicons-admin-tools"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="layouts-tab" href="#layoutstab">
			                <?php echo esc_html__('Layouts','ymc-smart-filter'); ?>
                            <span class="info"><?php echo esc_html__('Post Layout, Filter Layout','ymc-smart-filter'); ?> </span>
                            <span class="dashicons dashicons-editor-table"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="appearance-tab" href="#appearance">
                            <?php echo esc_html__('Appearance','ymc-smart-filter');?>
                            <span class="info"><?php echo esc_html__('Post Layout, Filter Layout','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-visibility"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="typography-tab">
                            <?php echo esc_html__('Typography','ymc-smart-filter');?>
                            <span class="info"><?php echo esc_html__('Title, Description Fonts','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-editor-spellcheck"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="advanced-tab">
                            <?php echo esc_html__('Advanced','category-ajax-filter'); ?>
                            <span class="info"><?php echo esc_html__('Add Extra Classes to Post','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-tag"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="shortcode-tab" href="#shortcode">
                            <?php echo esc_html__('Shortcode','category-ajax-filter'); ?>
                            <span class="info"><?php echo esc_html__('Get Your shortcode','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-shortcode"></span>
                        </a>
                    </li>


                </ul>
            </div>
            <div class="tab-content">Tab Content</div>
        </div>
	<?php }

	public function ymc_side_meta_box() { ?>
		<article>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry.
			Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
		</article>
	<?php }
}

new YMC_Meta_Boxes();