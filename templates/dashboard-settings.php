<?php update_field( 'title', '123' ); ?>
<div id="wpbody" role="main">
	<div id="wpbody-content">
		<h1>Register Form Fields</h1>
		<form method="post" id="update_form_fields" enctype="multipart/form-data">
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<th scope="row">
						<label>Price Per Day ($)</label>
					</th>
					<td>
						<input name="pricePerDay" type="text" value="<?php echo get_option( 'pricePerDay' ); ?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label>Maximum Number Of Days</label>
					</th>
					<td>
						<input name="maxNumberOfDays" type="text" value="<?php echo get_option( 'maxNumberOfDays' ); ?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label>Maximum Number Of People</label>
					</th>
					<td>
						<input name="maxNumberOfPeople" type="text" value="<?php echo get_option( 'maxNumberOfPeople' ); ?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<input type="submit" name="savebuttonchangesCalc" class="button button-primary" value="Save Changes">
					</th>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
