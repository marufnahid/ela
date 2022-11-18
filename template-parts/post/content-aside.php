<?php
$blog_show_all_content = false;
$meta_info_posts       = true;
$post_tags             = true;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$blog_show_all_content = $opt['blog_show_all_content'];
	$meta_info_posts       = $opt['show_meta_info_posts'];
	$post_tags             = $opt['show_posts_tags'];
}

$post_classes  = array( 'blog_post_container' );
$post_position = '';
if ( ! isset( $ela_post_position ) || $ela_post_position != 'related_posts' ) {
	// add customhentry not hentry, because the hentry class will be deleted in the filter
	// later in ela_remove_hentry() function will check for customentry first then decide to remove hentry or not
	$post_classes[] = 'customhentry';
	$post_position  = 'normalhentry';
}
if ( ! is_single() && $blog_show_all_content && isset( $ela_content_width ) && $ela_content_width == "wide" ) {
	$post_classes[] = 'show_all_content_blog';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

    <div class="post_body">

		<?php
		if ( is_single( get_the_ID() ) && function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '
		<p class="single_breadcrumbs" id="breadcrumbs">', '</p>
		' );
		}
		?>

		<?php
		the_title( '<h1 class="entry-title screen-reader-text">', '</h1>' );
		?>

		<?php if ( $meta_info_posts ): ?>
            <div class="post_meta_container clearfix">

				<?php
				ela_post_meta( $post_position );
				?>
            </div>
		<?php endif; ?>

        <div class="post_info_wrapper">
			<?php if ( is_single( get_the_ID() ) ||
			           ( $blog_show_all_content && isset( $ela_content_width ) && $ela_content_width == "wide" )
			) {
				echo '<div class="entry-content blog_post_text blog_post_description clearfix">';
				// Only show content if is a single post, or if there's no featured image.
				/* translators: %s: Name of current post */
				the_content( sprintf( '<div class="blog_post_control_item blog_post_readmore"><a href="%1$s" class="more-link">%2$s</a></div>',
					esc_url( get_permalink( get_the_ID() ) ),
					esc_attr__( 'Continue reading', 'ela' )

				) );

				wp_link_pages( array(
					'before'      => '<div class="single_post_pagination"><div class="page-links">' . esc_attr__( 'Pages:', 'ela' ),
					'after'       => '</div></div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );

				if ( is_single() || ! strpos( $post->post_content, '<!--more-->' ) ) {
					if ( $post_tags && get_the_tags() ) {
						echo '<div class="tagcloud single_tagcloud">';
						the_tags( '', '', '' );
						echo '</div>';
					}
				}

				if ( ( $blog_show_all_content && isset( $ela_content_width ) && $ela_content_width == "wide" ) && ! strpos( $post->post_content, '<!--more-->' ) ) {
					echo '<div class="blog_post_control_item blog_post_readmore">';

					echo '<div class="blog_list_meta">';
					if ( ! post_password_required() && comments_open( get_the_ID() ) ) {
						echo '<span class="blog_list_comment_link">';
						$comments_num = '';
						if ( get_comments_number() != 0 ) {
							$comments_num = '<span class="comment_num">' . get_comments_number() . '</span>';
						}
						printf( '<a href="%1$s">%2$s%3$s</a>',
							get_comments_link(),
							'<i class="far fa-comment-alt"></i>',
							$comments_num
						);

						echo '</span>';
					}

					if ( function_exists( 'ela_blog_list_share_icons' ) ) {
						ela_blog_list_share_icons();
					}
					echo '</div>'; // end blog_post_control_item
					echo '</div>'; // end blog_post_control_item
				}

				echo '</div>'; // close .entry-content
			} else {
				echo '<div class="entry-summary blog_post_text blog_post_description">';
				echo ela_excerpt( 40 );

				echo '<div class="blog_post_control_item blog_post_readmore">';
				// read more link
				echo sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
					esc_url( get_permalink( get_the_ID() ) ),
					esc_attr__( 'Continue reading', 'ela' )

				);

				echo '<div class="blog_list_meta">';

				if ( ! post_password_required() && comments_open( get_the_ID() ) ) {
					echo '<span class="blog_list_comment_link">';
					$comments_num = '';
					if ( get_comments_number() != 0 ) {
						$comments_num = '<span class="comment_num">' . get_comments_number() . '</span>';
					}
					printf( '<a href="%1$s">%2$s%3$s</a>',
						get_comments_link(),
						'<i class="far fa-comment-alt"></i>',
						$comments_num
					);

					echo '</span>';
				}

				if ( function_exists( 'ela_blog_list_share_icons' ) ) {
					ela_blog_list_share_icons();
				}


				echo '</div>'; // end blog_post_control_item
				echo '</div>'; // end blog_post_control_item
				echo '</div>'; // close .entry-summary
			}
			?>


        </div> <!-- end post_info_wrapper -->

    </div> <!-- end post_body -->

</article>