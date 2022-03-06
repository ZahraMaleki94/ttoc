<?php

namespace ttoc\includes;

class Utility {


	/**
	 * Get initial posts
	 *
	 * @return \WP_Query
	 * @since 1.0
	 * @author zahra Maleki
	 */
	public function getPosts( $args = [] ) {
		$args = wp_parse_args( $args, [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'order'          => 'DESC',
			'orderby'        => 'post_date',
		] );

		return new \WP_Query($args);
	}


}
