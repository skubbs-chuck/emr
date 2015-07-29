<div class="box no-border">
	<div class="box-body">
		<div class="btn-group pull-right" id="create-new-nurse_visit">
		    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		        Create <span class="caret"></span>
		        <span class="sr-only">Toggle Dropdown</span>
		    </button>
		    <ul class="dropdown-menu scrollable-menu" data-toggle="dropdown" role="menu">
		        <?php foreach ($nurse_visit['form_list'] as $form): ?>
		        	<li><a href="#" id="create-new-nurse_visit-<?php echo $form->table_name ?>"><?php echo $form->name ?></a></li>
		        <?php endforeach ?>
		    </ul>
		</div>
	</div>
</div>
<div id="result_nurse_visit">
	<div class="panel-group" id="nurse_visit_accordion">
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
	</div>
</div>
<script>
$(function(){
	$(document).ready(function(){
		$('div[id^="nurse_visit_data_"]').each(function(index) {
		    form_id = $(this).attr('form-id');
		    form = $(this).attr('form-tbl');
		    id_result = this.id;
		   	ajaxPatient(form, id_result, 'patient_loading', form_id);
		});
	});
	$(document).on('click', 'a[id^="create-new-nurse_visit-"]', function() {
        form = $(this).attr('id').replace(/^create-new-nurse_visit-/, '');
        id_result = 'result_nurse_visit';
        id_loading = 'patient_loading';
        $.ajax({
	        url: base_url + 'ajax/patient/' + form + '/' + <?php echo $nurse_visit['id_patient'] ?> + '/' + <?php echo $nurse_visit['id_form'] ?> + '/create', 
	        dataType: 'json', 
	        success: function(r) {
	            $('#' + id_result).html('');
	            $('#' + id_result).html(r.html);
	            $('#' + id_loading).hide();
	            return false;
	        }, 
	        complete: function(xhr, textStatus) {
	            if (xhr.status != 200) {
	                $('#' + id_result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
	                $('#' + id_loading).hide();
	            };
	            
	            return false;
	        }
	    });
        $('#create-new-nurse_visit').removeClass('open');
        return false;
    });
});
</script>