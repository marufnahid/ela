<?php
/*
Template Name: Full Width then List Blog
*/
get_header();

$blog_category = '';
if ( class_exists( 'CSF' ) ) {
	$meta          = get_post_meta( get_the_ID(), 'blog_meta_options', true );
	$blog_category = isset($meta['blog_category']) ?? '';
}
?>

<?php if ( is_active_sidebar( 'sidebar-intro' ) ) : ?>
    <section class="container intro_widgets_container">
        <div id="intro_sidebar_widget" class="widget_area">
			<?php dynamic_sidebar( 'sidebar-intro' ); ?>
        </div>
    </section><!-- #intro_widgets_container -->
<?php endif; ?>


<?php

$args = array( 'post_type' => 'post' );
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

$args['paged']          = $paged;
$args['cat']            = $blog_category;
$args['posts_per_page'] = get_option( 'posts_per_page' );

$wp_query = new WP_Query( $args );

?>

    <section id="primary" class="container main_content_area">
        <h4 class="page-title screen-reader-text"><?php printf( esc_html__( '%1$s Articles.', 'ela' ), get_bloginfo( 'name' ) );; ?></h4>
		<?php

		// set layout settings
		set_query_var( 'custom_blog_layout', 'firstflist' );

		if ( have_posts() ) :
			get_template_part( 'template-parts/page/blog', 'layout' );
		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>
        <!-- <div class="loadmore_wrapper">
			<span class="loadmore_button">More Topics</span>
		</div> -->
    </section><!-- #primary -->

<?php get_footer(); ?>