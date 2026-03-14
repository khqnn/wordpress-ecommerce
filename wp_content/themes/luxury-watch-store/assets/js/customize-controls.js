( function( api ) {

	// Extends our custom "luxury-watch-store" section.
	api.sectionConstructor['luxury-watch-store'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );