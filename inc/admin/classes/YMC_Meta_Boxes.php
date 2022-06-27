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
	                        <span class="text"><?php echo esc_html__('General','ymc-smart-filter'); ?></span>
                            <span class="info"><?php echo esc_html__('Post Type, Categories','ymc-smart-filter'); ?> </span>
                            <span class="dashicons dashicons-admin-tools"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="layouts-tab" href="#layouts">
                            <span class="text"><?php echo esc_html__('Layouts','ymc-smart-filter'); ?></span>
                            <span class="info"><?php echo esc_html__('Post Layout, Filter Layout','ymc-smart-filter'); ?> </span>
                            <span class="dashicons dashicons-editor-table"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="appearance-tab" href="#appearance">
                            <span class="text"><?php echo esc_html__('Appearance','ymc-smart-filter');?></span>
                            <span class="info"><?php echo esc_html__('Post Layout, Filter Layout','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-visibility"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="typography-tab" href="#typography">
                            <span class="text"><?php echo esc_html__('Typography','ymc-smart-filter');?></span>
                            <span class="info"><?php echo esc_html__('Title, Description Fonts','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-editor-spellcheck"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="advanced-tab" href="#advanced">
                            <span class="text"><?php echo esc_html__('Advanced','category-ajax-filter'); ?></span>
                            <span class="info"><?php echo esc_html__('Add Extra Classes to Post','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-tag"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="link" id="shortcode-tab" href="#shortcode">
                            <span class="text"><?php echo esc_html__('Shortcode','category-ajax-filter'); ?></span>
                            <span class="info"><?php echo esc_html__('Get Your shortcode','ymc-smart-filter'); ?></span>
                            <span class="dashicons dashicons-shortcode"></span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-panel active" id="general">
                    <div class="tab-entry">

                        <!-- START GENERAL SETTINGS TAB DATA -->
                        <div class="header">
	                        <?php echo esc_html__('Options','ymc-smart-filter'); ?>
                        </div>

                        <div class="content">
                            <?php require_once YMC_SMART_FILTER_DIR . '/admin/tabs/default.php'; ?>

                            <div class="form-group">
                                <label for="custom-post-type-select" class="form-label">
		                            <?php echo esc_html__('Custom Post Type','ymc-smart-filter'); ?>
                                    <span class="information">
                                    <?php echo esc_html__('Select your post type to filter. Deaflut: Post','ymc-smart-filter'); ?>
                                </span>
                                </label>
                                <select class="form-select" id="custom-post-type-select" name="custom-post-type-select">
                                    <option value="post"><?php echo esc_html__('Post','ymc-smart-filter'); ?></option>
		                            <?php
		                            foreach($cpost_types as $cpost_type) {
			                            echo "<option value='" . $cpost_type ."'>" . esc_html($cpost_type) . "</option>";
		                            }
		                            ?>
                                </select>
                            </div>

                            <hr/>

                            <div class="form-group">
                                <label for="ymc-taxonomy" class="form-label">
		                            <?php echo esc_html__('Taxonomy','ymc-smart-filter'); ?>
                                    <span class="information">
                                    <?php echo esc_html__('Select your taxonomy from dropdown. Deaflut: Category','ymc-smart-filter'); ?>
                                </span>
                                </label>
                                <select class="form-select" id="ymc-taxonomy" name="ymc-taxonomy">
		                            <?php
		                            $tax = get_object_taxonomies($select);
		                            if($tax){
			                            foreach($tax as $val) {
				                            echo "<option value='"."' id='hide'>" . esc_html($val) . "</option>";
			                            }
		                            }
		                            ?>
                                </select>
                            </div>

                            <hr/>

                            <div class="form-group">
                                <label for="ymc-terms" class="form-label">
		                            <?php echo esc_html__('Terms','ymc-smart-filter'); ?>
                                    <span class="information"><?php echo esc_html__('Select Terms that you want to show on frontend. Deaflut: 5/ASC ORDER','ymc-smart-filter'); ?></span>
                                </label>
                                <?php
                                    $terms = get_terms(array('taxonomy' => $tax, 'hide_empty' => false));
                                    if($terms) {
	                                    //var_dump($terms);
	                                    foreach($terms as $term) {

	                                    }
                                    }
                                ?>
                            </div>



                        </div>
                        <!-- END GENERAL SETTINGS TAB DATA -->
                    </div>

                </div>
                <div class="tab-panel" id="layouts">
                    <div class="tab-entry">
                        <h3>Layouts</h3>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                </div>
                <div class="tab-panel" id="appearance">
                    <div class="tab-entry">
                        <h3>Appearance</h3>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                </div>
                <div class="tab-panel" id="typography">
                    <div class="tab-entry">
                        <h3>Typography</h3>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                </div>
                <div class="tab-panel" id="advanced">
                    <div class="tab-entry">
                        <h3>Advanced</h3>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                </div>
                <div class="tab-panel" id="shortcode">
                    <div class="tab-entry">
                        <h3>Shortcode</h3>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                </div>
            </div>
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