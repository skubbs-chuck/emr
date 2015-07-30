<div id="nurse_visit_vars" style="display:none">
	<input type="hidden" id="nurse_visit_var-id_patient" value="<?php echo $nurse_visit['id_patient'] ?>">
	<input type="hidden" id="nurse_visit_var-id_form" value="<?php echo $nurse_visit['id_form'] ?>">
</div>
<div class="box no-border">
	<div class="box-body">
		<div class="btn-group pull-right" id="create_new_notes-nurse_visit">
		    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		        Create <span class="caret"></span>
		        <span class="sr-only">Toggle Dropdown</span>
		    </button>
		    <ul class="dropdown-menu scrollable-menu" data-toggle="dropdown" role="menu">
		        <?php foreach ($nurse_visit['form_list'] as $form): ?>
		        	<li><a href="#" id="create_new_notes-nurse_visit-<?php echo $form->table_name ?>"><?php echo $form->name ?></a></li>
		        <?php endforeach ?>
		    </ul>
		</div>
	</div>
</div>
<div id="result_nurse_visit">
	<div class="panel-group" id="nurse_visit_accordion">
	<?php if ($nurse_visit['forms']): ?>
	<?php foreach ($nurse_visit['forms'] as $form): $id = 'id_' . $form->tbl; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
	            <a data-toggle="collapse" data-parent="#nurse_visit_accordion" href="#<?php echo $form->tbl . '_' . $form->$id ?>">
		            <h4 class="panel-title">
		            	<?php echo $form->tbl_name ?>
		            	<span class="pull-right"><small><?php echo date('M-d-Y', strtotime($form->creation_date)) ?></small></span>
		            </h4>
	            </a>
	        </div>
			<div id="<?php echo $form->tbl . '_' . $form->$id ?>" class="panel-collapse collapse">
	            <div class="panel-body" form-tbl="<?php echo $form->tbl ?>" form-id="<?php echo $form->$id ?>" id="nurse_visit_data_<?php echo $form->$id ?>_<?php echo $form->tbl ?>"></div>
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
$('div[id^="nurse_visit_data_"]').each(function(index) {
    form_id = $(this).attr('form-id');
    form = $(this).attr('form-tbl');
    id_result = this.id;
    ajaxPatient(form, id_result, 'patient_loading', form_id);
});
</script>