<?php
$show_page_meta = false;
if ( class_exists( 'CSF' ) ) {
	$opt            = get_option( 'ela_option_data' );
	$show_page_meta = $opt['show_page_meta_info'];
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog_page_container' ); ?>>

    <div class="single_page_body">
        <div class="post_header post_header_single">
			<?php
			the_title( '<h1 class="entry-title title post_title section_title">', '</h1>' );
			?>
        </div>

    </div>

	<?php if ( has_post_thumbnail() ): ?>
        <figure class="post_banner page_banner">
            <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'ela_wide_banner' ); ?>
            </a>
        </figure>
	<?php endif; ?>

    <div class="page_body">

        <div class="post_info_wrapper">
			<?php
			echo '<div class="entry-content blog_page_text blog_page_description">';
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="single_post_pagination"><div class="page-links">' . esc_attr__( 'Pages:', 'ela' ),
				'after'       => '</div></div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			echo '</div>'; // close .entry-content
			?>
        </div> <!-- end post_info_wrapper -->

		<?php if ( $show_page_meta ): ?>
            <div class="post_meta_container post_meta_container_single post_meta_container_page clearfix">

				<?php
				ela_post_meta();
				?>
            </div>
		<?php endif; ?>

    </div> <!-- end post_body -->
</article>