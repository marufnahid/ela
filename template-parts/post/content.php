<?php
$blog_show_all_content   = false;
$post_layout             = 'fullwidth';
$meta_info_posts         = true;
$post_tags               = true;
$banner_standard_post    = true;
$crop_bannar_list        = true;
$crop_bannar_inside_post = false;
$banner_caption          = false;
if ( class_exists( 'CSF' ) ) {
	$opt                     = get_option( 'ela_option_data' );
	$meta                    = get_post_meta( get_the_ID(), 'post_meta_options', true );
	$post_layout             = $meta['post_layout'] ?? $opt['post_layout'];
	$blog_show_all_content   = $opt['blog_show_all_content'];
	$banner_standard_post    = $opt['show_banner_inside_standard_post'];
	$crop_bannar_list        = $opt['crop_banner_post_list'];
	$crop_bannar_inside_post = $opt['crop_banner_inside_post'];
	$meta_info_posts         = $opt['show_meta_info_posts'];
	$banner_caption          = $opt['show_banner_caption'];
	$post_tags               = $opt['show_posts_tags'];
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

	<?php
	$post_banner_class = 'no_post_banner';

	if ( ( $banner_standard_post || ! is_single( get_the_ID() ) ) && has_post_thumbnail() ) {
		$post_banner_class = 'has_post_banner';
	}

	if ( isset( $ela_content_width ) && ( $ela_content_width == 'two_coloumns_list' || $ela_content_width == 'grid' ) ) {
		$ela_post_banner = 'ela_grid_banner';
		if (
			! $crop_bannar_list && ! is_single( get_the_ID() )
			|| ! $crop_bannar_inside_post && is_single( get_the_ID() )
		) {
			$ela_post_banner = 'ela_grid_banner_uncrop';
		}
	} else if ( isset( $ela_content_width ) && $ela_content_width == 'grid3col' ) {
		$ela_post_banner = 'ela_grid_banner_3col';
		if (
			! $crop_bannar_list && ! is_single( get_the_ID() )
			|| ! $crop_bannar_inside_post && is_single( get_the_ID() )
		) {
			$ela_post_banner = 'ela_grid_banner_3col_uncrop';
		}
	} else {
		$ela_post_banner = 'ela_wide_banner';
		if (
			! $crop_bannar_list && ! is_single( get_the_ID() )
			|| ! $crop_bannar_inside_post && is_single( get_the_ID() )
		) {
			$ela_post_banner = 'full';
		}
		if ( is_single() && $post_layout == 'sidebar_l'
		     ||
		     ( isset( $alia_sidebar_position ) && $alia_sidebar_position == 'sidebar_l' ) ) {
			$ela_post_banner = 'alia_wide_banner_sidebar';
			if ( ! $crop_bannar_inside_post ) {
				$ela_post_banner = 'alia_full_banner_sidebar';
			}
		}
	}
	?>
	<?php if ( is_single( get_the_ID() ) ): ?>

        <div class="single_post_body <?php echo esc_attr( $post_banner_class ); ?>">

			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '
			<p class="single_breadcrumbs" id="breadcrumbs">', '</p>
			' );
			}
			?>

            <div class="post_header post_header_single">
				<?php
				the_title( '<h1 class="entry-title title post_title">', '</h1>' );
				?>
            </div>

			<?php if ( $meta_info_posts ): ?>
                <div class="post_meta_container post_meta_container_single clearfix">

					<?php
					ela_post_meta( $post_position );
					?>
                </div>
			<?php endif; ?>

        </div>
	<?php endif ?>

	<?php if ( ( $banner_standard_post || ! is_single( get_the_ID() ) ) && has_post_thumbnail() ): ?>
        <figure class="post_banner">

			<?php if ( ! is_single( get_the_ID() ) ): ?>
                <a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $ela_post_banner ); ?>
                </a>
			<?php else: ?>
				<?php the_post_thumbnail( $ela_post_banner ); ?>
			<?php endif; ?>
			<?php
			if ( $banner_caption ) {
				echo '<figcaption class="wp-caption-text">' . get_post( get_post_thumbnail_id() )->post_excerpt . '</figcaption>';
			}
			?>
        </figure>
		<?php $post_banner_class = 'has_post_banner'; ?>
	<?php endif; ?>

    <div class="post_body <?php echo esc_attr( $post_banner_class ); ?>">
		<?php if ( ! is_single( get_the_ID() ) ): ?>
            <div class="post_header">
				<?php
				if ( is_front_page() && is_home() ) {
					the_title( '<h3 class="entry-title title post_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				} else {
					the_title( '<h2 class="entry-title title post_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
				?>
            </div>

			<?php if ( $meta_info_posts ): ?>
                <div class="post_meta_container clearfix">

					<?php
					ela_post_meta( $post_position );
					?>
                </div>
			<?php endif; ?>
		<?php endif ?>

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
					echo '</div>';
					echo '</div>'; // end blog_post_control_item
				}

				echo '</div>'; // close .entry-content
			} elseif ( ! isset( $ela_content_layout ) || $ela_content_layout != 'layout_with_sidebar' || $post_banner_class == 'no_post_banner' ) {
				echo '<div class="entry-summary blog_post_text blog_post_description">';
				if ( $ela_content_width == 'two_coloumns_list' && has_post_thumbnail() ) {
					echo ela_excerpt( 20 );
				} else {
					echo ela_excerpt( 40 );
				}

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
				echo '</div>';
				echo '</div>'; // end blog_post_control_item
				echo '</div>'; // close .entry-summary
			}
			?>


        </div> <!-- end post_info_wrapper -->
    </div> <!-- end post_body -->
</article>