<!-- Default -->
<div class="caldera-config-group">
	<label for="{{_id}}_autocomplete">
		<?php _e( 'Autocomplete attribute', 'caldera-forms' ); ?>
	</label>
	<div class="caldera-config-field">
		<input 
			id="{{_id}}_autocomplete" 
			type="text" 
			class="block-input field-config magic-tag-enabled" 
			name="{{_name}}[autocomplete]" value="{{autocomplete}}" />
		<p class="description"><?php sprintf( _e( 'Possible values are "on", "off", or "value-name", see <a href="%s">here</a> for more information.', 'caldera-forms' ), 'https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/autocomplete' ); ?></p>
	</div>
</div>