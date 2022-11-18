<?php
function ela_scripts() {
	$opt                    = get_option( 'ela_option_data' );
	$lazyload_iframe_banner = $opt['lazyload_iframe_banner'] ?? false;
	$lazyload_image_banner  = $opt['lazyload_image_banner'] ?? false;

	// Theme stylesheet.
	wp_enqueue_style( 'ela-style', get_stylesheet_uri(), array(), time() );
	if ( is_rtl() ) {
		wp_style_add_data( 'ela-style', 'rtl', 'replace' );
	}

	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/inc/frameworks/fontawesome/css/all.min.css' ), array(), '5.13.5' );


	if ( $lazyload_iframe_banner == true || $lazyload_image_banner == true ) {
		wp_enqueue_script( 'ela-lazyload', get_theme_file_uri( '/assets/js/lazysizes.min.js' ), array( 'jquery' ), '1.47', true );
	}

	wp_enqueue_script( 'ela-global-script', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.47	', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// define js vars
	$ela_variables_array = array(
		'ajax_accept_cookies' => get_theme_file_uri( '/acceptcookies.php', __FILE__ ),
	);

	wp_localize_script( 'ela-global-script', 'ela_vars', $ela_variables_array );
}

add_action( 'wp_enqueue_scripts', 'ela_scripts' );

/* --------
 * add custom css.
------------------------------------------- */
function ela_custom_css() {
	$main_font  = 'manrope';
	$title_font = 'manrope';
	$site_width = '';
	$main_color = "#ff374a";
	if ( class_exists( 'CSF' ) ) {
		$opt        = get_option( 'ela_option_data' );
		$main_font  = $opt['main_font'];
		$title_font = $opt['title_font'];
		$site_width = $opt['site_width'];
		$main_color = $opt['main_color'];
	}

	$main_font_css          = '';
	$title_font_css         = '';
	$ela_custom_fonts_array = ela_custom_fonts_collection();

	if ( $main_font && $main_font != 'default' ) {
		if ( $main_font == 'system' ) {
			$main_font_css = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';

		} else {
			$main_font_id     = $main_font;
			$main_custom_font = $ela_custom_fonts_array[ $main_font_id ];
			$main_font_css    = $main_custom_font['css'];
		}
	}

	if ( $title_font && $title_font != 'default' ) {
		if ( $title_font == 'system' ) {
			$title_font_css = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
		} else {
			$title_font_id     = $title_font;
			$title_custom_font = $ela_custom_fonts_array[ $title_font_id ];
			$title_font_css    = $title_custom_font['css'];
		}

	}

	// Add custom fonts URL
	wp_enqueue_style( 'ela_fonts', ela_custom_fonts_url(), array(), null );

	// Add custom fonts to style
	wp_enqueue_style(
		'ela-customstyle', get_theme_file_uri( '/assets/css/customstyle.css' )
	);

	$custom_css = "";

	if ( $site_width ) {
		$custom_css .= "@media (min-width: " . $site_width . "px) {.container { width: " . $site_width . "px }}";
	}

	if ( $main_font_css ) {
		$custom_css .= "body { font-family: {$main_font_css}; }";
	}

	if ( $title_font_css ) {
		$custom_css .= "h1, h2, h3, h4, h5, h6, .title, .text_logo, .comment-reply-title, .header_square_logo a.square_letter_logo { font-family: {$title_font_css}; }";
	}


	if ( $main_color ) {

		$custom_css .= "a { color: {$main_color}; }";

		$custom_css .= "input[type='submit']:hover { background-color: {$main_color}; }";

		$custom_css .= ".main_color_bg { background-color: {$main_color}; }";

		$custom_css .= ".main_color_text { color: {$main_color}; }";

		$custom_css .= ".social_icons_list.header_social_icons .social_icon:hover { color: {$main_color}; }";

		$custom_css .= ".header_square_logo a.square_letter_logo { background-color: {$main_color}; }";

		$custom_css .= ".header_nav .text_logo a span.logo_dot { background-color: {$main_color}; }";

		$custom_css .= ".header_nav .main_menu .menu_mark_circle { background-color: {$main_color}; }";

		$custom_css .= ".full_width_list .post_title a:hover:before { background-color: {$main_color}; }";

		if ( is_rtl() ) {

			$custom_css .= ".full_width_list .post_title a:hover:after { background: linear-gradient(to left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	  background: -ms-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,right top,left top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";

			$custom_css .= ".grid_list .post_title a:hover:before { background-color: {$main_color}; }";

			$custom_css .= ".grid_list .post_title a:hover:after { background: linear-gradient(to left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	  background: -ms-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,right top,left top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";

			$custom_css .= ".two_coloumns_list .post_title a:hover:before { background-color: {$main_color}; }";

			$custom_css .= ".two_coloumns_list .post_title a:hover:after { background: linear-gradient(to left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	 background: -ms-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,right top,left top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";
		} else {
			$custom_css .= ".full_width_list .post_title a:hover:after { background: linear-gradient(to right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	  background: -ms-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,left top,right top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";

			$custom_css .= ".grid_list .post_title a:hover:before { background-color: {$main_color}; }";

			$custom_css .= ".grid_list .post_title a:hover:after { background: linear-gradient(to right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	  background: -ms-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,left top,right top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";

			$custom_css .= ".two_coloumns_list .post_title a:hover:before { background-color: {$main_color}; }";

			$custom_css .= ".two_coloumns_list .post_title a:hover:after { background: linear-gradient(to right,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%);
	 background: -ms-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -o-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#FFF 100%); background: -moz-linear-gradient(left,{$main_color} 0,{$main_color} 35%,{$main_color} 65%,#fff 100%); background: -webkit-gradient(linear,left top,right top,color-stop(0%,{$main_color}),color-stop(35%,{$main_color}),color-stop(65%,{$main_color}),color-stop(100%,#FFF));; }";
		}
		$custom_css .= ".post_meta_container a:hover { color: {$main_color}; }";

		$custom_css .= ".post.sticky .blog_meta_item.sticky_post , .full_width_list .show_all_content_blog.post.sticky .post_body.no_post_banner .blog_meta_item.sticky_post{ background-color: {$main_color}; }";

		$custom_css .= ".hover-flip-item span:hover::after { color: {$main_color}; }";

		$custom_css .= ".blog_post_readmore a:hover .continue_reading_dots .continue_reading_squares > span { background-color: {$main_color}; }";

		$custom_css .= ".blog_post_readmore a:hover .continue_reading_dots .readmore_icon { color: {$main_color}; }";

		$custom_css .= ".comment-list .reply a:hover { color: {$main_color}; }";

		$custom_css .= ".comment-list .reply a:hover .comments_reply_icon { color: {$main_color}; }";

		$custom_css .= "form.comment-form .form-submit input:hover { background-color: {$main_color}; }";

		if ( is_rtl() ) {
			$custom_css .= ".comment-list .comment.bypostauthor .comment-content:before { border-top-color: {$main_color}; border-right-color: {$main_color}; }";
		} else {
			$custom_css .= ".comment-list .comment.bypostauthor .comment-content:before { border-top-color: {$main_color}; border-left-color: {$main_color}; }";
		}

		$custom_css .= ".comments-area a:hover { color: {$main_color}; }";

		$custom_css .= ".newsletter_susbcripe_form label .asterisk { color: {$main_color}; }";

		$custom_css .= ".newsletter_susbcripe_form .mce_inline_error { color: {$main_color}!important; }";

		$custom_css .= ".newsletter_susbcripe_form input[type='submit']:hover { background-color: {$main_color}; }";
		$custom_css .= ".widget_content #mc_embed_signup input[type='submit']:hover { background-color: {$main_color}; }";

		$custom_css .= ".social_icons_list .social_icon:hover { color: {$main_color}; }";

		$custom_css .= ".alia_post_list_widget .post_info_wrapper .title a:hover { color: {$main_color}; }";

		$custom_css .= ".tagcloud a:hover { color: {$main_color}; }";

		$custom_css .= ".navigation.pagination .nav-links .page-numbers.current { background-color: {$main_color}; }";

		$custom_css .= ".navigation_links a:hover { background-color: {$main_color}; }";

		$custom_css .= ".page-links > a:hover, .page-links > span { background-color: {$main_color}; }";

		$custom_css .= ".story_circle:hover { border-color: {$main_color}; }";

		$custom_css .= ".see_more_circle:hover { border-color: {$main_color}; }";

		$custom_css .= ".main_content_area.not-found .search-form .search_submit { background-color: {$main_color}; }";

		$custom_css .= ".blog_list_share_container .social_share_item_wrapper a.share_item:hover { color: {$main_color}; }";

		$custom_css .= ".widget_content ul li a:hover { color: {$main_color}; }";

		$custom_css .= ".footer_widgets_container .social_icons_list .social_icon:hover { color: {$main_color}; }";

		$custom_css .= ".footer_widgets_container .widget_content ul li a:hover { color: {$main_color}; }";

		$custom_css .= ".cookies_accept_button { background-color: {$main_color}; }";

		$custom_css .= ".alia_gototop_button > i { background-color: {$main_color}; }";

	}

	wp_add_inline_style( 'ela-customstyle', $custom_css );

}

add_action( 'wp_enqueue_scripts', 'ela_custom_css', 55 );