<?php
$story_author_box   = true;
if ( class_exists( 'CSF' ) ) {
	$opt         = get_option( 'ela_option_data' );
	$story_author_box   = $opt['stories_author_box'];
}
$author_posts_url   = get_author_posts_url( get_the_author_meta( 'ID' ) );
$author_description = get_the_author_meta( 'description', get_the_author_meta( 'ID' ) );
?>
<div class="author_info_container author_single_box">
	<div class="row">
		<div class="author_avatar_col col">
			<?php
			printf( '<a class="author_avatar_url" href="%1$s">%2$s</a>', esc_url( $author_posts_url ), ela_filter_lazyload_images( get_avatar( get_the_author_meta( 'ID' ), 150 ) ) ); ?>
		</div>
		<div class="author_info_col col">

			<div class="author_box_info_header">
				<h2 class="author_display_name title"><?php printf( '<a class="author_name_url url fn n" href="%1$s">%2$s</a>', esc_url( $author_posts_url ), get_the_author() );
					?></h2>

				<?php
				// show author social icons in header only if no story circles shown
				if ( function_exists( 'ela_create_stories' ) && $story_author_box && function_exists( 'ela_author_social_icons' ) && ela_author_social_icons() != '' ) {
					if ( function_exists( 'ela_author_social_icons' ) ) {
						echo ela_author_social_icons();
					}
				}
				?>
			</div>
			<?php if ( $author_description != '' ) ?>
			<div class="author_description">
				<?php echo esc_html( $author_description ); ?>
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
