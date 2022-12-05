class SimpleForm extends elementorModules.frontend.handlers.Base {}

jQuery( window ).on( 'elementor/frontend/init', () => {
	const addHandler = ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( SimpleForm, {
			$element,
		} );
	};

	elementorFrontend.hooks.addAction( 'frontend/element_ready/rgbc-simple-form-script.default', addHandler );
} );