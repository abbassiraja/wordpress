wp.customize.controlConstructor['spawp-toggle'] = wp.customize.spawpDynamicControl.extend( {

	// When we're finished loading continue processing
	ready: function () {
		'use strict';

		var control = this;

		// Init the control.
		if (
			!_.isUndefined( window.spawpControlLoader ) &&
			_.isFunction( spawpControlLoader )
		) {
			spawpControlLoader( control );
		} else {
			control.initspawpControl();
		}
	},

	initspawpControl: function () {
		var control       = this,
		    checkboxValue = control.setting._value;

		// Save the value
		this.container.on( 'change', 'input', function () {
			checkboxValue = jQuery( this ).is( ':checked' ) ? true : false;
			control.setting.set( checkboxValue );
		} );
	}
} );