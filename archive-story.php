<?php
get_header();
?>

    <section id="primary" class="container main_content_area">
        <h4 class="page-title screen-reader-text"><?php printf( esc_html__( '%1$s Articles.', 'ela' ), get_bloginfo( 'name' ) );; ?></h4>
		<?php
		if ( have_posts() ) :
			echo '<div class="stories_grid_wrapper row">';

			$last_date = '';
			$num       = 0;

			while ( have_posts() ) : the_post();


				if ( get_the_date( 'd-m-Y' ) != $last_date ) {
					if ( $num != 0 ) {
						echo '</div>'; // end stories_day_container from previous loop
					}

					if ( ( $wp_query->current_post + 1 ) != ( $wp_query->post_count ) ) {

						if ( get_the_date( 'd-m-Y' ) == date( 'd-m-Y' ) ) {
							$grid_date = esc_attr__( 'Today', 'ela' );
						} else {
							$grid_date = get_the_date();
						}

						echo '<div class="stories_day_container clearfix">';
						echo '<h3 class="story-day-title section_title title col12">' . $grid_date . '</h3>';
					}

				}


				echo '<span data-postid="' . get_the_ID() . '" class="story_item story_hotlink col3">';
				echo get_the_post_thumbnail( $post->ID, 'ela_story_thumbnail', array( 'class' => 'img-responsive' ) );
				echo '</span>';


				$last_date = get_the_date( 'd-m-Y' );
				$num ++;
			endwhile;
			echo '</div>'; // end stories_day_container, it's not closed because the loop will not start again
			echo '</div>'; // stories_grid_wrapper

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		<?php ela_pagination(); ?>


    </section><!-- #primary -->
<?php get_footer(); ?>