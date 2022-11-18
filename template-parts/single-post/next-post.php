<?php
$post_layout        = 'fullwidth';
if ( class_exists( 'CSF' ) ) {
	$opt         = get_option( 'ela_option_data' );
	$meta        = get_post_meta( get_the_ID(), 'post_meta_options', true );
	$post_layout = $meta['post_layout'] ?? $opt['post_layout'];
}
$sidebar_width_class = 'no_sidebar_post_single';
if ( $post_layout == 'sidebar_l' ) {
	$sidebar_width_class = 'sidebar_post_single';
}
$current_id   = $post->ID;
$posts_not_in = array( $current_id );
$prev_post = get_previous_post();

if ( ! empty( $prev_post ) ) {

	set_query_var( 'ela_content_width', 'two_coloumns_list' );
	if ( $post_layout == 'sidebar_l' ) {
		set_query_var( 'ela_content_layout', 'layout_with_sidebar' );
	}
	set_query_var( 'ela_post_position', 'related_posts' );
	array_push( $posts_not_in, $prev_post->ID );

	$post = $prev_post;
	setup_postdata( $post );
	echo '<div class="read_next_loop_container">';
	echo '<h4 class="read_next_title section_title title">' . esc_attr__( 'Read Next', 'ela' ) . '</h4>';

	echo '<div class="row two_coloumns_list"><div class="col12">';
	echo '<div class="thepost_row row">';
	get_template_part( 'template-parts/post/content', get_post_format( $prev_post->ID ) );
	echo '</div>'; // end thepost_row
	echo '</div></div>'; // end two_coloumns_list & col12
	echo '</div>';
	wp_reset_postdata();
} else {

	// if last post show first post in the blog to loop posts
	$args = array( 'posts_per_page'      => 1,
	               'ignore_sticky_posts' => 1,
	               'post__not_in'        => $posts_not_in
	);

	$recent_posts = new WP_Query( $args );

	if ( $recent_posts->have_posts() ):
		echo '<div class="read_next_loop_container">';
		echo '<div class="row two_coloumns_list"><div class="col12">';
		while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
			set_query_var( 'ela_content_width', 'two_coloumns_list' );
			if ( $sidebar_width_class == 'sidebar_post_single' ) {
				set_query_var( 'ela_content_layout', 'layout_with_sidebar' );
			}
			set_query_var( 'ela_post_position', 'related_posts' );
			array_push( $posts_not_in, $post->ID );

			echo '<h4 class="read_next_title section_title title">' . esc_attr__( 'Read Next', 'ela' ) . '</h4>';
			echo '<div class="thepost_row row">';
			get_template_part( 'template-parts/post/content', get_post_format( $post->ID ) );
			echo '</div>'; // end thepost_row
		endwhile;
		echo '</div></div>'; // end two_coloumns_list & col12
		echo '</div>'; // end read_next_loop_container

	endif;
	wp_reset_query();
}
