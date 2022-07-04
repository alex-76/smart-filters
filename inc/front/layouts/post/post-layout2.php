<?php

while ($query->have_posts()) : $query->the_post();

	echo '<article><h2 style="font-size: 28px;">Layout 2 ' . get_the_title(get_the_ID()) . get_post_meta($id, 'ymc_post_layout', true) .'</h2>
			<p>'.wp_trim_words(get_the_content(get_the_ID()), 25).'</p>
			<a href="#">More...</a>
		 </article>';

endwhile;