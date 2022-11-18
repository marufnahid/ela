<?php

define( 'WP_USE_THEMES', false );
$wpdir = explode( "wp-content", __FILE__ );
require $wpdir[0] . "wp-load.php";

$show_notice  = false;
$show_icon    = true;
$icon_class   = '';
$notice_title = '';
$cookie_desc  = '';
$notice_link  = '';

if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$show_notice  = $opt['show_cookie_notice'];
	$show_icon    = $opt['show_cookie_icon'];
	$icon_class   = $opt['cookie_icon_class'];
	$notice_title = $opt['cookie_notice_title'];
	$cookie_desc  = $opt['cookie_notice_desc'];
	$notice_link  = $opt['cookie_notice_link'];
}

if ( isset( $_POST['cookiesnoticestatus'] ) && $_POST['cookiesnoticestatus'] == "accepted" ) {
	if ( is_user_logged_in() ) {
		update_user_meta( get_current_user_id(), 'ela_cookies_accepted', 1 );
	} else {
		setcookie( 'ela_cookies_accepted', 1, time() + ( 365 * 24 * 60 * 60 ) );
	}
} elseif ( isset( $_POST['cookiesnoticestatus'] ) && $_POST['cookiesnoticestatus'] == "shownotice" && ! ela_cookies_accepted() && $show_notice && $cookie_desc != '' ) {
	?>
    <div class="alia_cookies_notice_wrapper">
        <div class="alia_cookies_notice">


			<?php if ( $show_icon ): ?>
				<?php
				if ( $icon_class != '' ) {
					$cookies_icon_class = '<i class="cookies_bar_icon ' . $icon_class . '"></i>';
				} else {
					$cookies_icon_class = '<i class="cookies_bar_icon fas fa-cookie-bite"></i>';
				}
				?>
                <div class="cookies_icons"><?php echo $cookies_icon_class; ?></div>
			<?php endif; ?>

			<?php if ( $notice_title != '' ): ?>
                <h3 class="title alia_cookies_title"><?php echo $notice_title; ?></h3>
			<?php endif; ?>

            <p class="alia_cookis_description"><?php echo $cookie_desc; ?></p>
            <div class="alia_cookie_accept_area">

				<?php if ( $notice_link != '' ): ?>
                    <span class="cookies_accept_links"><?php echo $notice_link; ?></span>
				<?php endif; ?>

                <span class="cookies_accept_button"><?php esc_html__( 'I Agree', 'ela' ); ?></span>
            </div>
        </div>
    </div>
	<?php
}
?>