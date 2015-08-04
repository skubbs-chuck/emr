<div id="consultation" class="box no-border">
    <div class="box-body">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Create <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu scrollable-menu" data-toggle="dropdown" role="menu">
                <?php foreach ($consultation['form_list'] as $form): ?>
                    <li><a href="#" class="skubbs_ajax skubbs_btn-create" s-wrap="consultation" s-request="<?php echo $form->table_name ?>" s-action="create"><?php echo $form->name ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="box no-border flat skubbs_result">
        <div class="panel-group" id="consultation_accordion">
        <?php if ($consultation['forms']): ?>
        <?php foreach ($consultation['forms'] as $form): $id = 'id_' . $form->tbl; ?>
            <?php $wrap = $form->tbl . '-' . $form->$id ?>
            <div id="wrap-consultation-<?php echo $wrap ?>" s-request="<?php echo $form->tbl ?>" s-form-id="<?php echo $id ?>" s-wrap="wrap-consultation-<?php echo $wrap ?>" class="panel panel-default skubbs_ajax">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#consultation_accordion" href="#consultation-<?php echo $wrap ?>">
                        <h4 class="panel-title">
                            <?php echo $form->tbl_name ?>
                            <span class="pull-right"><small><?php echo date('M-d-Y', strtotime($form->creation_date)) ?></small></span>
                        </h4>
                    </a>
                </div>
                <div id="consultation-<?php echo $wrap ?>" class="panel-collapse collapse skubbs_result"><div class="text-center">Rendering Data...</div></div>
                <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
            </div>
        <?php endforeach ?>
        <?php else: ?>
            <div class="panel panel-default">
                <div class="alert alert-warning text-center">No results found.</div>
            </div>
        <?php endif ?>
        </div>
    </div>
    <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
</div>