<?php
global $ela_header_h1_tag;
if ( $ela_header_h1_tag == 1 && is_front_page() ) {
	$text_logo_attr = 'h1';
} else {
	$text_logo_attr = 'p';
}
$default_retina_logo = '';
$header_site_title   = true;
$header_bar_logo     = false;
$show_header_logo    = false;
$site_title_dot      = true;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$default_retina_logo = $opt['default_logo_retina'];
	$header_site_title   = $opt['show_header_site_title'];
	$header_bar_logo     = $opt['header_bar_logo'];
	$menu_logo           = $opt['menu_logo'];
	$menu_retina_logo    = $opt['menu_logo_retina'];
	$show_header_logo    = $opt['show_header_logo'];
	$site_title_dot      = $opt['site_title_dot'];
}
if ( $default_retina_logo ) {
	$is_retina_logo = " no_retina_logo";
} else {
	$is_retina_logo = " has_retina_logo";
}
?>

<div class="container">

	<?php // if image & title are shown in the top bar
	if ( $header_site_title ): ?>
    <div class="site_branding">
		<?php if ( $header_bar_logo && $menu_logo ):
		$image_srcset = '';
		if ( $menu_retina_logo ) {
			$image_srcset = 'srcset="' . esc_url( $menu_logo ) . ' 1x, ' . esc_url( $menu_retina_logo ) . ' 2x"';
		} ?>
        <a class="alia_logo default_logo_header_bar <?php echo esc_attr( $is_retina_logo ); ?>" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img height="42" src="<?php echo esc_url( $menu_logo ); ?>" <?php echo $image_srcset; ?> class="site_logo img-responsive menu_site_logo_image clearfix"
                 alt="<?php bloginfo( 'name' ); ?>"/>
        </a>
		<?php if ( $show_header_logo ): ?>
        <<?php echo $text_logo_attr; ?> class="screen-reader-text site_logo site-title clearfix"><?php bloginfo( 'name' ); ?></<?php echo $text_logo_attr; ?>>
<?php endif;// if the title is shown in the top bar;
else : ?>
    <<?php echo $text_logo_attr; ?> class="text_logo"><?php
	?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' );
		if ( $site_title_dot ): ?><span class="logo_dot"></span><?php endif;
		?></a>
</<?php echo $text_logo_attr; ?>>
<?php if ( $ela_header_h1_tag == 1 ) { ?>
    <h3 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h3>
<?php } ?>
<?php endif; ?>
    </div>
<?php endif; ?>


<!-- Place header control before main menu if site title is enabled -->
<?php if ( $header_site_title ): ?>
    <div class="header_controls">

        <!-- start search box -->
        <div class="header_search header_control_wrapper">
			<?php get_template_part( 'header', 'searchform' ); ?>
        </div>
        <!-- end search box -->

		<?php if ( has_nav_menu( 'top' ) || is_active_sidebar( 'sidebar-sliding' ) ): ?>
            <div class="header_sliding_sidebar_control header_control_wrapper">
                <a id="user_control_icon" class="sliding_sidebar_button" href="#">
                    <i class="fas fa-bars header_control_icon"></i>
                </a>
            </div>
		<?php endif; ?>

    </div>
<?php endif; ?>


<?php if ( has_nav_menu( 'top' ) ) : ?>
    <div class="main_menu">
		<?php get_template_part( 'template-parts/header/navigation', 'top' ); ?>
        <span class="menu_mark_circle hidden_mark_circle"></span>
    </div>
<?php endif; ?>

<!-- Place header control after main menu if site title is enabled -->
<?php if ( ! $header_site_title ): ?>
    <div class="header_controls">

        <!-- start search box -->
        <div class="header_search header_control_wrapper">
			<?php get_template_part( 'header', 'searchform' ); ?>
        </div>
        <!-- end search box -->

		<?php if ( has_nav_menu( 'top' ) || is_active_sidebar( 'sidebar-sliding' ) ): ?>
            <div class="header_sliding_sidebar_control header_control_wrapper">
                <a id="user_control_icon" class="sliding_sidebar_button" href="#">
                    <i class="fas fa-bars header_control_icon"></i>
                </a>
            </div>
		<?php endif; ?>

    </div>
<?php endif; ?>

</div><!-- end .container -->