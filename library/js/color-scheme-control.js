/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'businesstheme-color-scheme' ),
		colorSchemeKeys = [
			'background_color',
			'braftonium_color',
			'braftonium_link_color',
			'braftonium_linkhover_color',
			'braftonium_headerbg_color',
			'braftonium_header_color',
			'braftonium_headerlink_color',
			'braftonium_headerlinkhover_color',
			'braftonium_footerbg_color',
			'braftonium_footer_color',
			'braftonium_footerlink_color',
			'braftonium_footerlinkhover_color'
		],
		colorSettings = [
			'background_color',
			'braftonium_color',
			'braftonium_link_color',
			'braftonium_linkhover_color',
			'braftonium_headerbg_color',
			'braftonium_header_color',
			'braftonium_headerlink_color',
			'braftonium_headerlinkhover_color',
			'braftonium_footerbg_color',
			'braftonium_footer_color',
			'braftonium_footerlink_color',
			'braftonium_footerlinkhover_color'
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					var colors = colorScheme[value].colors;

					// Update Text Color.
					var color = colors[0];
					api( 'braftonium_color' ).set( color );
					api.control( 'braftonium_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Link Color.
					color = colors[1];
					api( 'braftonium_link_color' ).set( color );
					api.control( 'braftonium_link_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Link Hover Color.
					color = colors[2];
					api( 'braftonium_linkhover_color' ).set( color );
					api.control( 'braftonium_linkhover_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );


					// Update Header BG Color.
					color = colors[3];
					api( 'braftonium_headerbg_color' ).set( color );
					api.control( 'braftonium_headerbg_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Header Text Color.
					color = colors[4];
					api( 'braftonium_header_color' ).set( color );
					api.control( 'braftonium_header_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Header Link Color.
					color = colors[5];
					api( 'braftonium_headerlink_color' ).set( color );
					api.control( 'braftonium_headerlink_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Header Link Hover Color.
					color = colors[6];
					api( 'braftonium_headerlinkhover_color' ).set( color );
					api.control( 'braftonium_headerlinkhover_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Footer BG Color.
					color = colors[7];
					api( 'braftonium_footerbg_color' ).set( color );
					api.control( 'braftonium_footerbg_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Footer Text Color.
					color = colors[8];
					api( 'braftonium_footer_color' ).set( color );
					api.control( 'braftonium_footer_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Footer Link Color.
					color = colors[9];
					api( 'braftonium_footerlink_color' ).set( color );
					api.control( 'braftonium_footerlink_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );

					// Update Footer Link Hover Color.
					color = colors[10];
					api( 'braftonium_footerlinkhover_color' ).set( color );
					api.control( 'braftonium_footerlinkhover_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(),
			css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		} );

		// Add additional color.
		// jscs:disable
		colors.border_color = Color( colors.main_text_color ).toCSS( 'rgba', 0.2 );
		// jscs:enable

		css = cssTemplate( colors );

		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );