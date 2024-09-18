<?php
/**
 * Form field that is repeated multiple times.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/form-fields/repeated-field.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.13.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $field['value'] ) && is_array( $field['value'] ) ){ ?>
	<?php foreach ( $field['value'] as $index => $value ){ ?>
		<div class="resume-manager-data-row row">
			<input type="hidden" class="repeated-row-index" name="repeated-row-<?php echo esc_attr( $key ); ?>[]" value="<?php echo absint( $index ); ?>" />
			<a href="#" class="resume-manager-remove-row"><?php _e( 'Remove', 'jobzilla' ); ?></a>
			<?php foreach ( $field['fields'] as $subkey => $subfield ){ 
			$label = $subfield['label'] . ( $subfield['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>' );
			?>
				<div class="col-md-6 form-width">
					<fieldset class="fieldset-<?php  echo esc_attr( $subkey ); ?>">
						
							<div class="form-group">
								<label for="<?php  echo esc_attr( $subkey ); ?>"><?php echo esc_html($label); ?></label>
								  <div class="ls-inputicon-box"> 
									<?php
										// Get name and value
										$subfield['name']  = $key . '_' . $subkey . '_' . $index;
										$subfield['value'] = $value[ $subkey ];
										$class->get_field_template( $subkey, $subfield );
									?>
								</div>
							</div>	
					
					</fieldset>
				</div>
			<?php } ?>
		</div>
	<?php } 
	} ?>

<a href="#" class="resume-manager-add-row" data-row="
<?php

	ob_start();
?>
		
			<div class="resume-manager-data-row row">
				<input type="hidden" class="repeated-row-index" name="repeated-row-<?php echo esc_attr( $key ); ?>[]" value="%%repeated-row-index%%" />
				<a href="#" class="resume-manager-remove-row"><?php _e( 'Remove', 'jobzilla' ); ?></a>
				<?php foreach ( $field['fields'] as $subkey => $subfield ){
					$label = $subfield['label'] . ( $subfield['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>' );
					?>
					<div class="col-md-6 form-width">
						<fieldset class="fieldset-<?php  echo esc_attr( $subkey ); ?>">
							<div class="row">
							
								<div class="form-group">
									<label for="<?php  echo esc_attr( $subkey ); ?>"><?php echo esc_html($label); ?></label>
									 <div class="ls-inputicon-box"> 
										<?php
											$subfield['name'] = $key . '_' . $subkey . '_%%repeated-row-index%%';
											$class->get_field_template( $subkey, $subfield );
										?>
									</div>
								</div>
							</div>	
						
						</fieldset>
					</div>
				<?php } ?>
			</div>
		
	<?php
	echo esc_attr( ob_get_clean() );
	$add_row = !empty( $field['add_row'] ) ? $field['add_row'] : 'Add URL';
	?>
	">+ <?php echo esc_html($add_row); ?></a>
<?php
if ( ! empty( $field['description'] ) ) {
	?>
	<small class="description"><?php echo esc_html($field['description']); ?></small>
	
<?php }; ?>
