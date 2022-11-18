<?php
// Max srcset image width
function ela_max_srcset_image_width( $int, $size_array ) {
	$width = $size_array[0];
	if ( $width >= 880 ) {
		return 880;
	} else {
		return $int;
	}
}
add_filter( 'max_srcset_image_width', 'ela_max_srcset_image_width', 10, 2 );

// remove hentry from post class
function ela_remove_hentry( $classes ) {

	// remove hentry from all body classes, this will remove it even if you add it to body_class() function

	// check if hentry_added class exist then don't remove the hentry
	if ( ! in_array( "customhentry", $classes ) ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}

	return $classes;

}

add_filter( 'post_class', 'ela_remove_hentry' );

//fixme: change these comments to simple comments
/* --------
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
------------------------------------------- */
function ela_excerpt_more( $link ) {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'ela_excerpt_more' );

/* --------
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
------------------------------------------- */
function ela_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action( 'wp_head', 'ela_javascript_detection', 0 );

/* --------
 * Add a pingback url auto-discovery header for singularly identifiable articles.
------------------------------------------- */
function ela_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}

add_action( 'wp_head', 'ela_pingback_header' );

/* --------
 * Add Facebook SDK
------------------------------------------- */
function ela_fbsdk_head() {
	$opt          = get_option( 'ela_option_data' );
	$facebook_sdk = isset( $opt['facebook_sdk'] ) ?? true;
	if ( $facebook_sdk ) {
		?>
        <!-- Load facebook SDK -->
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.11";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- End Load facebook SDK -->
		<?php
	}
}

add_action( 'wp_head', 'ela_fbsdk_head' );

