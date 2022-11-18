<?php
$post_layout        = 'fullwidth';
$mailchimp_code     = '';
$post_share_btns    = true;
$post_author_box    = true;
$story_author_box   = true;
$show_next_posts    = true;

if ( class_exists( 'CSF' ) ) {
	$opt         = get_option( 'ela_option_data' );
	$meta        = get_post_meta( get_the_ID(), 'post_meta_options', true );
	$post_layout = $meta['post_layout'] ?? $opt['post_layout'];

	$post_share_btns    = $opt['show_posts_share_buttons'];
	$mailchimp_code     = $opt['mailchimp_code'];
	$post_author_box    = $opt['show_author_box_posts'];
	$story_author_box   = $opt['stories_author_box'];
	$show_next_posts    = $opt['show_next_posts'];
}

$sidebar_width_class = 'no_sidebar_post_single';
if ( $post_layout == 'sidebar_l' ) {
	$sidebar_width_class = 'sidebar_post_single';
}
?>
<?php get_header(); ?>

    <section id="primary" class="container main_content_area">

        <!-- open row and col in case of sidebar layout -->
		<?php if ( $post_layout == 'sidebar_l' ): ?>

        <div class="row post_width_sidebar_row">
            <div class="col8 sidebar_post_content_col">
				<?php endif; ?> <!-- end check for post layout -->

                <div class="row full_width_post_single <?php echo $sidebar_width_class; ?>">
                    <div class="col12">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/content', get_post_format() );

							if ( function_exists( 'ela_share_icons' ) && $post_share_btns ):
								ela_share_icons();
							endif;
							?>

							<?php
							if ( $mailchimp_code != '' ) {
								get_template_part( 'template-parts/single-post/mailchimp' );
							}
							?>

							<?php if ( $post_author_box && get_the_author_meta( 'description' ) ) {
								get_template_part( 'template-parts/single-post/author-meta' );
							}

							if ( comments_open() || get_comments_number() ) :
								echo '<div class="comment_container">';
								comments_template();
								echo '</div>';
							endif;

							// Show next post
							if ( $show_next_posts ):
								get_template_part( 'template-parts/single-post/next-post' );
							endif;

						endwhile;
						?>

                    </div><!-- close col12 just inside .full_width_list -->
                </div> <!-- close .full_width_list -->

                <!-- close col and row in case of sidebar layout -->
				<?php if ( $post_layout == 'sidebar_l' ): ?>

            </div><!-- close post_content_col col8 -->

            <!-- start default sidebar col -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <div class="default_widgets_container default_widgets_col col4">
                    <div id="default_sidebar_widget" class="widget_area">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
                    </div>
                </div><!-- #intro_widgets_container -->
			<?php endif; ?>
            <!-- end default sidebar col -->

        </div><!-- close row -->
	<?php endif; ?> <!-- end check for post layout -->

    </section><!-- #primary -->
<?php get_footer();
