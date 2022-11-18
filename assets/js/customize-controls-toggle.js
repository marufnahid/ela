(function (api) {
	'use strict';

	api.bind('ready', function () {
		// Create list of callbacks, each callback contains array [callback id, dependent id(s), callback value]
		// if callback id has callback value show dependent id, otherwise hide it
		var single_var_callbacks = [
			['alia_show_top_header_area', 'alia_show_top_header_homepage_area'],
			['alia_show_top_header_area', 'alia_show_header_logo'],
			['alia_show_header_logo', 'alia_show_header_description'],
			['alia_show_header_description', 'alia_header_description'],
			['alia_show_header_site_title', 'image_header_bar_logo'],
			['alia_show_header_site_title', 'alia_show_site_title_dot'],
			['image_header_bar_logo', 'alia_menu_default_logo'],
			['image_header_bar_logo', 'alia_menu_retina_logo'],
		];

		// Show and hide controls with 2 options only
		single_var_callbacks.forEach(function (item, index) {
			api(item[0], function (setting) {
				var linkSettingValueToControlActiveState;

				/**
				* Update a control's active state according to the boxed_body setting's value.
				*
				* @param {api.Control} control Boxed body control.
				*/
				linkSettingValueToControlActiveState = function (control) {
					var visibility = function () {
						var check = item[2];
						var value = api.value(item[0])();
						var activate = false;
						if (typeof check !== 'undefined') {
							if (Array.isArray(check)) {
								if (check.indexOf(value) !== -1) {
									activate = true;
								} else {
									activate = false;
								}
							} else {
								if (check === value) {
									activate = true;
								} else {
									activate = false;
								}
							}
						} else {
							activate = value;
						}

						if (activate) {
							control.container.slideDown(180);
						} else {
							control.container.slideUp(180);
						}
					};
					// Set initial active state.
					visibility();
					// Update activate state whenever the setting is changed.
					setting.bind(visibility);
				};

				// Call linkSettingValueToControlActiveState on each dependent id if is array
				if (Array.isArray(item[1])) {
					item[1].forEach(function (setting, index) {
						api.control(setting, linkSettingValueToControlActiveState);
					});
				} else {
					api.control(item[1], linkSettingValueToControlActiveState);
				}
			});
		});

		// show control when edit button selected
		jQuery('.asalah-custom-refresh-partial').on('click', function (event) {
			event.stopImmediatePropagation();
			event.preventDefault();
			var data = [jQuery(this).attr('data-control'), jQuery(this).attr('data-focus')];
			// identify type to show
			if (data[1] === 'panel') {
				api.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				api.section(data[0]).focus();
			} else {
				api.control(data[0]).focus();
			}
		});
		api.previewer.bind('preview-edit', function (data) {
			// identify type to show
			if (data[1] === 'panel') {
				api.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				api.section(data[0]).focus();
			} else {
				api.control(data[0]).focus();
			}
		});

		jQuery.fn.shake = function (settings) {
			if (typeof settings.interval === 'undefined') {
				settings.interval = 100;
			}

			if (typeof settings.distance === 'undefined') {
				settings.distance = 10;
			}

			if (typeof settings.times === 'undefined') {
				settings.times = 4;
			}

			if (typeof settings.complete === 'undefined') {
				settings.complete = function () {};
			}

			jQuery(this).css('position', 'relative');

			for (var iter = 0; iter < (settings.times + 1); iter++) {
				jQuery(this).animate({ left: ((iter % 2 === 0 ? settings.distance : settings.distance * -1)) }, settings.interval);
			}

			jQuery(this).animate({ left: 0 }, settings.interval, settings.complete);
		};
		jQuery('.focus_shake').on('focus', function () {
			jQuery(this).parent().shake({
				interval: 100,
				distance: 5,
				times: 5
			});
		});
	});
}(wp.customize));
