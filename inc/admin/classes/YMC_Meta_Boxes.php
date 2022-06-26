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

		<div>Header 1</div>
		<div>Header 2</div>

	<?php }

	public function ymc_side_meta_box() { ?>
		<article>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry.
			Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
		</article>
	<?php }
}

new YMC_Meta_Boxes();