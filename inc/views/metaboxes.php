<?php
$meta = get_post_meta( $post->ID );
?>
<form>
	<?php wp_nonce_field( basename( __FILE__ ), 'taylor_metabox_nonce' ); ?>
	<div class="taylor-metabox__row">
		<input type="checkbox" id="taylor-use-transparent-header" name="taylor_use_transparent_header" style="margin-top: 0;" value="yes" <?php if ( isset ( $meta['taylor_use_transparent_header'] ) ) checked( $meta['taylor_use_transparent_header'][0], 'true' ); ?> />
		<label for="taylor-use-transparent-header">Use transparent header</label>
	</div>
	<div class="taylor-metabox__subrow" id="taylor-header-colors">
		<div class="taylor-metabox__row">
			<label for="taylor-header-primary-color" style="display: block; margin-bottom: 6px;">Primary color</label>
			<input type="text" id="taylor-header-primary-color" name="taylor_header_primary_color" class="taylor-color"  <?php if ( isset ( $meta['taylor_header_primary_color'] ) ) echo "value=\"{$meta['taylor_header_primary_color'][0]}\""; ?> />
		</div>
		<div class="taylor-metabox__row">
			<label for="taylor-header-secondary-color" style="display: block; margin-bottom: 6px;">Secondary color</label>
			<input type="text" id="taylor-header-secondary-color" name="taylor_header_secondary_color" class="taylor-color" <?php if ( isset ( $meta['taylor_header_secondary_color'] ) ) echo "value=\"{$meta['taylor_header_secondary_color'][0]}\""; ?> />
		</div>
	</div>
	<div class="taylor-metabox__row">
		<input type="checkbox" id="taylor-hide-title" name="taylor_hide_title" style="margin-top: 0;"  <?php if ( isset ( $meta['taylor_hide_title'] ) ) checked( $meta['taylor_hide_title'][0], 'true' ); ?> />
		<label for="taylor-hide-title">Hide title</label>
	</div>
	<div class="taylor-metabox__row">
		<input type="checkbox" id="taylor-remove-top-spacing" name="taylor_remove_top_spacing" style="margin-top: 0;"  <?php if ( isset ( $meta['taylor_remove_top_spacing'] ) ) checked( $meta['taylor_remove_top_spacing'][0], 'true' ); ?> />
		<label for="taylor-remove-top-spacing">Remove top spacing</label>
	</div>
	<div class="taylor-metabox__row">
		<input type="checkbox" id="taylor-remove-bottom-spacing" name="taylor_remove_bottom_spacing" style="margin-top: 0;"  <?php if ( isset ( $meta['taylor_remove_bottom_spacing'] ) ) checked( $meta['taylor_remove_bottom_spacing'][0], 'true' ); ?> />
		<label for="taylor-remove-bottom-spacing">Remove bottom spacing</label>
	</div>
</form>