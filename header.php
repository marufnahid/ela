<?php
$custom_head_code     = '';
$enable_sticky_header = true;
$show_top_header      = true;
$header_at_home       = true;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$custom_head_code     = $opt['custom_code_in_head'];
	$enable_sticky_header = $opt['enable_sticky_header'];
	$show_top_header      = $opt['show_top_header'];
	$header_at_home       = $opt['show_top_header_at_home'];
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php echo $custom_head_code; ?>
</head>
<?php global $ela_header_h1_tag;
$ela_header_h1_tag = 0; ?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php if ( $enable_sticky_header ) { ?>
        <div class="sticky_header_nav_wrapper header_nav_wrapper">
            <div class="header_nav">
				<?php
				get_template_part( 'template-parts/header/header_bar' );
				?>
            </div><!-- end .header_nav -->
        </div><!-- end .header_nav_wrapper -->
	<?php } ?>
    <div class="site_main_container">

        <header class="site_header">

			<?php if ( $show_top_header && ! ( ! is_home() && $header_at_home == true ) ): ?>

				<?php
				$custom_header_attr = '';
				if ( get_custom_header() && get_header_image() ) {
					$custom_header_attr .= ' style=background-image:url(' . get_header_image() . ')';
				}
				?>
                <div class="gray_header" <?php echo esc_attr( $custom_header_attr ); ?> >
                    <div class="container site_header">
						<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <div class="header_nav_wrapper unsticky_header_nav_wrapper">
                <div class="header_nav">
					<?php
					$ela_header_h1_tag = 1;
					get_template_part( 'template-parts/header/header_bar' );
					?>
                </div><!-- end .header_nav -->
            </div><!-- end .header_nav_wrapper -->
        </header>

        <main id="content" class="site-content">
