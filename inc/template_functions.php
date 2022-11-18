<?php
$social_networks = array(
	"facebook-square" => "Facebook",
	"twitter"         => "Twitter",
	"google-plus"     => "Google Plus",
	"behance"         => "Behance",
	"dribbble"        => "Dribbble",
	"linkedin"        => "Linked In",
	"youtube"         => "Youtube",
	'vimeo-square'    => 'Vimeo',
	"vk"              => "VK",
	"vine"            => "Vine",
	"digg"            => "Digg",
	"skype"           => "Skype",
	"instagram"       => "Instagram",
	"pinterest"       => "Pinterest",
	"github"          => "Github",
	"bitbucket"       => "Bitbucket",
	"stack-overflow"  => "Stack Overflow",
	"renren"          => "Ren Ren",
	"flickr"          => "Flickr",
	"soundcloud"      => "Soundcloud",
	"steam"           => "Steam",
	"qq"              => "QQ",
	"slideshare"      => "Slideshare",
	'discord'         => 'Discord',
	'telegram'        => 'Telegram',
	'twitch'          => 'Twitch',
	'reddit'          => 'Reddit',
	'medium-m'        => 'Medium',
	'tiktok'          => 'TikTok',
	'rss'             => 'RSS',
	'mailchimp'       => 'Mailchimp',
);

/* --------
 * Add custom header css.
------------------------------------------- */
function ela_custom_header_callback() {
	$header_text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}
	?>
    <style id="alia-custom-header-styles">
        <?php if ( 'blank' != $header_text_color ) : ?>
        .header_tagline {
            color: #<?php echo esc_attr( $header_text_color ); ?>;
        }

        .social_icons_list.header_social_icons .social_icon {
            color: #<?php echo esc_attr( $header_text_color ); ?>;
        }

        <?php endif; ?>
    </style>
	<?php
}


/* --------
 * ela excerpt generator .
------------------------------------------- */
function ela_excerpt( $limit = 80 ) {

	$excerpt_text = ' &hellip; ';

	$content = get_the_excerpt();
	//check if its chinese character input
	$chinese_output = preg_match_all( "/\p{Han}+/u", $content, $matches );
	if ( $chinese_output ) {
		$content = mb_substr( $content, 0, ( $limit * 4 ) ) . '&hellip;';
	}

	return wp_trim_words( $content, $limit, $excerpt_text );
}


/* --------
 * Custom fonts collection.
------------------------------------------- */
if ( ! function_exists( 'ela_custom_fonts_collection' ) ) {
	function ela_custom_fonts_collection() {
		$ela_custom_fonts_array = array(
			'roboto'         => array(
				'name'   => "Roboto",
				'family' => "400,400i,700,700i",
				'css'    => "'Roboto', sans-serif",
			),
			'lato'           => array(
				'name'   => "Lato",
				'family' => "400,400i,700,700i",
				'css'    => "'Lato', sans-serif",
			),
			'manrope'        => array(
				'name'   => "Manrope",
				'family' => "300;400;500;600;700;800",
				'css'    => "'Manrope', sans-serif",
			),
			'ptsans'         => array(
				'name'   => "PT Sans",
				'family' => "400,400i,700,700i",
				'css'    => "'PT Sans', sans-serif",
			),
			'worksans'       => array(
				'name'   => "Work Sans",
				'family' => "400,700",
				'css'    => "'Work Sans', sans-serif",
			),
			'opensans'       => array(
				'name'   => "Open Sans",
				'family' => "400,400i,700,700i",
				'css'    => "'Open Sans', sans-serif",
			),
			'sourcesanspro'  => array(
				'name'   => "Source Sans Pro",
				'family' => "400,400i,700,700i",
				'css'    => "'Source Sans Pro', sans-serif",
			),
			'poppins'        => array(
				'name'   => "Poppins",
				'family' => "400,400i,700,700i",
				'css'    => "'Poppins', sans-serif",
			),
			'robotoslab'     => array(
				'name'   => "Roboto Slab",
				'family' => "100,300,400,700",
				'css'    => "'Roboto Slab', serif",
			),
			'notosans'       => array(
				'name'   => "Noto Sans",
				'family' => "400,400i,700,700i",
				'css'    => "'Noto Sans', sans-serif",
			),
			'ubuntu'         => array(
				'name'   => "Ubuntu",
				'family' => "400,400i,700,700i",
				'css'    => "'Ubuntu', sans-serif",
			),
			'ibmplexsans'    => array(
				'name'   => "IBM Plex Sans",
				'family' => "400,400i,700,700i",
				'css'    => "'IBM Plex Sans', sans-serif",
			),
			'lora'           => array(
				'name'   => "Lora",
				'family' => "400,400i,700,700i",
				'css'    => "'Lora', serif",
			),
			'ptserif'        => array(
				'name'   => "PT Serif",
				'family' => "400,400i,700,700i",
				'css'    => "'PT Serif', serif",
			),
			'arvo'           => array(
				'name'   => "Arvo",
				'family' => "400,400i,700,700i",
				'css'    => "'Arvo', serif",
			),
			'sourceserifpro' => array(
				'name'   => "Source Serif Pro",
				'family' => "400,700",
				'css'    => "'Source Serif Pro', serif",
			),
			'kameron'        => array(
				'name'   => "Kameron",
				'family' => "400,700",
				'css'    => "'Kameron', serif",
			),
			'merriweather'   => array(
				'name'   => "Merriweather",
				'family' => "400,700",
				'css'    => "'Merriweather', serif",
			),
			'notoserif'      => array(
				'name'   => "Noto Serif",
				'family' => "400,400i,700,700i",
				'css'    => "'Noto Serif', serif",
			),
		);

		return $ela_custom_fonts_array;
	}

}
/* --------
 * Register custom fonts.
------------------------------------------- */

function ela_custom_fonts_url() {
	$main_font  = 'manrope';
	$title_font = 'manrope';
	$subsets    = 'swap';
	if ( class_exists( 'CSF' ) ) {
		$opt        = get_option( 'ela_option_data' );
		$main_font  = $opt['main_font'];
		$title_font = $opt['title_font'];
	}

	$fonts_url = '';

	$ela_custom_fonts_array = ela_custom_fonts_collection();

	$font_families = array();

	if ( $main_font && $main_font != 'default' && $main_font != 'system' ) {
		$main_font_id     = $main_font;
		$main_custom_font = $ela_custom_fonts_array[ $main_font_id ];
		$main_custom_font = str_replace(',',';',$main_custom_font);
		$font_families[]  = $main_custom_font['name'] . ':wght@' . $main_custom_font['family'];
	}

	if ( $title_font && $title_font != 'default' && $title_font != 'system' ) {
		$title_font_id     = $title_font;
		$title_custom_font = $ela_custom_fonts_array[ $title_font_id ];
        $title_custom_font = str_replace(',',';',$title_custom_font);
		$font_families[]   = $title_custom_font['name'] . ':wght@' . $title_custom_font['family'];
	}

	$is_ssl = is_ssl() ? 'https' : 'http';

	if ( $font_families ) {
		$fonts_url = add_query_arg( array(
			'family'  => implode( '&family=', $font_families ),
			'display' => urlencode( $subsets ),
		), "$is_ssl://fonts.googleapis.com/css2" );
	}
	return esc_url_raw( $fonts_url );
}

/* --------
 * Custom fonts loader
------------------------------------------- */
function ela_editor_custom_font_loader() {
	$main_font_css          = '';
	$title_font_css         = '';
	$ela_custom_fonts_array = ela_custom_fonts_collection();

	$main_font  = 'manrope';
	$title_font = 'manrope';
	if ( class_exists( 'CSF' ) ) {
		$opt        = get_option( 'ela_option_data' );
		$main_font  = $opt['main_font'];
		$title_font = $opt['title_font'];
	}

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

	wp_enqueue_style( 'ela_fonts', ela_custom_fonts_url(), array(), null );

}

