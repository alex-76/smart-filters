
<div class="header">
	<?php echo esc_html__('General Options', 'ymc-smart-filter'); ?>
</div>

<div class="content">

<div class="form-group">
	<label for="ymc-cpt-select" class="form-label">
		<?php echo esc_html__('Custom Post Type','ymc-smart-filter'); ?>
		<span class="information">
        <?php echo esc_html__('Select your post type to filter. Deaflut: Post','ymc-smart-filter'); ?>
        </span>
	</label>

	<select class="form-select" id="ymc-cpt-select" name="ymc-cpt-select">
		<option value="post"><?php echo esc_html__('Post','ymc-smart-filter'); ?></option>
		<?php
		foreach($cpost_types as $cpost_type) {
			if($select === $cpost_type) {
				$sel = 'selected';
			} else {
				$sel = '';
			}
			echo "<option value='" . $cpost_type ."' $sel>" . esc_html($cpost_type) . "</option>";
		}
		?>
	</select>
</div>

<hr/>

<div class="form-group">
	<label for="ymc-taxonomy-select" class="form-label">
		<?php echo esc_html__('Taxonomy','ymc-smart-filter'); ?>
		<span class="information">
        <?php echo esc_html__('Select your taxonomy from dropdown. Deaflut: Category','ymc-smart-filter'); ?>
        </span>
	</label>

	<select class="form-select" id="ymc-taxonomy-select" name="ymc-taxonomy-select">
		<?php
		$taxo = get_object_taxonomies($select);
		if($taxo){
			foreach($taxo as $val) {
				if($tax === $val) {
					$sl = "selected";
				} else {
					$sl = "";
				}
				echo "<option value='" . $val . "' $sl>" . esc_html($val) . "</option>";
			}
		}
		?>
	</select>
</div>

<hr/>

<div class="form-group">
	<label for="ymc-terms" class="form-label">
		<?php echo esc_html__('Terms','ymc-smart-filter'); ?>
		<span class="information"><?php echo esc_html__('Select Terms that you want to show on frontend','ymc-smart-filter'); ?></span>
	</label>

	<ul class="category-list" id="ymc-terms">
		<li class="all-categories">
			<input name='all-select' class='category-all' id='category-all-btn' type='checkbox'>
			<label for='category-all-btn' class='category-all-label'>
				<?php echo esc_html__('All','ymc-smart-filter'); ?>
			</label>
		</li>
		<?php
		$terms = get_terms([
			'taxonomy' => $tax,
			'hide_empty' => false,
		]);
		if($terms) {
			foreach($terms as $term) {

				$sl1='';
				if(is_array($terms_sel)) {

					if(count($terms_sel) > 0) {
						if (in_array($term->term_id, $terms_sel)) {
                            $sl1 = 'checked';
                        }
						else{ $sl1=''; }
					}
				}

				echo "<li><input name='category-list[]' class='category-list' id='category-id-$term->term_id' type='checkbox' value='". $term->term_id ."' $sl1>";
				echo "<label for='category-id-$term->term_id' class='category-list-label'>" . esc_html($term->name) . "</label>";
			}
		}
		?>
	</ul>
</div>

</div>

