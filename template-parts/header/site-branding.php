<?php
$show_header_logo    = true;
$default_logo        = '';
$default_retina_logo = '';
$header_desc         = '';
$header_social_icons = true;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$show_header_logo    = $opt['show_header_logo'];
	$default_logo        = $opt['default_logo'];
	$default_retina_logo = $opt['default_logo_retina'];
	$logo_width_opt      = $opt['logo_width'];
	$logo_height_opt     = $opt['logo_height'];
	$header_site_title   = $opt['show_header_site_title'];
	$header_desc         = $opt['header_desc'];
	$header_social_icons = $opt['show_header_social_icons'];
}
?>

<?php if ( $show_header_logo ): ?>
    <div class="header_square_logo">
		<?php if ( $default_logo ):

			$is_retina_logo = " no_retina_logo";

			// logo size
			$logo_width     = 'auto';
			$logo_height    = 'auto';
			$logo_size_att  = '';
			$logo_style_att = '';

			if ( $logo_width_opt && $logo_width_opt != 0 ) {
				$logo_width     = strval( $logo_width_opt );
				$logo_size_att  .= ' width=' . strval( $logo_width_opt ) . '';
				$logo_style_att .= '.site_logo_image { width : ' . $logo_width . 'px; }';
			}

			if ( $logo_height_opt && $logo_height_opt != 0 ) {
				$logo_height    = strval( $logo_height_opt );
				$logo_size_att  .= ' height=' . strval( $logo_height_opt ) . '';
				$logo_style_att .= '.site_logo_image { height : ' . $logo_height . 'px; }';
			}

			if ( $logo_style_att != '' ) {
				echo '<style>';
				echo esc_attr( $logo_style_att );
				echo '</style>';
			}

			$srcset         = '';
			$is_retina_logo = " no_retina_logo";
			if ( esc_url( $default_retina_logo ) ) {
				$srcset         = 'srcset="' . esc_url( $default_logo ) . ' 1x, ' . esc_url( $default_retina_logo ) . ' 2x"';
				$is_retina_logo = " has_retina_logo";
			}
			?>
            <a class="alia_logo default_logo <?php echo esc_attr( $is_retina_logo ); ?>" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img <?php echo esc_attr( $logo_size_att ); ?> src="<?php echo $default_logo; ?>" <?php echo $srcset; ?> class="site_logo img-responsive site_logo_image clearfix"
                                                               alt="<?php
				                                               bloginfo( 'name' ); ?>"/>
            </a>
			<?php if ( ! $header_site_title ): ?>
            <h1 class="screen-reader-text site_logo site-title clearfix"><?php bloginfo( 'name' ); ?></h1>
		<?php endif; ?>
		<?php else: ?>
            <a class="square_letter_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><?php echo mb_substr( get_bloginfo( 'name' ), 0, 1 ) ?></a>
		<?php endif; // end if alia_default_logo ?>
    </div>

	<?php if ( $header_desc ): ?>
        <div class="header_tagline">

			<?php
			if ( $header_desc ) {
				echo $header_desc;
			} else {

				$description = get_bloginfo( 'description', 'display' );

				if ( $description || is_customize_preview() ) :

					echo esc_attr( $description );
				endif;
			}
			?>
        </div>
	<?php endif;

	if ( $header_social_icons ):
		echo ela_social_icons_list( 'header_social_icons' );
	endif;
endif;