/* --------
 * Customize OEmbed output.
------------------------------------------- */
function ela_custom_embed_oembed_html( $html, $url, $attr, $post_id ) {

	$opt          = get_option( 'ela_option_data' );
	$image_banner = isset( $opt['lazyload_iframe_banner'] ) ?? false;

	$host = wp_parse_url( $url, PHP_URL_HOST );

	$html = '<!--ELA start embed content-->' . $html . '<!--ELA end embed content-->';

	if ( strpos( $host, 'twitter.com' ) !== false ) {
		$html = '<div class="twitter_widget_wrapper alia_embed_wrapper"><div class="twitter_widget_border">' . $html . '</div></div>';
	}

	if ( strpos( $host, 'youtu.be' ) !== false || strpos( $host, 'youtube.com' ) !== false ) {
		$html = '<div class="youtube_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'fb.com' ) !== false || strpos( $host, 'facebook.com' ) !== false ) {
		$html = '<div class="facebook_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'instagram.com' ) !== false ) {
		$html = '<div class="instagram_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'vimeo.com' ) !== false ) {
		$html = '<div class="vimeo_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'soundcloud.com' ) !== false ) {
		$html = '<div class="soundcloud_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'flickr.com' ) !== false ) {
		$html = '<div class="flickr_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( strpos( $host, 'gettyimages.com' ) !== false ) {
		$html = '<div class="gettyimages_embed_wrapper alia_embed_wrapper">' . $html . '</div>';
	}

	if ( $image_banner == 1 ) {

		$matches           = array();
		$skip_images_regex = '/class=".*lazyload.*"/';
		$placeholder_image = apply_filters( 'lazysizes_placeholder_image',
			'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );
		preg_match_all( '/<iframe\s+.*?>/', $html, $matches );

		$search  = array();
		$replace = array();

		foreach ( $matches[0] as $imgHTML ) {

			// Don't to the replacement if a skip class is provided and the image has the class.
			if ( ! ( preg_match( $skip_images_regex, $imgHTML ) ) ) {

				$replaceHTML = preg_replace( '/<iframe(.*?)src=/i',
					'<iframe$1src="' . $placeholder_image . '" data-src=', $imgHTML );

				$newClass = ' lazyload ';

				$pattern1 = '/class="([^"]*)"/';
				$pattern2 = "/class='([^']*)'/";
				// Class attribute set.
				if ( preg_match( $pattern1, $replaceHTML, $matches ) ) {
					$definedClasses = explode( ' ', $matches[1] );
					if ( ! in_array( $newClass, $definedClasses ) ) {
						$definedClasses[] = $newClass;
						$replaceHTML      = str_replace(
							$matches[0],
							sprintf( 'class="%s"', implode( ' ', $definedClasses ) ),
							$replaceHTML
						);
					}
					// Class attribute not set.
				} else if ( preg_match( $pattern2, $replaceHTML, $matches ) ) {
					$definedClasses = explode( ' ', $matches[1] );
					if ( ! in_array( $newClass, $definedClasses ) ) {
						$definedClasses[] = $newClass;
						$replaceHTML      = str_replace(
							$matches[0],
							sprintf( 'class="%s"', implode( ' ', $definedClasses ) ),
							$replaceHTML
						);
					}
					// Class attribute not set.
				} else {
					$replaceHTML = preg_replace( '/(\<.+\s)/', sprintf( '$1class="%s" ', $newClass ), $replaceHTML );
				}

				$replaceHTML .= '<noscript>' . $imgHTML . '</noscript>';

				array_push( $search, $imgHTML );
				array_push( $replace, $replaceHTML );
			}
		}

		$html = str_replace( $search, $replace, $html );
	}

	return $html;
}

add_filter( 'embed_oembed_html', 'ela_custom_embed_oembed_html', 99, 4 );


/* --------
*  set body classes
------------------------------------------- */
function ela_body_class( $classes ) {
	$enable_sticky_header       = false;
	$sticky_footer_content      = false;
	$disable_img_corner_rounded = false;
	$round_logo                 = false;
	$border_text_posts          = false;
	$show_header_site_title     = true;
	$show_page_fullwidth_text   = false;
	$enable_masonry             = true;
	$menu_circle_indicator      = true;
	if ( class_exists( 'CSF' ) ) {
		$opt                        = get_option( 'ela_option_data' );
		$enable_sticky_header       = $opt['enable_sticky_header'];
		$sticky_footer_content      = $opt['sticky_footer_content'];
		$disable_img_corner_rounded = $opt['disable_img_corner_rounded'];
		$round_logo                 = $opt['round_logo'];
		$border_text_posts          = $opt['border_text_posts'];
		$show_header_site_title     = $opt['show_header_site_title'];
		$show_page_fullwidth_text   = $opt['show_page_fullwidth_text'];
		$enable_masonry             = $opt['enable_masonry'];
		$menu_circle_indicator      = $opt['menu_circle_indicator'];
	}

	if ( $enable_sticky_header ) {
		$classes[] = 'sticky_header';
	}

	if ( $sticky_footer_content ) {
		$classes[] = 'has_static_footer';
	}

	if ( $disable_img_corner_rounded ) {
		$classes[] = 'image_no_rounded_corners';
	}

	if ( $round_logo ) {
		$classes[] = 'header_logo_rounded';
	}

	if ( ! $border_text_posts ) {
		$classes[] = 'text_posts_unbordered';
	} else {
		$classes[] = 'text_posts_bordered';
	}

	if ( ! $show_header_site_title ) {
		$classes[] = 'no_sitetitle_in_menu';
	}

	if ( $show_page_fullwidth_text ) {
		$classes[] = 'pages_wide_text_content';
	}

	if ( $enable_masonry ) {
		$classes[] = 'masonry_effect_enabled';
	}

	if ( $menu_circle_indicator ) {
		$classes[] = 'show_menu_circle_idicator';
	} else {
		$classes[] = 'hide_menu_circle_idicator';
	}

	if ( get_custom_header() && get_header_image() ) {
		$classes[] = 'has_header_image';
		// $classes[] = 'has_site_width_max';
	}

	if ( ! is_active_sidebar( 'sidebar-sliding' ) ) {
		$classes[] = 'sliding_sidebar_inactive';
	}

	return $classes;
}


add_filter( 'body_class', 'ela_body_class' );


function ela_update_cookies_meta( $login ) {

	$user    = get_user_by( 'login', $login );
	$user_ID = $user->ID;

	if ( isset( $_COOKIE['ela_cookies_accepted'] ) && $_COOKIE['ela_cookies_accepted'] == 1 && get_user_meta( $user_ID, 'ela_cookies_accepted', true ) != 1 ) {

		update_user_meta( $user_ID, 'ela_cookies_accepted', 1 );
	}
}

add_action( 'wp_login', 'ela_update_cookies_meta' );

/* --------
*  Add custom style to admin panel
------------------------------------------- */
function ela_admin_fonts() {
	$opt         = get_option( 'ela_option_data' );
	$admin_style = isset( $opt['disable_admin_style'] ) ?? false;
	if ( ! $admin_style ) {
		wp_enqueue_style( 'ela_admin_style', get_template_directory_uri() . '/assets/css/admin.css' );
	}
}

add_action( 'admin_head', 'ela_admin_fonts' );

/* --------
*  Gallery Post filter
------------------------------------------- */
function ela_get_post_gallery( $gallery, $post ) {
	// Already found a gallery so lets quit.
	if ( $gallery ) {
		return ela_filter_lazyload_images( $gallery );
	}
	// Check the post exists.
	$post = get_post( $post );
	if ( ! $post ) {
		return ela_filter_lazyload_images( $gallery );
	}
	// Not using Gutenberg so let's quit.
	if ( ! function_exists( 'has_blocks' ) ) {
		return ela_filter_lazyload_images( $gallery );
	}
	// Not using blocks so let's quit.
	if ( ! has_blocks( $post->post_content ) ) {
		return ela_filter_lazyload_images( $gallery );
	}
	/**
	 * Search for gallery blocks and then, if found, return the html from the
	 * first gallery block.
	 *
	 * Thanks to Gabor for help with the regex:
	 * https://twitter.com/javorszky/status/1043785500564381696.
	 */
	$pattern = "/<!--\ wp:gallery.*-->([\s\S]*?)<!--\ \/wp:gallery -->/i";
	preg_match_all( $pattern, $post->post_content, $the_galleries );
	// Check a gallery was found and if so change the gallery html.
	if ( ! empty( $the_galleries[1] ) ) {
		$gallery = reset( $the_galleries[1] );
	}

	return ela_filter_lazyload_images( $gallery );
}

add_filter( 'get_post_gallery', 'ela_get_post_gallery', 10, 2 );