<?php

class SPTP_Permalink {

	public function __construct() {
		add_filter( 'post_type_link', array( $this, 'post_type_link' ), 10, 2 );
	}

	/**
	 *
	 * Fix post_type permalink from postname to id.
	 *
	 * @param string $post_link The post's permalink.
	 * @param WP_Post $post The post in question.
	 *
	 * @return string
	 */
	public function post_type_link( $post_link, WP_Post $post ) {

		if( !SPTP_Util::get_option( "sptp_{$post->post_type}_structure" ) ) {
			return $post_link;
		}

		$rewritecode = [
			"%{$post->post_type}_id%",
		];

		$rewritereplace = [
			$post->ID,
		];

		return str_replace( $rewritecode, $rewritereplace, $post_link );

	}

}