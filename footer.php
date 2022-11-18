<?php
$credits_text          = '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' );
$is_goTop_btn          = true;
$sticky_footer_content = false;
$footer_custom_content = '';
$show_cookie_notice    = false;
$sticky_footer_title   = esc_html__( 'Recent Stories', 'ela' );
$custom_footer_code    = '';

if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$credits_text          = $opt['footer_credits'];
	$is_goTop_btn          = $opt['enable_go_top'];
	$sticky_footer_content = $opt['sticky_footer_content'];
	$footer_custom_content = $opt['footer_custom_content'];
	$show_cookie_notice    = $opt['show_cookie_notice'];
	$sticky_footer_title   = $opt['sticky_footer_title'];
	$custom_footer_code    = $opt['custom_footer_code'];
}
?>
</main><!-- #content -->

<footer id="colophon" class="site_footer container" role="contentinfo">

	<?php
	// check how many sidebars active in footer
	$footer_sidebars_num = 0;
	if ( is_active_sidebar( 'footer-1' ) ) {
		$footer_sidebars_num ++;
	}

	if ( is_active_sidebar( 'footer-2' ) ) {
		$footer_sidebars_num ++;
	}

	if ( is_active_sidebar( 'footer-3' ) ) {
		$footer_sidebars_num ++;
	}

	// set columns class based on number of active sidebars
	switch ( $footer_sidebars_num ) {
		case 1:
			$footer_sidebars_col_class = 'col12';
			break;
		case 2:
			$footer_sidebars_col_class = 'col6';
			break;
		case 3:
			$footer_sidebars_col_class = 'col4';
			break;
		default:
			$footer_sidebars_col_class = 'col12';
	}

	//--------------
	// remove this var after adding footers
	// ---------------
	// $footer_sidebars_num = 0;

	?>

	<?php if ( $footer_sidebars_num != 0 ): ?>
        <div class="row footer_sidebars_container footers_active_<?php echo esc_attr( $footer_sidebars_num ); ?>">
            <div class="footer_sidebars_inner_wrapper">
				<?php if ( is_active_sidebar( 'footer-1' ) ): ?>
                    <div class="footer_widgets_container footer_sidebar_1 <?php echo esc_attr( $footer_sidebars_col_class ); ?>" id="footer_sidebar_1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ): ?>
                    <div class="footer_widgets_container footer_sidebar_2 <?php echo esc_attr( $footer_sidebars_col_class ); ?>" id="footer_sidebar_2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ): ?>
                    <div class="footer_widgets_container footer_sidebar_3 <?php echo esc_attr( $footer_sidebars_col_class ); ?>" id="footer_sidebar_3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
				<?php endif; ?>
            </div> <!-- close .footer_sidebars_inner_wrapper -->
        </div> <!-- close .footer_sidebars_container -->
	<?php endif; ?>

	<?php

	if ( $credits_text != '' ):
		?>
        <div class="footer_credits footers_active_sidebars_<?php echo esc_attr( $footer_sidebars_num ); ?>">
			<?php echo $credits_text; ?>
        </div>
	<?php endif; ?>

	<?php if ( $is_goTop_btn ): ?>
        <div id="aliagototop" title="<?php esc_attr_e( "Scroll To Top", "ela" ) ?>" class="alia_gototop_button footer_button">
            <i class="fas fa-arrow-up"></i>
        </div>
	<?php endif; ?>

</footer><!-- #colophon -->

</div><!-- .site_main_container -->


<!-- start sliding sidebar content -->
<?php if ( has_nav_menu( 'top' ) || is_active_sidebar( 'sidebar-sliding' ) ): ?>
    <div class="sliding_close_helper_overlay"></div>
    <div class="site_side_container">
        <h3 class="screen-reader-text"><?php esc_html__( 'Sliding Sidebar', 'ela' ) ?></h3>
        <div class="info_sidebar">

			<?php if ( has_nav_menu( 'top' ) ) : ?>
                <div class="top_header_items_holder mobile_menu_opened">
                    <div class="main_menu">
						<?php get_template_part( 'template-parts/header/navigation', 'mobile' ); ?>
                    </div>
                </div> <!-- end .top_header_items_holder -->
			<?php endif; ?>

			<?php
			if ( is_active_sidebar( 'sidebar-sliding' ) ) {
				dynamic_sidebar( 'sidebar-sliding' );
			}
			?>
        </div>
    </div>
<?php endif; ?>
<!-- end sliding sidebar content -->

<!-- start footer static content -->
<?php if ( ( function_exists( 'ela_create_stories' ) && $sticky_footer_content ) || ( $sticky_footer_content == 'custom_footer_content' && $footer_custom_content != '' ) ): ?>
<div class="footer_static_bar">

    <div class="container footer_static_container">

        <div class="static_footer_title title">

			<?php
			if ( $sticky_footer_title != '' ):
				?>
				<?php echo $sticky_footer_title; ?><span class="main_color_text footer_title_dot">.</span>
			<?php endif; ?>

        </div>
		<?php
		if ( $sticky_footer_content == 'custom_footer_content' ) {
		?>
        <div class="static_custom_footer_content">
			<?php
			echo '<p>' . $sticky_footer_content . '</p>';
			} else {
				$post_type = ( $sticky_footer_content == 'blogposts_circle' ) ? 'post' : 'story';
				?>
                <div class="static_footer_content static_footer_stories">
					<?php
					echo ela_stories_circles( 4, '', 0, $post_type );
					?>
                </div>
			<?php } ?>

        </div>

    </div>
	<?php endif; ?>
    <!-- start footer static content -->

	<?php
	if ( $custom_footer_code != '' ) {
		echo $custom_footer_code;
	}
	?>

</div><!-- #page -->

<?php if ( function_exists( 'ela_create_stories' ) ): ?>
    <div id="ajax_modal_story" class="ajax_modal ajax_modal_story modal enable_rotate">
        <div class="story_modal_overlay_helper"></div>
    </div>
<?php endif; ?>

<!-- show cookies notice -->
<?php if ( $show_cookie_notice ): ?>
    <div class="alia_cookies_notice_jquery_container">

    </div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
