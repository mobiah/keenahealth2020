(function() {
	tinymce.create('tinymce.plugins.Bbutton', {
      	init: function( editor , url ) {

			editor.addButton('binary_button', {
				title: 'Add a button',
				image: url + '/button.png',
				cmd: 'binary_button_builder'
			});

			editor.addCommand( 'binary_button_builder', function() {

				var selected = editor.selection.getContent({format: 'raw'});
				anchor_text = link_url = color = size = '';
				block = outline = false;

				if ( selected.length == 0 ) {
					// force select the whole link
					editor.selection.select( editor.selection.getNode() );
					var selected = editor.selection.getContent({format: 'raw'});
				}

				if ( selected.indexOf('>') === -1 ) {
					anchor_text = selected;
				} else {
					anchor_text = jQuery(selected).text();
					link_url = jQuery(selected).attr('href');
				}

				button_colors = [
					{ text: 'Primary', value: 'primary' },
					{ text: 'Secondary', value: 'secondary' },
					{ text: 'Link', value: 'link' },
				];

				for ( bol in button_colors ) {
					if ( jQuery(selected).hasClass('btn-' + button_colors[bol].value ) || jQuery(selected).hasClass('btn-outline-' + button_colors[bol].value ) ) {
						color = button_colors[bol].value;
					}
				}

				button_sizes = [
					{ text: 'Normal', value: '' },
					{ text: 'Small', value: 'btn-sm' },
					{ text: 'Large', value: 'btn-lg' },
				];

				for ( bsi in button_sizes ) {

					if ( jQuery(selected).hasClass( button_sizes[bsi].value ) ) {
						size = button_sizes[bsi].value;
					}
				}

				if ( selected.indexOf('btn-block') !== -1 )
					block = true;

				if ( selected.indexOf('btn-outline') !== -1 )
					outline = true;

				// Open window
				editor.windowManager.open({
					title: 'Button Builder',
					body: [{
						type : 'textbox',
						name : 'url',
						label : 'Link URL',
						value: link_url
					}, {
						type : 'textbox',
						name : 'text',
						label : 'Link Text',
						value: anchor_text
					}, {
						type : 'listbox',
						name : 'size',
						label : 'Size',
						values : button_sizes,
						onPostRender: function() {
							this.value( size );
						}
					}, {
						type: 'listbox',
						name: 'color',
						label: 'Color',
						values: button_colors,
						onPostRender: function() {
							this.value( color );
						}
					}, {
						type: 'checkbox',
						name: 'outline',
						label: 'Outline Button',
						checked: outline
					}, {
						type: 'checkbox',
						name: 'fullwidth',
						label: 'Full Width Button',
						checked: block
					}],
					onsubmit: function(e) {

						button_html = '<a class="btn';

						if ( e.data.fullwidth == true )
							button_html += ' btn-block';

						button_html += ' btn';

						if ( e.data.outline == true )
							button_html += '-outline';

						button_html += '-' + e.data.color + " " + e.data.size + '" ';

						button_html += 'href="'+ e.data.url.trim() +'">';
						button_html += e.data.text.trim();
						button_html += '</a>';

						// Insert content when the window form is submitted
						editor.insertContent( button_html );

					}
				});
			} )

		}
	});

	// Register plugin
	tinymce.PluginManager.add( 'binary_button', tinymce.plugins.Bbutton );

})();
