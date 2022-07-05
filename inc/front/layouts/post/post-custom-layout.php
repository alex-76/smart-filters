<?php

while ($query->have_posts()) : $query->the_post();

	echo apply_filters('ymc_post_custom_layout', $layouts, get_the_ID(), $filter_id );

endwhile;
