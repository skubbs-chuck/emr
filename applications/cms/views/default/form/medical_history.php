<div class="box-body no-margin" id="mh-results">
	<form action="#" method="post" id="mh-form">
	    <ul class="products-list product-list-in-box margin">
	    	<li class="item" id="medical-history-message">
	    		<?php if (isset($medical_history['var']['message'])): ?>
	    			<div class="alert alert-<?php echo $medical_history['var']['message_type'] ?>"><?php echo $medical_history['var']['message'] ?></div>
	    		<?php endif ?>
	    	</li>
		    <li class="item">
		    	<div class="btn-group pull-right"><button class="btn btn-primary mh-edit">Edit</button></div>
		    	<div class="btn-group pull-right">
					<button class="btn btn-primary mh-save">Save</button>
					<button class="btn mh-cancel">Cancel</button>
				</div>
		        <strong>Blood Type: </strong>
		        <span class="mh-output" id="blood-type-val"><?php echo $medical_history['data']->blood_type ?></span>
				<?php echo form_dropdown('blood_type', $medical_history['var']['blood_type'], $medical_history['data']->blood_type, 'id="blood-type" class="mh-input"'); ?>
		    </li>
		    <li class="item">
		    	<strong>Immunizations: </strong>
		    	<div>
		    		<span class="mh-output" id="immunization-val"><?php echo $medical_history['data']->immunization ?></span>
		    		<textarea name="immunization" id="immunization" class="form-control mh-input" rows="3"><?php echo $medical_history['data']->immunization ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
		    	<strong>Past Hospitalizations and Surgeries: </strong>
		    	<div class="table-responsive">
				    <table class="table table-bordered">
				    	<thead>
				        	<tr>
				                <th class="label-primary col-md-4">Date/Year</th>
				                <th class="label-primary col-md-8">Details</th>
				            </tr>
				    	</thead>
				        <tbody id="phas">
				        	<?php foreach ($medical_history['data']->phas as $phas): ?>
				            <tr class="mh-output">
			            		<td><?php echo $phas[0] ?></td>
			            		<td><?php echo $phas[1] ?></td>
				            </tr>
				            <?php endforeach ?>
				            <?php foreach ($medical_history['data']->phas as $phas): ?>
				            <tr class="mh-input">
			            		<td><input type="text" name="phas_date_year[]" value="<?php echo $phas[0] ?>" class="form-control"></td>
			            		<td>
			            			<div class="input-group" style="margin-bottom: 5px">
				            			<input type="text" class="form-control" name="phas_detail[]" value="<?php echo $phas[1] ?>">
				            			<span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span>
				            		</div>
			            		</td>
				            </tr>
				            <?php endforeach ?>
				        </tbody>
				        <tfoot>
				        	<tr class="mh-input">
				            	<td colspan="2">
				            		<a href="#" class="btn btn-info btn-xs" id="medical-history-add-phas">Add Entry</a>
				            	</td>
				            </tr>
				        </tfoot>
				    </table>
				</div>
		    </li>
		    <li class="item">
		    	<strong>Personal / Social History: </strong>
		    	<div>
		    		<span class="mh-output" id="personal-social-val"><?php echo $medical_history['data']->personal_social ?></span>
		    		<textarea name="personal_social" id="personal-social" class="form-control mh-input" rows="3"><?php echo $medical_history['data']->personal_social ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
		    	<strong>Family History: </strong>
		    	<div class="table-responsive">
				    <table class="table table-bordered">
				    	<thead>
				        	<tr>
				                <th class="label-primary col-md-4">Relative</th>
				                <th class="label-primary col-md-8">Desease Details</th>
				            </tr>
				    	</thead>
				        <tbody id="family">
				        	<?php foreach ($medical_history['data']->family as $family): ?>
				            <tr class="mh-output">
			            		<td><?php echo $family[0] ?></td>
			            		<td><?php echo $family[1] ?></td>
				            </tr>
				            <?php endforeach ?>
				            <?php foreach ($medical_history['data']->family as $family): ?>
				            <tr class="mh-input">
			            		<td><input type="text" name="family_relative[]" value="<?php echo $family[0] ?>" class="form-control"></td>
			            		<td>
			            			<div class="input-group" style="margin-bottom: 5px">
				            			<input type="text" class="form-control" name="family_desease[]" value="<?php echo $family[1] ?>">
				            			<span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span>
				            		</div>
			            		</td>
				            </tr>
				            <?php endforeach ?>
				        </tbody>
				        <tfoot>
				        	<tr class="mh-input">
				            	<td colspan="2">
				            		<a href="#" class="btn btn-info btn-xs" id="medical-history-add-family">Add Entry</a>
				            	</td>
				            </tr>
				        </tfoot>
				    </table>
				</div>
		    </li>
		    <li class="item">
		    	<strong>Others: </strong>
		    	<div>
		    		<span class="mh-output" id="other-val"><?php echo $medical_history['data']->other ?></span>
		    		<textarea name="other" id="other" class="form-control mh-input" rows="3"><?php echo $medical_history['data']->other ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
		    	<div class="btn-group pull-right"><button class="btn btn-primary mh-edit">Edit</button></div>
		    	<div class="btn-group pull-right">
					<button class="btn btn-primary mh-save">Save</button>
					<button class="btn mh-cancel">Cancel</button>
				</div>
		    </li>
		</ul>
	</form>
</div>
<script type="text/javascript">
$(function() {
	$(document).ready(function() {
		$('#mh-results .mh-input').hide();
		$('#mh-results .mh-save').hide();
		$('#mh-results .mh-cancel').hide();
	});
	$(document).on('click', '#mh-results .mh-edit', function() {
		$('#medical-history-message').text('');
		$('#mh-results .mh-save').show();
		$('#mh-results .mh-cancel').show();
		$('#mh-results .mh-input').show();
		$('#mh-results .mh-output').hide();
		$('#mh-results .mh-edit').hide();

		return false;
	});
	$(document).on('click', '#mh-results .mh-cancel', function() {
		$('#mh-results .mh-save').hide();
		$('#mh-results .mh-cancel').hide();
		$('#mh-results .mh-input').hide();
		$('#mh-results .mh-output').show();
		$('#mh-results .mh-edit').show();
		ajaxPatientGet('medical_history');
		return false
	});
	$(document).on('click', '#mh-results .mh-save', function() {
		$('#patient_loading').show();
		$.ajax({
	        url: base_url + 'ajax/patient/medical_history/' + $('#id_patient').text(), 
	        type: 'post', 
	        data: $('#mh-form').serialize(), 
	        dataType: 'json', 
	        success: function(r) {
	            $('#patient_informations').html(r.html);
	        }, 
	        complete: function(xhr, textStatus) {
	            if (xhr.status != 200) {
	                $('#patient_informations').html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
	                $('#patient_loading').hide();
	            };

	            $('#patient_loading').hide();
	        }
	    });
		
		return false;
	});
	$('#medical-history-add-phas').click(function() {
    	$('#phas').append('<tr class="mh-input">' + 
    		'<td><input type="text" name="phas_date_year[]"class="form-control"></td>' +
    		'<td>' + 
    			'<div class="input-group" style="margin-bottom: 5px">' + 
        			'<input type="text" class="form-control" name="phas_detail[]">' + 
        			'<span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span>' + 
        		'</div>' + 
    		'</td>' + 
        '</tr>');
        return false;
    });
    $('#medical-history-add-family').click(function() {
    	$('#family').append('<tr class="mh-input">' + 
    		'<td><input type="text" name="family_relative[]"class="form-control"></td>' +
    		'<td>' + 
    			'<div class="input-group" style="margin-bottom: 5px">' + 
        			'<input type="text" class="form-control" name="family_desease[]">' + 
        			'<span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span>' + 
        		'</div>' + 
    		'</td>' + 
        '</tr>');
        return false;
    });
});
</script>