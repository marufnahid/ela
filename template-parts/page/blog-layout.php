<?php
$blog_layout_opt     = 'flist';
$banner_devices_size = false;
$featured_first_page = false;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$blog_layout_opt     = $opt['blog_layout'];
	$banner_devices_size = $opt['banners_devices_size'];
	$featured_first_page = $opt['featured_first_page'];
}

if ( isset( $custom_blog_layout ) && $custom_blog_layout ) {
	$blog_layout = $custom_blog_layout;
} else {
	$blog_layout = $blog_layout_opt;
}

if ( $blog_layout == 'grid' ) {
	?>
    <div class="row grid_list grid_list_2_col">
		<?php
		/* Start the Loop */

		set_query_var( 'ela_content_width', 'grid' );
		while ( have_posts() ) : the_post();
			echo '<div class="grid_col col6">';
			get_template_part( 'template-parts/post/content', get_post_format() );
			echo '</div>'; // end thepost_row row
		endwhile;
		?>
        <!-- Close grid_list -->
    </div>
	<?php
	ela_pagination();
} elseif ( $blog_layout == 'grid3col' ) {
	?>
    <div class="row grid_list grid_list_3_col">
		<?php
		/* Start the Loop */
		if ( $banner_devices_size ) {
			set_query_var( 'ela_content_width', 'grid3col' );
		} else {
			set_query_var( 'ela_content_width', 'grid' );
		}

		while ( have_posts() ) : the_post();
			echo '<div class="grid_col col4">';
			get_template_part( 'template-parts/post/content', get_post_format() );
			echo '</div>'; // end thepost_row row
		endwhile;
		?>
        <!-- Close grid_list -->
    </div>
	<?php
	ela_pagination();
} elseif ( $blog_layout == 'list' ) {
	?>
    <div class="row two_coloumns_list">
        <div class="col12">
			<?php
			/* Start the Loop */
			set_query_var( 'ela_content_width', 'two_coloumns_list' );
			while ( have_posts() ) : the_post();
				echo '<div class="thepost_row row">';
				get_template_part( 'template-parts/post/content', get_post_format() );
				echo '</div>'; // end thepost_row row
			endwhile;
			?>
            <!-- Close two_coloumns_list row div and col12 div -->
        </div>
    </div>
	<?php
	ela_pagination();
} elseif ( $blog_layout == 'firstflist' ) {
	// Show Featured on first page only if set
	if ( $featured_first_page && ( get_query_var( 'paged', 1 ) > 1 ) ) {
		$num = 1;
	} else {
		$num = 0;
	}
	/* Start the Loop */
	set_query_var( 'ela_content_width', 'wide' );
	while ( have_posts() ) : the_post();
		$num ++;
		if ( $num == 1 ) {
			set_query_var( 'ela_content_width', 'wide' );
			echo '<div class="row full_width_list first_full_width"><div class="col12">';
		} elseif ( $num == 2 ) {
			set_query_var( 'ela_content_width', 'two_coloumns_list' );
			echo '<div class="row two_coloumns_list"><div class="col12">';
			echo '<div class="thepost_row row">';
		} else {
			set_query_var( 'ela_content_width', 'two_coloumns_list' );
			echo '<div class="thepost_row row">';
		}

		get_template_part( 'template-parts/post/content', get_post_format() );

		if ( $num == 1 ) {
			echo '</div></div>'; // Close full_width_list row div and col12 div
		} else {
			echo '</div>'; // end thepost_row row
		}
	endwhile;
	if ( $num > 1 ) {
		echo '</div></div>'; // Close two_coloumns_list row div and col12 div
	}
	ela_pagination();
} elseif ( $blog_layout == 'fullsidebar' ) {
	?>
    <div class="row post_width_sidebar_row">
        <div class="col8 sidebar_post_content_col">

            <div class="row full_width_list">
                <div class="col12">
					<?php
					/* Start the Loop */
					set_query_var( 'ela_content_width', 'wide' );
					if ( $banner_devices_size ) {
						set_query_var( 'ela_sidebar_position', 'sidebar_l' );
					}
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;
					?>
                    <!-- Close full_width_list row div and col12 div -->
                </div>
            </div>
			<?php ela_pagination(); ?>

        </div> <!-- Close .sidebar_post_content_col .col8 -->


        <!-- start default sidebar col -->
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="default_widgets_container default_widgets_col col4">
                <div id="default_sidebar_widget" class="widget_area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            </div><!-- #intro_widgets_container -->
		<?php endif; ?>
        <!-- end default sidebar col -->

    </div><!-- Close .row -->
	<?php
} elseif ( $blog_layout == 'gridsidebar' ) {
	?>
    <div class="row post_width_sidebar_row">
        <div class="col8 sidebar_post_content_col">
            <div class="row grid_list grid_list_2_col">
				<?php
				/* Start the Loop */

				set_query_var( 'ela_content_width', 'grid' );
				while ( have_posts() ) : the_post();
					echo '<div class="grid_col col6">';
					get_template_part( 'template-parts/post/content', get_post_format() );
					echo '</div>'; // end thepost_row row
				endwhile;
				?>
                <!-- Close grid_list -->
            </div>
			<?php ela_pagination(); ?>
        </div> <!-- Close .sidebar_post_content_col .col8 -->


        <!-- start default sidebar col -->
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="default_widgets_container default_widgets_col col4">
                <div id="default_sidebar_widget" class="widget_area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            </div><!-- #intro_widgets_container -->
		<?php endif; ?>
        <!-- end default sidebar col -->
    </div><!-- Close .row -->
	<?php
} else {
	?>
    <div class="row full_width_list">
        <div class="col12">
			<?php
			/* Start the Loop */
			set_query_var( 'ela_content_width', 'wide' );
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;
			?>
            <!-- Close full_width_list row div and col12 div -->
        </div>
    </div>
	<?php
	ela_pagination();
}

?>