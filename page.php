<?php
$page_layout      = 'fullwidth';
$page_share_btns  = true;
$page_author_box  = true;
$story_author_box = true;

if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$meta             = get_post_meta( get_the_ID(), 'page_meta_options', true );
	$page_layout      = ! empty( $meta['page_layout'] ) ?? $opt['page_layout'];
	$page_share_btns  = $opt['show_page_share_buttons'];
	$page_author_box  = $opt['show_page_author_boxs'];
	$story_author_box = $opt['stories_author_box'];
}
?>
<?php get_header(); ?>

    <section id="primary" class="container main_content_area">

		<?php $sidebar_width_class = 'no_sidebar_post_single'; ?>
		<?php if ( $page_layout == 'sidebar_l' ): ?>
        <div class="row">
            <div class="col8 sidebar_post_content_col">
				<?php $sidebar_width_class = 'sidebar_post_single' ?>
				<?php endif; ?> <!-- end check for post layout -->

                <div class="row full_width_page_single <?php echo esc_attr( $sidebar_width_class ); ?>">
                    <div class="col12">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/page/content', 'page' );

							if ( function_exists( 'ela_share_icons' ) && $page_share_btns ):
								ela_share_icons();
							endif;

							if ( $page_author_box && get_the_author_meta( 'description' ) ): ?>

                                <div class="author_info_container author_single_box">
                                    <div class="row">
                                        <div class="author_avatar_col col">
											<?php printf( '<a class="author_avatar_url" href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), ela_filter_lazyload_images( get_avatar( get_the_author_meta( 'ID' ), 150 ) ) ); ?>
                                        </div>
                                        <div class="author_info_col col">

                                            <div class="author_box_info_header">
                                                <h2 class="author_display_name title"><?php printf( '<a class="author_name_url url fn n" href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() ); ?></h2>

												<?php
												// show author social icons in header only if no story circles shown
												if (
													function_exists( 'ela_create_stories' ) && $story_author_box && function_exists( 'ela_author_social_icons' ) &&
													ela_author_social_icons() != '' ) {
													if ( function_exists( 'ela_author_social_icons' ) ) {
														echo ela_author_social_icons();
													}
												}
												?>
                                            </div>

                                            <div class="author_description">
												<?php the_author_meta( 'description' ); ?>
                                            </div>
											<?php
											if ( function_exists( 'ela_create_stories' ) && $story_author_box ) {
												echo ela_stories_circles( 5, '', get_the_author_meta( 'ID' ) );
											} else {
												// if no stories, show social icons below text
												if ( function_exists( 'ela_author_social_icons' ) ) {
													echo ela_author_social_icons();
												}
											}
											?>
                                        </div>
                                    </div>
                                </div>

							<?php
							endif;

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								echo '<div class="comment_container">';
								comments_template();
								echo '</div>';
							endif;


						endwhile; // End of the loop.
						?>

                    </div><!-- close col12 just inside .full_width_list -->
                </div> <!-- close .full_width_list -->

                <!-- close col and row in case of sidebar layout -->
				<?php if ( $page_layout == 'sidebar_l' ): ?>


            </div><!-- close post_content_col col8 -->

            <!-- start default sidebar col -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <div class="default_widgets_container col4">
                    <div id="default_sidebar_widget" class="widget_area">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
                    </div>
                </div><!-- #intro_widgets_container -->
			<?php endif; ?>
            <!-- end default sidebar col -->

        </div><!-- close row -->
	<?php endif; ?> <!-- end check for post layout -->

    </section><!-- #primary -->
<?php get_footer(); ?>