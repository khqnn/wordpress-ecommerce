( function( api ) {

	// Extends our custom "jewelry-outlet" section.
	api.sectionConstructor['jewelry-outlet'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );