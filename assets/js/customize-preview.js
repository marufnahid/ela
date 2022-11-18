(function ($) {
	'use strict';
	jQuery(window).on('ready resize', function () {
		var custom_css = true;
		if (custom_css) {
			var content = $('#asalah_custom_style_code').text();
			jQuery('#asalah_custom_style_code').text(content + ' ');
			custom_css = false;
		}
	});

	wp.customize('asalah_boxed_header', function (value) {
		value.bind(function (to) {
			if (to === true) {
				$('.header_logo_wrapper').addClass('container');
			} else {
				$('.header_logo_wrapper').removeClass('container');
			}
		});
	});

	wp.customize('asalah_content_width_layout', function (value) {
		value.bind(function (to) {
			if (to === 'narrow') {
				$('.blog_posts_wrapper').addClass('narrow_content_width');
			} else {
				$('.blog_posts_wrapper').removeClass('narrow_content_width');
			}
		});
	});

	wp.customize('asalah_show_share_effect', function (value) {
		value.bind(function (to) {
			if (to === 'always') {
				$('.blog_post_share').addClass('always_show');
			} else {
				$('.blog_post_share').removeClass('always_show');
			}
		});
	});

	wp.customize('asalah_site_width', function (value) {
		value.bind(function (to) {
			$('.container').css('width', to);
			$('.main_content.col-md-9').css({'width': '75%', 'padding-right': '15px'});
			$('.side_content.col-md-3').css({'width': '25%', 'padding-left': '15px'});
			if (to < 701) {
				$('.side_content').hide();
				$('.main_content').removeClass('col-md-9');
				$('.main_content').addClass('col-md-12');
				$('.main_content').css('width', '100%');
			} else {
				if ($('.side_content').length) {
					$('.side_content').show();
					$('.main_content').addClass('col-md-9');
					$('.main_content').removeClass('col-md-12');
				}
			}
		});
	});

	wp.customize('asalah_enable_body_background_color', function (value) {
		value.bind(function (to) {
			$('body').addClass('custom_bg_color');
		});
	});

	wp.customize('asalah_custom_header_code', function (value) {
		value.bind(function (to) {

		});
	});

	wp.customize('asalah_custom_footer_code', function (value) {
		value.bind(function (to) {

		});
	});

	function add_asalah_custom_partials () {
		// list edit buttons locations [selector, setting, location, type]
		var controls = [
		['.blog .blog_post_meta, .page-template-blog .blog_post_meta', 'asalah_layout_meta_tags', 'inside', 'section'],
		['.blog .blog_post_readmore, .page-template-blog .blog_post_readmore', 'asalah_layout_control_post', 'outside', 'section'],
		['.blog .blog_post_description, .page-template-blog .blog_post_description', 'asalah_layout_post_content', 'inside', 'section'],
		['.blog .blog_post_banner, .page-template-blog .blog_post_banner', 'asalah_layout_banner', 'inside', 'section'],
		['.blog_post_share', 'asalah_social_share_list', 'outside', 'section'],
		['.logo_wrapper', 'asalah_logo_panel', 'inside', 'panel'],
		['.single .author_box', 'show_author_box', 'outside', 'control'],
		['.single .post_navigation', 'asalah_show_posts_navigation', 'outside', 'control'],
		['.single .post_related', 'asalah_show_related', 'outside', 'control'],
		['.single #fb-root', 'asalah_enable_facebook_comments', 'outside', 'control'],
		['.header_social_icons', 'asalah_facebook_url', 'inside', 'control'],
		['.asalah_blog_global_setting', 'asalah_blog_style', 'inside', 'control'],
		['.single .blog_posts_single > .blog_post_container .blog_post_banner', 'asalah_layout_banner', 'inside', 'section']
		];
		controls.forEach(function (setting) {
			var button = '<a data-control="' + setting[1] + '" data-focus=' + setting[3] + ' class="customize-partial-edit-shortcut asalah-custom-refresh-partial asalah_custom_refresh_' + setting[1] + '"><button aria-label="Click to edit this element." title="Click to edit this element." class="customize-partial-edit-shortcut-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button></a>';
			if (!jQuery('.asalah_custom_refresh_' + setting[1]).length) {
				if (setting[2] === 'outside') {
					jQuery(setting[0]).before(button);
				} else {
					jQuery(setting[0]).prepend(button);
				}
			}
		});

		jQuery('.blog_post_banner').css({position: 'relative', overflow: 'inherit'});

		var hide_controls = [
			'asalah_show_meta',
			'blogname',
			'blogdescription',
			'asalah_default_logo',
			'asalah_header_avatar',
			'asalah_show_tagline',
			'asalah_facebook_url',
			'asalah_blog_style'
		];

		var css_output = '<style>';
		var sept = '';
		hide_controls.forEach(function (tag) {
			css_output += sept + '.customize-partial-edit-shortcut-' + tag;
			sept = ',';
		});
		css_output += '{ display: none;}';
		css_output += '.asalah_custom_refresh_asalah_logo_panel {left: 0;} .rtl .asalah_custom_refresh_asalah_logo_panel {right: 0;}';
		css_output += '</style>';

		jQuery('body').append(css_output);

		jQuery('.asalah_custom_refresh_asalah_layout_banner').css({top: -15, bottom: 0, margin: 'auto', height: 30});
		jQuery('.asalah_custom_refresh_asalah_facebook_url').parent().css('position', 'relative');
		jQuery('.asalah_custom_refresh_asalah_facebook_url').css({top: 0, bottom: 0, margin: 'auto', height: 30});
		jQuery('.asalah_custom_refresh_asalah_logo_panel').parent().css('position', 'relative');
		jQuery('.asalah_custom_refresh_asalah_logo_panel').css({top: -15, bottom: 0, margin: 'auto', height: 30});
		jQuery('.asalah-custom-refresh-partial').on('click', function () {
			// send setting, type
			var data = [jQuery(this).attr('data-control'), jQuery(this).attr('data-focus')];
			wp.customize.preview.send('preview-edit', data);
		});
	}

	// add custom edit shortcut buttons
	$(document).ready(function () {
		add_asalah_custom_partials();
	});

	jQuery(document).ajaxComplete(function () {
		// fix duplicate navigation issue
		var navigation_classes = ['.navigation_prev',
			'.pagination',
			'.navigation_next'];
		navigation_classes.forEach(function (selector) {
			var count = 0;
			jQuery(selector).each(function () {
				if (count > 0) {
					jQuery(this).remove();
				}
				count++;
			});
		});
		add_asalah_custom_partials();
		var custom_css = true;
		if (custom_css) {
			var content = $('#asalah_custom_style_code').text();
			jQuery('#asalah_custom_style_code').text(content + ' ');
			custom_css = false;
		}
		jQuery('.video_fit_container').not('.filterable_grid .video_fit_container, .masonry_blog_style .video_fit_container').fitVids();
		/* --------
		start isotope after imagesloaded
		------------------------------------------- */
		var $originLeft = true;
		if (jQuery('body.rtl').length === true) { $originLeft = false; }

		var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style, body.paged .blog_posts_wrapper.banner_grid_blog_style').isotope({
			// options
			itemSelector: '.blog_post_container',
			layoutMode: 'packery',
			transformsEnabled: true,
			originLeft:	$originLeft
		});

		$blogisotope.imagesLoaded(function () {
			$blogisotope.isotope('layout');
		});

		if (!jQuery('body').hasClass('paged') && jQuery('.blog_posts_wrapper.banner_grid_blog_style').length !== 'undefined') {
			var $gridblogisotope = jQuery('.blog_posts_wrapper.banner_grid_blog_style').imagesLoaded(function () {
				var column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width();
				if (jQuery('body').width() > 900 && jQuery('.main_content').hasClass('col-md-12')) {
					column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width() / 3;
				} else if ((jQuery('body').width() <= 900 && jQuery('body').width() > 490) || (jQuery('body').width() > 900 && jQuery('.main_content').hasClass('col-md-9'))) {
					column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width() / 2;
				}

				$gridblogisotope.isotope({
					// options
					itemSelector: '.blog_post_container',
					layoutMode: 'packery',
					masonry: {
						columnWidth: column
					},
					transformsEnabled: false,
					originLeft:	$originLeft
				});
			});
		}

		jQuery(window).on('resize load', function () {
			if (typeof $gridblogisotope !== 'undefined') {
				$gridblogisotope.isotope('layout');
			}
			if (typeof $blogisotope !== 'undefined') {
				$blogisotope.isotope('layout');
			}
		});
		/* --------
		Gallery grid slider
		------------------------------------------- */
		var grid_slider = jQuery('.grid_slider');
		if (typeof grid_slider !== 'undefined') {
			if (jQuery('.lazyload').length > 0) {

					// set var for rtl check
					var dir = false;
					if (jQuery('body.rtl').length) { dir = true; }

					// using slick slider for grid slider
					grid_slider.slick({
						slide: '.grid_slide.item',
						adaptiveHeight: true,
						arrows: true,
						rtl: dir
					});

			} else {
				grid_slider.imagesLoaded(function () {
					// set var for rtl check
					var dir = false;
					if (jQuery('body.rtl').length) { dir = true; }

					// using slick slider for grid slider
					grid_slider.slick({
						slide: '.grid_slide.item',
						adaptiveHeight: true,
						arrows: true,
						rtl: dir
					});
				});
			}
		}
	});
})(jQuery);
