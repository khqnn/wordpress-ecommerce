( function( api ) {

	// Extends our custom "home-control-system" section.
	api.sectionConstructor['home-control-system'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );