<div id="diagnostic_study_vars" style="display:none">
	<input type="hidden" id="diagnostic_study_var-id_patient" value="<?php echo $diagnostic_study['id_patient'] ?>">
	<input type="hidden" id="diagnostic_study_var-id_form" value="<?php echo $diagnostic_study['id_form'] ?>">
</div>
<div class="box no-border">
	<div class="box-body">
		<div class="btn-group pull-right" id="create_new_notes-diagnostic_study">
		    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		        Create <span class="caret"></span>
		        <span class="sr-only">Toggle Dropdown</span>
		    </button>
		    <ul class="dropdown-menu scrollable-menu" data-toggle="dropdown" role="menu">
		        <?php foreach ($diagnostic_study['form_list'] as $form): ?>
		        	<li><a href="#" id="create_new_notes-diagnostic_study-<?php echo $form->table_name ?>"><?php echo $form->name ?></a></li>
		        <?php endforeach ?>
		    </ul>
		</div>
	</div>
</div>
<div id="result_diagnostic_study">
	<div class="panel-group" id="diagnostic_study_accordion">
	<?php if ($diagnostic_study['forms']): ?>
	<?php foreach ($diagnostic_study['forms'] as $form): $id = 'id_' . $form->tbl; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
	            <a data-toggle="collapse" data-parent="#diagnostic_study_accordion" href="#<?php echo $form->tbl . '_' . $form->$id ?>">
		            <h4 class="panel-title">
		            	<?php echo $form->tbl_name ?>
		            	<span class="pull-right"><small><?php echo date('M-d-Y', strtotime($form->creation_date)) ?></small></span>
		            </h4>
	            </a>
	        </div>
			<div id="<?php echo $form->tbl . '_' . $form->$id ?>" class="panel-collapse collapse">
	            <div class="panel-body" form-tbl="<?php echo $form->tbl ?>" form-id="<?php echo $form->$id ?>" id="diagnostic_study_data_<?php echo $form->$id ?>_<?php echo $form->tbl ?>"></div>
	        </div>
		</div>
	<?php endforeach ?>
	<?php else: ?>
		<div class="panel panel-default">
			<div class="alert alert-warning text-center">No results found.</div>
		</div>
	<?php endif ?>
	</div>
</div>
<script>
$('div[id^="diagnostic_study_data_"]').each(function(index) {
    form_id = $(this).attr('form-id');
    form = $(this).attr('form-tbl');
    id_result = this.id;
    ajaxPatient(form, id_result, 'patient_loading', form_id);
});
</script>