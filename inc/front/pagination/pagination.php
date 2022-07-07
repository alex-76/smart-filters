<?php

$pagin = new YMC_post_pagination();

switch ( $type_pagination ) :

	case 'default' :
			$pagin->number($query, $paged, $type_pagination, $filter_id);
		break;

	case 'load-more' :
			$pagin->load_more($query, $paged, $type_pagination, $filter_id);
		break;

	case 'scroll-infinity' :
			$pagin->scroll_infinity($query, $paged, $type_pagination, $filter_id);
		break;

endswitch;
