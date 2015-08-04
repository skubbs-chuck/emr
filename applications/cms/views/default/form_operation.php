<div class="box no-border">
    <div class="box-body">
            <div class="btn-group pull-right">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
            Create <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu scrollable-menu" role="menu">
            <?php foreach ($operation['form_list'] as $form): ?>
                <li><a href="#" id="create-new-note-<?php echo $form->table_name ?>"><?php echo $form->name ?></a></li>
            <?php endforeach ?>
        </ul>
        </div>
    </div>
</div>
<div id="result_operation">
    <div class="panel-group" id="consulatation_accordion">
    <?php foreach ($operation['forms'] as $form): $id = 'id_' . $form->tbl; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#consulatation_accordion" href="#<?php echo $form->tbl . '_' . $form->$id ?>">
                    <h4 class="panel-title">
                        <?php echo $form->tbl_name ?>
                        <span class="pull-right"><small><?php echo date('M-d-Y', strtotime($form->creation_date)) ?></small></span>
                    </h4>
                </a>
            </div>
            <div id="<?php echo $form->tbl . '_' . $form->$id ?>" class="panel-collapse collapse">
                <div class="panel-body" form-tbl="<?php echo $form->name ?>" form-id="<?php echo $form->$id ?>" id="operation_data_<?php echo $form->$id ?>_<?php echo $form->tbl ?>"></div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</div>
<script>
$(function(){
    $(document).ready(function(){
        $('div[id^="operation_data_"]').each(function(index) {
            form_id = $(this).attr('form-id');
            form = $(this).attr('form-tbl');
            id_result = this.id;
               ajaxPatient(form, id_result, 'patient_loading', form_id);
        });
    });
    $(document).on('click', 'a[id^="create-new-note-form_"]', function() {
        form_to_create = $(this).attr('id').replace(/^create-new-note-form_/, '');
        // alert(form_to_create);
        ajaxPatient(form_to_create, 'result_operation');
        return false;
    });
});
</script>