add_action( 'enqueue_block_editor_assets', 'ela_editor_custom_font_loader', 55 );

/* --------
 * apply lazy load to images & iframes
------------------------------------------- */
function ela_filter_lazyload_images( $content, $type = 'ratio' ) {
	$lazyload_image_banner = false;
	if ( class_exists( 'CSF' ) ) {
		$opt                   = get_option( 'ela_option_data' );
		$lazyload_image_banner = $opt['lazyload_image_banner'];
	}
	if ( is_feed()
	     || intval( get_query_var( 'print' ) ) == 1
	     || intval( get_query_var( 'printpage' ) ) == 1
	     || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
	     || ! $lazyload_image_banner
	) {
		return $content;
	}

	$respReplace = 'data-sizes="auto" data-srcset=';
	if ( is_array( $content ) ) {
		return $content;
	}
	$matches           = array();
	$skip_images_regex = '/class=".*lazyload.*"/';
	$placeholder_image = apply_filters( 'lazysizes_placeholder_image',
		'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );
	preg_match_all( '/<img\s+.*?>/', $content, $matches );

	$search  = array();
	$replace = array();

	foreach ( $matches[0] as $imgHTML ) {

		// Don't to the replacement if a skip class is provided and the image has the class.
		if ( ! ( preg_match( $skip_images_regex, $imgHTML ) ) ) {

			$replaceHTML = preg_replace( '/<img(.*?)src=/i',
				'<img$1src="' . $placeholder_image . '" data-src=', $imgHTML );

			$replaceHTML = preg_replace( '/srcset=/i', $respReplace, $replaceHTML );
			$newClass    = ' lazyload';

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

	$content = str_replace( $search, $replace, $content );

	return $content;
}

$lazyload_image_banner = false;
$show_hits_counter     = false;
$show_views            = false;
if ( class_exists( 'CSF' ) ) {
	$opt = get_option( 'ela_option_data' );

	$lazyload_image_banner = isset( $opt['lazyload_image_banner'] ) ?? false;
	$show_hits_counter     = isset( $opt['show_hits_counter'] ) ?? false;
	$show_views            = isset( $opt['show_views'] ) ?? false;
}
if ( $lazyload_image_banner ) {
	add_filter( 'the_content', 'ela_filter_lazyload_images' );
	apply_filters( 'widget_custom_html_content', 'ela_filter_lazyload_images' );
}

/* --------
 * Ela pagination
------------------------------------------- */
function ela_pagination( $id = '' ) {
	global $post;
	global $paged;
	if ( $post && $id == '' ) {
		$id = $post->ID;
	}

	$pagination_type = 'num';
	if ( class_exists( 'CSF' ) ) {
		$opt             = get_option( 'ela_option_data' );
		$pagination_type = $opt['pagination_type'];
	}

	$next_arrow = '<i class="fa fa-angle-right"></i>';
	$prev_arrow = '<i class="fa fa-angle-left"></i>';

	if ( is_rtl() ) {
		$next_arrow = '<i class="fa fa-angle-left"></i>';
		$prev_arrow = '<i class="fa fa-angle-right"></i>';
	}
	if ( $pagination_type == 'num' ) {
		the_posts_pagination( array(
			'mid_size'           => 2,
			'prev_text'          => $prev_arrow,
			'next_text'          => $next_arrow,
			'before_page_number' => '',
		) );
	}
	if ( $pagination_type == 'nav' ) {
		if ( get_next_posts_link() ) {
			echo '<div class="next_prev_nav pagination">';
			if ( get_next_posts_link() ):
				echo '<div class="navigation_links navigation_next">';
				next_posts_link( __( 'Older Posts', 'ela' ) );
				echo '</div>';
			endif;

			if ( get_previous_posts_link() ):
				echo '<div class="navigation_links navigation_prev">';
				previous_posts_link( __( 'Newer Posts', 'ela' ) );
				echo '</div>';
			endif;
			echo '</div>';
		}
	}
}

/* --------
*  post meta tags
------------------------------------------- */
function ela_post_meta( $post_position = '' ) {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="blog_meta_item sticky_post">%s</span>', 'Featured' );
	}

	$show_author_avatar = true;
	$show_author_name   = true;
	$show_categories    = true;
	$show_date          = true;
	$show_update_date   = false;
	$show_views         = false;
	if ( class_exists( 'CSF' ) ) {
		$opt                = get_option( 'ela_option_data' );
		$show_author_avatar = $opt['show_author_avatar'];
		$show_author_name   = $opt['show_author_name'];
		$show_categories    = $opt['show_categories'];
		$show_date          = $opt['show_date'];
		$show_update_date   = $opt['show_update_date'];
		$show_views         = $opt['show_views'];
	}

	if ( $show_author_avatar && get_avatar( get_the_author_meta( 'ID' ) ) ) {
		if ( in_array( get_post_type(), array( 'page', 'post' ) ) ) {
			//if ( is_multi_author() ) {
			printf( '<span class="post_meta_item meta_item_author_avatar"><a class="meta_author_avatar_url" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				ela_filter_lazyload_images( get_avatar( get_the_author_meta( 'ID' ), 40 ) )
			);
			//}
		}
	}
	#}

	echo '<div class="post_meta_info post_meta_row clearfix">';

	if ( $show_author_name ) {
		if ( in_array( get_post_type(), array( 'page', 'post' ) ) ) {
			//if ( is_multi_author() ) {
			if ( $post_position == 'normalhentry' ) {
				printf( '<span class="post_meta_item meta_item_author"><span class="author vcard author_name"><span class="fn"><a class="meta_author_name url" href="%1$s">%2$s</a></span></span></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			} else {
				printf( '<span class="post_meta_item meta_item_author"><span class="author author_name"><span><a class="meta_author_name" href="%1$s">%2$s</a></span></span></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}

			//}
		}
	}

	if ( $show_categories ) {

		$cats = get_the_category( get_the_ID());
        printf( '<span class="post_meta_item meta_item_category"><svg id="Icon" enable-background="new 0 0 64 64" height="12" viewBox="0 0 64 64" width="12" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m55.3 62h-13.6c-3.7 0-6.7-3-6.7-6.7v-18.3c0-1.1.9-2 2-2h18.3c3.7 0 6.7 3 6.7 6.7v13.6c0 3.7-3 6.7-6.7 6.7zm-16.3-23v16.3c0 1.5 1.2 2.7 2.7 2.7h13.6c1.5 0 2.7-1.2 2.7-2.7v-13.6c0-1.5-1.2-2.7-2.7-2.7z"/></g><g><path d="m22.3 62h-13.6c-3.7 0-6.7-3-6.7-6.7v-13.6c0-3.7 3-6.7 6.7-6.7h18.3c1.1 0 2 .9 2 2v18.3c0 3.7-3 6.7-6.7 6.7zm-13.6-23c-1.5 0-2.7 1.2-2.7 2.7v13.6c0 1.5 1.2 2.7 2.7 2.7h13.6c1.5 0 2.7-1.2 2.7-2.7v-16.3z"/></g><g><path d="m55.3 29h-18.3c-1.1 0-2-.9-2-2v-18.3c0-3.7 3-6.7 6.7-6.7h13.6c3.7 0 6.7 3 6.7 6.7v13.6c0 3.7-3 6.7-6.7 6.7zm-16.3-4h16.3c1.5 0 2.7-1.2 2.7-2.7v-13.6c0-1.5-1.2-2.7-2.7-2.7h-13.6c-1.5 0-2.7 1.2-2.7 2.7z"/></g><g><path d="m27 29h-18.3c-3.7 0-6.7-3-6.7-6.7v-13.6c0-3.7 3-6.7 6.7-6.7h13.6c3.7 0 6.7 3 6.7 6.7v18.3c0 1.1-.9 2-2 2zm-18.3-23c-1.5 0-2.7 1.2-2.7 2.7v13.6c0 1.5 1.2 2.7 2.7 2.7h16.3v-16.3c0-1.5-1.2-2.7-2.7-2.7z"/></g></g></svg>');
		foreach ( $cats as $cat ) {
			$link = get_category_link( $cat->term_id );
			?>
            <a class="hover-flip-item-wrapper" href="<?php echo esc_url( $link ) ?>">
                <span class="hover-flip-item"><span data-text="<?php echo esc_html( $cat->name ); ?>"><?php echo esc_html( $cat->name ); ?></span></span>
            </a>
			<?php
		}
        echo "</span>";

	}

	if ( $show_date ) {
		if ( in_array( get_post_type(), array( 'page', 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$u_time          = get_the_time( 'U' );
			$u_modified_time = get_the_modified_time( 'U' );
			if ( $u_modified_time >= $u_time + 86400 && ( $show_update_date === 0 ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date()
			);

			echo '<a class="post_date_link" href="' . get_permalink() . '">';
			printf( '<span class="post_meta_item meta_item_date"><i class="fas fa-calendar-alt"></i><span class="screen-reader-text"></span>%1$s</span>', $time_string );
			echo '</a>';
		}
	}

	if ( $show_update_date === 1 ) {
		if ( in_array( get_post_type(), array( 'page', 'post', 'attachment' ) ) ) {
			$u_time          = get_the_time( 'U' );
			$u_modified_time = get_the_modified_time( 'U' );
			if ( $u_modified_time >= $u_time + 86400 ) {
				$time_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';
				$time_string = sprintf( $time_string,
					esc_attr( get_the_modified_date( 'c' ) ),
					get_the_modified_date()
				);
			} else if ( $show_date !== 1 ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
			}

			if ( isset( $time_string ) ) {
				echo '<a class="post_date_link" href="' . get_permalink() . '">';
				printf( '<span class="post_meta_item meta_item_date"><span class="screen-reader-text"></span>%1$s</span>', $time_string );
				echo '</a>';
			}
		}
	}

	if ( $show_views == 1 ) {
		if ( in_array( get_post_type(), array( 'page', 'post', 'attachment' ) ) ) {
			$views = ( get_post_meta( get_the_ID(), 'hits' ) ) ? get_post_meta( get_the_ID(), 'hits' )[0] : 0;
			echo '<a class="post_view_link" href="' . get_permalink() . '">';
			printf( '<span class="post_meta_item meta_item_view"><i class="post_meta_icon far fa-eye"></i>%1$s</span>',
				$views
			);
			echo '</a>';
		}
	}

	echo '</div>';

}


/* --------
story content overlay
------------------------------------------- */

function ela_story_content_overlay( $story_post = '' ) {
	$author_id = $story_post->post_author;
	$output    = '';

	if ( $story_post ) {
		$output .= '<div class="story_black_overlay"></div>';

		$output .= '<div class="story_content">';

		$output .= '<span class="story_item_author_avatar"><a class="meta_author_avatar_url" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . ela_filter_lazyload_images( get_avatar( $author_id, 36 ) ) . '</a></span>';

		$output .= '<div class="story_meta">';
		$output .= '<span class="story_item_author"><a class="meta_author_name url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . get_the_author_meta( 'display_name', $author_id ) . '</a></span>';
		$output .= '<a href="' . get_permalink( $story_post ) . '" class="story_date">' . get_the_date( '', $story_post ) . '</a>';
		$output .= '</div>'; // close story_meta

		$output .= '</div>'; //story_content

	}

	return $output;
}

/* --------
stories circles
------------------------------------------- */
function ela_stories_circles( $num = 4, $page_url = '', $author_id = 0, $post_type = 'story' ) {

	global $post;

	$footer_posts_circle_cat = [];
	$stories_page_url        = '';
	if ( class_exists( 'CSF' ) ) {
		$opt                     = get_option( 'ela_option_data' );
		$stories_page_url        = $opt['stories_page_url'];
		$footer_posts_circle_cat = $opt['footer_posts_circle_cat'];
	}

	if ( $page_url != '' ) {
		$stories_page = $page_url;
	} else {
		$stories_page = $stories_page_url;
	}
	if ( $post_type === 'post' ) {
		$args = array(
			'post_type'      => 'post',
			'orderby'        => 'date',
			'posts_per_page' => $num,
			'meta_query'     => array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS',
				),
			),
		);

		$args['cat'] = isset( $footer_posts_circle_cat ) ?? array();

	} else {
		$args = array( 'post_type' => 'story', 'orderby' => 'date', 'posts_per_page' => $num );
	}
	if ( $author_id != 0 ) {
		$args['author'] = $author_id;
	}

	$wp_query = new WP_Query( $args );

	$output = '';
	if ( $wp_query ) :

		$output .= '<div class="stories_circles_wrapper">';
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$output .= '<span data-postid="' . get_the_ID() . '" data-author="' . $author_id . '" data-post_type="' . $post_type . '" class="story_circle story_hotlink">';
			$output .= get_the_post_thumbnail( $post->ID, 'ela_thumbnail_avatar', array( 'class' => 'img-responsive' ) );
			$output .= '</span>';
		endwhile;

		if ( $wp_query->max_num_pages > 1 && $stories_page != '' && $author_id == 0 ) {
			$output .= '<span class="see_more_circle">';
			$output .= '<a href="' . $stories_page . '"><i class="fas fa-plus"></i></a>';
			$output .= '</span>';
		}

		$output .= '</div>';

	endif;

	wp_reset_query();

	return $output;
}


/* --------
*   author social profiles
------------------------------------------- */
function ela_author_social_profiles( $contactmethods ) {
	global $social_networks;

	foreach ( $social_networks as $network => $social ) {
		$contactmethods[ $network ] = sprintf( esc_attr__( '%s URL', 'ela' ), $social );
	}

	return $contactmethods;
}


/* --------
*  social networks list
------------------------------------------- */
function ela_social_icons_list( $class = '' ) {

	$wrapper_class = '';
	if ( $class ) {
		$wrapper_class = $class;
	}
	$urls = '';
	if ( class_exists( 'CSF' ) ) {
		$opt  = get_option( 'ela_option_data' );
		$urls = $opt['social_link_repeater'];
	}

	$output = "";

	if ( ! empty( $urls ) ) {
		$output .= '<div class="social_icons_list ' . $wrapper_class . '">';
	}
	if ( is_array( $urls ) ) {
		foreach ( $urls as $url ) {
			$social_url      = $url['social_links'];
			$social_url_icon = $url['social_links_icon'];
			$output          .= '<a rel="nofollow noreferrer" target="_blank" href="' . esc_url( $social_url ) . '" class="social_icon widget_social_icon"><i class=" ' . ( $social_url_icon ) . '"></i></a>';

		}
	}
	if ( ! empty( $urls ) ) {
		$output .= '</div>'; // end social_icons_list in case it's already opened
	}
	if ( $output != '' ) {
		return $output;
	}
}

/* --------
*  AJAX hits counter
------------------------------------------- */
if ( $show_hits_counter || $show_views == 1 ) {
	// Run this code on 'after_theme_setup', when plugins have already been loaded.
	add_action( 'after_setup_theme', 'ela_hits_counter' );
	// This function loads the plugin.
	function ela_hits_counter() {

		if ( ! class_exists( 'AJAX_Hits_Counter' ) ) {
			// load Social if not already loaded
			get_template_part( 'inc/ajax-hits-counter/ajax-hits-counter' );
		}
	}
}

/* --------
*  get blog posts list
------------------------------------------- */
function ela_return_blogposts_list( $num = "3", $thumb = 'thumbnail', $orderby = 'date', $cat = '', $tag_ids = '', $ignore_sticky = false ) {
	global $post;

	$args = array( 'posts_per_page' => $num );
	if ( $orderby == 'most_views' ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'hits';
	} else {
		$args['orderby'] = $orderby;
	}

	if ( $tag_ids != '' ) {
		$tags       = explode( ',', $tag_ids );
		$tags_array = array();
		if ( count( $tags ) > 0 ) {
			foreach ( $tags as $tag ) {
				if ( ! empty( $tag ) ) {
					$tags_array[] = $tag;
				}
			}
		}
		$args['tag_slug__in'] = $tags_array;
	}
	if ( $cat != '' ) {
		$box_cat = get_category_by_slug( $cat );
		if ( $box_cat ) {
			$cat         = $box_cat->term_id;
			$args['cat'] = $cat;
		}
	}
	if ( $ignore_sticky ) {
		$args['ignore_sticky_posts'] = 1;
	}
	$wp_query = new WP_Query( $args );

	$output = '';
	if ( $wp_query->have_posts() ) :
		$output .= '<ul class="post_list">';
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$output .= '<li class="post_item clearfix">';

			$output .= '<div class="post_thumbnail_wrapper">';
			$output .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
			if ( ! has_post_thumbnail() ) {
				$post_title = get_the_title();
				$output     .= '<span class="post_text_thumbnail title">' . mb_substr( $post_title, 0, 1, "utf-8" ) . '</span>';
			} else {
				$output .= get_the_post_thumbnail( $post->ID, $thumb, array( 'class' => 'img-responsive', 'sizes' => '60px' ) );
			}
			$output .= '</a>';
			$output .= '</div>'; // end post_thumnail and a

			$output .= '<div class="post_info_wrapper">';
			$output .= '<h5 class="title post_title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h5>';

			$output .= '<span class="post_meta_item post_meta_time post_time">' . get_the_time( get_option( 'date_format' ) ) . '</span>';
			$output .= '</div>'; // end post_info
			$output .= '</li>'; // end post_item
		endwhile;
		$output .= '</ul>';
	endif;

	return $output;
}

/* --------
*  Find image id
------------------------------------------- */
function ela_find_image_id( $post_id ) {
	if ( ! $img_id = get_post_thumbnail_id( $post_id ) ) {
		$attachments = get_children( array(
			'post_parent'    => $post_id,
			'post_type'      => 'attachment',
			'numberposts'    => 1,
			'post_mime_type' => 'image',
		) );
		if ( is_array( $attachments ) ) {
			foreach ( $attachments as $a ) {
				$img_id = $a->ID;
			}
		}
	}
	if ( $img_id ) {
		return $img_id;
	}

	return false;
}

function ela_get_first_image( $postid = '', $size = 'thumbnail' ) {
	global $post;

	if ( $post && $postid == '' ) {
		$post_id = $post->ID;
	} else {
		$post_id = $postid;
	}

	if ( ! $img = ela_find_image_id( $post->ID ) ) {
		if ( $img = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ) {
			$img = $matches[1][0];
		}
	}

	if ( is_int( $img ) ) {
		$img = wp_get_attachment_image_src( $img, $size );
		$img = $img[0];
	}

	return $img;
}

function ela_cookies_accepted() {
	if ( is_user_logged_in() ) {
		if ( get_user_meta( get_current_user_id(), 'ela_cookies_accepted', true ) == 1 ) {
			return true;
		}
	} elseif ( isset( $_COOKIE['ela_cookies_accepted'] ) && $_COOKIE['ela_cookies_accepted'] == 1 ) {
		return true;
	} else {
		return;
	}
}
